<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 2:10 PM
 */
class AlexDev_Zaproo_Model_Article_Attribute_Backend_Urlkey
    extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();
        $urlKey = $object->getData($attributeName);
        if ($urlKey == '') {
            $urlKey = $object->getTitle();
        }
        $urlKey = $this->formatUrlKey($urlKey);
        $validKey = false;
        while (!$validKey) {
            $entityId = Mage::getResourceModel('zaproo/article')->checkUrlKey($urlKey, $object->getStoreId(), false);
            if ($entityId == $object->getId() || empty($entityId)) {
                $validKey = true;
            } else {
                $parts = explode('-', $urlKey);
                $last = $parts[count($parts) - 1];
                if (!is_numeric($last)) {
                    $urlKey = $urlKey . '-1';
                } else {
                    $suffix = '-' . ($last + 1);
                    unset($parts[count($parts) - 1]);
                    $urlKey = implode('-', $parts) . $suffix;
                }
            }
        }
        $object->setData($attributeName, $urlKey);
        return $this;
    }

    public function formatUrlKey($str)
    {
        $urlKey = preg_replace('#[^0-9a-z]+#i', '-', Mage::helper('catalog/product_url')->format($str));
        $urlKey = strtolower($urlKey);
        $urlKey = trim($urlKey, '-');
        return $urlKey;
    }
}