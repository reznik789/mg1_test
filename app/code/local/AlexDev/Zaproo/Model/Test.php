<?php

/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 27.11.2016
 * Time: 0:50
 */
class AlexDev_Zaproo_Model_Test
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
       $this->_init ('zaproo/test');
    }

    public function sayHello() {
        echo 'Hi Magento';
    }
}