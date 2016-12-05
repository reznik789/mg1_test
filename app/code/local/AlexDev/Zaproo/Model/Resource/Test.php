<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/5/16
 * Time: 2:39 PM
 */

class AlexDev_Zaproo_Model_Resource_Test
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
       $this->_init('zaproo/test', 'id');
    }
}