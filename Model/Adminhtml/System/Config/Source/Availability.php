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

class Availability implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => 'both', 'label' => 'Backend / Frontend'],
            ['value' => 'backend', 'label' => 'Backend only'],
            ['value' => 'frontend', 'label' => 'Frontend only']
        ];
    }
}