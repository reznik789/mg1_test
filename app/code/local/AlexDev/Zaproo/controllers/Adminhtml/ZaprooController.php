<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/6/16
 * Time: 2:58 PM
 */

class AlexDev_Zaproo_Adminhtml_ZaprooController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('zaproo.alexadmin');
        $this->renderLayout();
    }
}