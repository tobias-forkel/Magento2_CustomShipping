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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Config;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Psr\Log\LoggerInterface;

/**
 * @category   Forkel
 * @package    Forkel_CustomShipping
 * @author     tobias.forkel@gmx.com
 * @website    http://www.tobiasforkel.de
 */

class Custom extends AbstractCarrier implements CarrierInterface
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
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Check if current user logged as admin
     *
     * @return bool
     */
    protected function isAdmin()
    {

        /** @var \Magento\Framework\ObjectManagerInterface $om */
        $om = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Framework\App\State $state */
        $state =  $om->get('Magento\Framework\App\State');

        return 'adminhtml' === $state->getAreaCode();
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
         * Check if shipping method should be visible in backend, frontend or both
         */
        if ($this->getConfigData('availability') == 'backend' && !$this->isAdmin() || $this->getConfigData('availability') == 'frontend' && $this->isAdmin()) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        $rate = $this->_rateMethodFactory->create();

        $price = $rate->setPrice($this->getConfigData('price'));

        $rate->setCarrier($this->getCarrierCode());
        $rate->setCarrierTitle($this->getConfigData('title'));

        $rate->setMethod($this->getCarrierCode());
        $rate->setMethodTitle($this->getConfigData('name'));

        $rate->setPrice($price);

        $result->append($rate);

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