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

    public function addItemsToTopmenuItems(Varien_Event_Observer $observer) {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();
        $action = Mage::app()->getFrontController()->getAction()->getFullActionName();

        $articleNodeId = 'article';
        $data = array(
            'name' => Mage::helper('zaproo')->__('Articles'),
            'id' => $articleNodeId,
            'url' => Mage::helper('zaproo/article')->getArticlesUrl(),
            'is_active' => ($action == 'zaproo_article_index' || $action == 'zaproo_article_view')
        );
        $articleNode = new Varien_Data_Tree_Node($data, 'id', $tree, $menu);
        $menu->addChild($articleNode);
        return $this;
    }
}