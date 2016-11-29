<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 11/29/16
 * Time: 5:23 PM
 */
class AlexDev_Zaproo_QtyController extends Mage_Core_Controller_Front_Action
{
    public function IndexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
}