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

    public function controllerActionPredispatch(Varien_Event_Observer $observer) {
        $user = Mage::getSingleton('admin/session')->getUser();
        $name = $user ? $user->getUsername() : ' NOT LOGGED IN ';
        Mage::log(
            $name . ' ' . Mage::app()->getRequest()->getPathInfo(),
            Zend_Log::INFO, 'admin_log', true
        );
    }

    public function initControllerRouters(Varien_Event_Observer $observer) {
        
    }
}