<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 1:36 PM
 */
class AlexDev_Zaproo_Model_Resource_Article_Attribute_Collection
    extends Mage_Eav_Model_Resource_Entity_Attribute_Collection
{
    protected function _initSelect()
    {
        $this->getSelect()->from(array('main_table' => $this->getResource()->getMainTable()))
            ->where('main_table.entity_type_id=?', Mage::getModel('eav/entity')->setType('zaproo_article')->getTypeId())
            ->join(
                array('additional_table' => $this->getTable('zaproo/eav_attribute')),
                'additional_table.attribute_id=main_table.attribute_id'
            );
        return $this;
    }

    public function setEntityTypeFilter($typeId)
    {
        return $this;
    }

    public function addVisibleFilter()
    {
        return $this->addFieldToFilter('additional_table.is_visible', 1);
    }

    public function addEditableFilter()
    {
        return $this->addFieldToFilter('additional_table.is_editable', 1);
    }
}