<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 1:29 PM
 */
class AlexDev_Zaproo_Model_Resource_Eav_Attribute
    extends Mage_Eav_Model_Entity_Attribute
{
    const MODULE_NAME = 'zaproo';
    const ENTITY = 'zaproo_eav_attribute';
    protected $_eventPrefix = 'zaproo_entity_attribute';
    protected $_eventObject = 'attribute';
    static protected $_labels = null;

    protected function _construct()
    {
        $this->_init('zaproo/attribute');
    }

    public function isScopeStore()
    {
        return $this->getIsGlobal() == Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE;
    }

    public function isScopeWebsite()
    {
        return $this->getIsGlobal() == Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE;
    }

    public function isScopeGlobal()
    {
        return (!$this->isScopeStore() && !$this->isScopeWebsite());
    }

    public function getBackendTypeByInput($type)
    {
        switch ($type) {
            case 'file':
                //intentional fallthrough
            case 'image':
                return 'varchar';
                break;
            default:
                return parent::getBackendTypeByInput($type);
                break;
        }
    }

    protected function _beforeDelete()
    {
        if (!$this->getIsUserDefined()) {
            throw new Mage_Core_Exception(Mage::helper('zaproo')->__('This attribute is not deletable'));
        }
        return parent::_beforeDelete();
    }
}