<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 1:27 PM
 */
class AlexDev_Zaproo_Model_Resource_Attribute
    extends Mage_Eav_Model_Resource_Entity_Attribute
{
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $setup = Mage::getModel('eav/entity_setup', 'core_write');
        $entityType = $object->getEntityTypeId();
        $setId = $setup->getDefaultAttributeSetId($entityType);
        $groupId = $setup->getDefaultAttributeGroupId($entityType);
        $attributeId = $object->getId();
        $sortOrder = $object->getPosition();

        $setup->addAttributeToGroup($entityType, $setId, $groupId, $attributeId, $sortOrder);
        return parent::_afterSave($object);
    }
}