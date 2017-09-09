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

/**
 * @category   Forkel
 * @package    Forkel_CustomShipping
 * @author     tobias.forkel@gmx.com
 * @website    http://www.tobiasforkel.de
 */

class GetFilteredRates {

    /**
     * Remove flagged shipping method
     *
     * @param \Magento\Shipping\Model\Rate\Result $subject
     * @param array $result
     * @return array
     */
    public function afterGetAllRates($subject, $result)
    {
        foreach ($result as $key => $rate) {
            if ($rate->getIsDisabled()) {
                unset($result[$key]);
            }
        }

        return $result;
    }
}