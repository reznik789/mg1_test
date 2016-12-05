<?php


class AlexDev_Zaproo_Model_Resource_Test_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('zaproo/test');
    }
}