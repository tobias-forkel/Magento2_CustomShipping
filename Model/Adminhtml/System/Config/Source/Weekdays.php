<?php
/**
 * Forkel CustomShipping
 *
 * @category    Forkel
 * @package     Forkel_CustomShipping
 * @copyright   Copyright (c) 2017 Tobias Forkel (http://www.tobiasforkel.de)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Forkel\CustomShipping\Model\Adminhtml\System\Config\Source;

/**
 * @category   Forkel
 * @package    Forkel_CustomShipping
 * @author     tobias.forkel@gmx.com
 * @website    http://www.tobiasforkel.de
 */

class Weekdays implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var Array
     */
    protected $_data = [];

    /**
     * Get weekdays
     *
     * @return array
     */
    public function getWeekdays()
    {
        return $this->_data = [
            'mon' => __('Monday'),
            'tue' => __('Tuesday'),
            'wed' => __('Wednesday'),
            'thu' => __('Thursday'),
            'fri' => __('Friday'),
            'sat' => __('Saturday'),
            'sun' => __('Sunday')
        ];
    }

    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $data = [];

        foreach ($this->getWeekdays() as $key => $value)
        {
            $data[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $data;
    }
}