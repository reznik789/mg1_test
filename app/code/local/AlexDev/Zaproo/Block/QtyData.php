<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 11/29/16
 * Time: 1:42 PM
 */
class AlexDev_Zaproo_Block_QtyData extends Mage_Core_Block_Template
{
    public function getProductsQtyData() {

        $product_collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->joinField('qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left'
            )->addAttributeToSort('name', 'ASC');

        return $product_collection;
    }
}