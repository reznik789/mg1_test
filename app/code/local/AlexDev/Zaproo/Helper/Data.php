<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/7/16
 * Time: 1:20 PM
 */
class AlexDev_Zaproo_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function convertOptions($options)
    {
        $converted = array();
        foreach ($options as $option) {
            if (isset($option['value']) && !is_array($option['value']) && isset($option['label']) && !is_array($option['label'])) {
                $converted[$option['value']] = $option['label'];
            }
        }
        return $converted;
    }
}