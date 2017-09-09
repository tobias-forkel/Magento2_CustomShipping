<?php
/**
 * Forkel CustomShipping
 *
 * @category    Forkel
 * @package     Forkel_CustomShipping
 * @copyright   Copyright (c) 2017 Tobias Forkel (http://www.tobiasforkel.de)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Forkel\CustomShipping\Model\Plugin\Shipping\Rate\Result;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

/**
 * @category   Forkel
 * @package    Forkel_CustomShipping
 * @author     tobias.forkel@gmx.com
 * @website    http://www.tobiasforkel.de
 */

class Remove {

    /**
     * @var \Forkel\CustomShipping\Helper\Config
     */
    protected $_helper;

    /**
     * @param Helper $helper
     */
    public function __construct(
        \Forkel\CustomShipping\Helper\Config $helper

    ) {
        $this->_helper = $helper;
    }

    /**
     * Validate each shipping method before append and apply the rules action if validation was successful.
     *
     * @param \Magento\Shipping\Model\Rate\Result $subject
     * @param \Magento\Quote\Model\Quote\Address\RateResult\AbstractResult|\Magento\Shipping\Model\Rate\Result $result
     * @return array
     */
    public function beforeAppend($subject, $result)
    {
        if (!$result instanceof \Magento\Quote\Model\Quote\Address\RateResult\Method)
        {
            return [$result];
        }

        // Only if feature is enabled and custom shipping available
        if ($this->_helper->getConfig('hide_enabled') && $this->_helper->isAvailable())
        {

            $hideMethods = explode(',', $this->_helper->getConfig('hide_carriers'));

            $code = $result->getCarrier() . '_' . $result->getMethod();

            if (in_array($code, $hideMethods))
            {
                $result->setIsDisabled(true);
            }
        }

        return [$result];
    }
}