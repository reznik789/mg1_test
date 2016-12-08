<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 1:21 PM
 */

class AlexDev_Zaproo_Model_Resource_Article_Collection
    extends Mage_Catalog_Model_Resource_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('zaproo/article');
    }

    protected function _toOptionArray($valueField = 'entity_id', $labelField = 'title', $additional = array())
    {
        $this->addAttributeToSelect('title');
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }

    protected function _toOptionHash($valueField = 'entity_id', $labelField = 'title')
    {
        $this->addAttributeToSelect('title');
        return parent::_toOptionHash($valueField, $labelField);
    }

    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(Zend_Db_Select::GROUP);
        return $countSelect;
    }
}
