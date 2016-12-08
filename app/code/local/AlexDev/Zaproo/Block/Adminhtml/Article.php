<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 2:40 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_article';
        $this->_blockGroup = 'zaproo';
        parent::__construct();
        $this->_headerText = Mage::helper('zaproo')->__('Article');
        $this->_updateButton('add', 'label', Mage::helper('zaproo')->__('Add Article'));

        $this->setTemplate('zaproo/grid.phtml');
    }
}