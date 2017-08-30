<?php
/**
 * Forkel CustomShipping
 *
 * @category    Forkel
 * @package     Forkel_CustomShipping
 * @copyright   Copyright (c) 2017 Tobias Forkel (http://www.tobiasforkel.de)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Forkel\CustomShipping\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_timezone;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var Session
     */
    protected $_session;

    /**
     * @param \Magento\Customer\Model\Session $session
     * @var String
     */
    protected $_tab = 'carriers';

    /**
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     * @param \Magento\Customer\Model\Session $session
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->_timezone = $timezone;
        $this->_session = $session;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Get module configuration values from core_config_data
     *
     * @param $setting
     * @return mixed
     */
    public function getConfig($setting)
    {
        return $this->_scopeConfig->getValue(
            $this->_tab . '/forkel_customshipping/' . $setting,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get different values from core_config_data and decide if custom shipping method is available.
     *
     * @return boolean
     */
    public function isAvailable()
    {
        $date_current = strtotime($this->_timezone->formatDate());
        $date_start = strtotime($this->getConfig('date_start'));
        $date_end = strtotime($this->getConfig('date_end'));
        $frequency = $this->getConfig('frequency');
        $day = strtolower(date('D', $date_current));

        /**
         * Check if shipping method is actually enabled
         */
        if (!$this->getConfig('active'))
        {
            return false;
        }

        /**
         * Check if shipping method should be available for logged in users only
         */
        if ($this->getConfig('customer') && !$this->isCustomerLoggedIn()) {
            return false;
        }

        /**
         * Check if shipping method should be visible in backend, frontend or both
         */
        if ($this->getConfig('availability') == 'backend' && !$this->isAdmin() || $this->getConfig('availability') == 'frontend' && $this->isAdmin()) {
            return false;
        }

        /**
         * Check if scheduler is enabled
         */
        if ($this->getConfig('scheduler_enabled')) {

            /**
             * Check if shipping method should be visible at current name of day
             */
            if (strpos($frequency, $day) === false) {
                return false;
            }

            /**
             * Check if start date is in range
             */
            if ($date_start && $date_start > $date_current)
            {
                return false;
            }

            /**
             * Check if start end is in range
             */
            if ($date_end && $date_end < $date_current)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if current user logged in as admin
     *
     * @return bool
     */
    protected function isAdmin()
    {
        return 'adminhtml' === $this->_session->getAreaCode();
    }

    /**
     * Check if current user logged in
     *
     * @return bool
     */
    protected function isCustomerLoggedIn() {

        return $this->_session->isLoggedIn();
    }
}