<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 11/28/16
 * Time: 5:05 PM
 */
class AlexDev_Zaproo_IndexController extends Mage_Core_Controller_Front_Action
{
    const NUM_LIST = 'num';
    const STR_LIST = 'str';
    const BOTH_LIST = 'both';

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function sayHelloAction() {
        echo "Hello from syHelloAction";
    }

    public function qtyAction(){
        $type = $this->getRequest()->getParam('type');
        if (!$this->isCorrectListType($type)) {
            die(); // TODO realize redirect to home page
        }
        $this->loadLayout();
        $this->getLayout()->getBlock('zaproo.qtydata')->setData('type', $type);
        $this->renderLayout();
    }

    private function isCorrectListType($type) {
        $correct_types = [
            self::NUM_LIST,
            self::STR_LIST,
            self::BOTH_LIST
        ];
        return in_array($type, $correct_types);
    }


}