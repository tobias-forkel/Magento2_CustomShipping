<?php
/**
 * Forkel CustomShipping
 *
 * @category    Forkel
 * @package     Forkel_CustomShipping
 * @copyright   Copyright (c) 2017 Tobias Forkel (http://www.tobiasforkel.de)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Forkel\CustomShipping\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

/**
 * @category   Forkel
 * @package    Forkel_CustomShipping
 * @author     tobias.forkel@gmx.com
 * @website    http://www.tobiasforkel.de
 */

class Custom extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * Carrier identifier
     *
     * @var string
     */
    protected $_code = 'forkel_customshipping';

    /**
     * This carrier has fixed rates calculation
     *
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * @var ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var MethodFactory
     */
    protected $_rateMethodFactory;

    /**
     * @var Session
     */
    protected $_session;

    /**
     * @var State
     */
    protected $_appState;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param \Magento\Customer\Model\Session $session
     * @param \Magento\Framework\App\State $appState
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\App\State $appState,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->_session = $session;
        $this->_appState = $appState;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
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

    /**
     * Collect and get rates for backend and frontend
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param RateRequest $request
     * @return DataObject|bool|null
     * @api
     */
    public function collectRates(RateRequest $request)
    {
        /**
         * Check if shipping method is actually enabled
         */
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /**
         * Check if shipping method should be available for logged in users only
         */
        if ($this->getConfigFlag('customer') && !$this->isCustomerLoggedIn()) {
            return false;
        }

        /**
         * Check if shipping method should be visible in backend, frontend or both
         */
        if ($this->getConfigData('availability') == 'backend' && !$this->isAdmin() || $this->getConfigData('availability') == 'frontend' && $this->isAdmin()) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier($this->getCarrierCode());
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->getCarrierCode());
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice($this->getConfigData('price'));
        $method->setCost($this->getConfigData('cost'));

        $result->append($method);

        return $result;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->getCarrierCode() => __($this->getConfigData('name'))];
    }

}