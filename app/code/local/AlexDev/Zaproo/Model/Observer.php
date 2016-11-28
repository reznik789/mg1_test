<?php

/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 27.11.2016
 * Time: 20:03
 */
class AlexDev_Zaproo_Model_Observer
{
    public function logCustomer($observer) {
        $customer = $observer->getCustomer();
        Mage::log($customer->getName() . ' has logged in!', null, 'customer.log');
    }
}