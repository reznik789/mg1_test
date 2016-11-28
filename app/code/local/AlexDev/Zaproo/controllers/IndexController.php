<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 11/28/16
 * Time: 5:05 PM
 */
class AlexDev_Zaproo_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function sayHelloAction() {
        echo "Hello from syHelloAction";
    }
}