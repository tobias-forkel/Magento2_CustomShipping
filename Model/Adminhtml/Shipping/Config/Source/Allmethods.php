<?php
/**
 * Forkel CustomShipping
 *
 * @category    Forkel
 * @package     Forkel_CustomShipping
 * @copyright   Copyright (c) 2017 Tobias Forkel (http://www.tobiasforkel.de)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Forkel\CustomShipping\Model\Adminhtml\Shipping\Config\Source;

/**
 * @category   Forkel
 * @package    Forkel_CustomShipping
 * @author     tobias.forkel@gmx.com
 * @website    http://www.tobiasforkel.de
 */

class Allmethods implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Framework\App\Config
     */
    protected $_shippingConfig;

    /**
     * @var \Magento\Shipping\Model\Config
     */
    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config $scopeConfig,
        \Magento\Shipping\Model\Config $shippingConfig

    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_shippingConfig = $shippingConfig;
    }

    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $carriers = $this->_shippingConfig->getActiveCarriers();
        $methods = array();

        foreach ($carriers as $carrierCode => $carrierModel)
        {
            if (!$carrierMethods = $carrierModel->getAllowedMethods())
            {
                continue;
            }

            $title = $this->_scopeConfig->getValue('carriers/' . $carrierCode . '/title');

            foreach ($carrierMethods as $methodCode => $method)
            {
                $code = $carrierCode . '_' . $methodCode;

                if ($code == 'forkel_customshipping_forkel_customshipping')
                {
                    continue;
                }

                $methods[] = [
                    'label' => $title,
                    'value' => $code
                ];
            }
        }

        return $methods;
    }
}