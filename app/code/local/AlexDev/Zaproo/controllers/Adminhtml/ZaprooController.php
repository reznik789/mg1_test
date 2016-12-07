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
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/zaproo');
    }

    public function indexAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('zaproo.alexadmin');
        $this->renderLayout();
    }
}