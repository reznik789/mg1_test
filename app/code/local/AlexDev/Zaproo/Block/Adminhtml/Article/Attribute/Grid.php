<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:19 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Attribute_Grid
    extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('zaproo/article_attribute_collection')
            ->addVisibleFilter();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addColumnAfter('is_global', array(
            'header' => Mage::helper('zaproo')->__('Scope'),
            'sortable' => true,
            'index' => 'is_global',
            'type' => 'options',
            'options' => array(
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE => Mage::helper('zaproo')->__('Store View'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE => Mage::helper('zaproo')->__('Website'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL => Mage::helper('zaproo')->__('Global'),
            ),
            'align' => 'center',
        ), 'is_user_defined');
        return $this;
    }
}