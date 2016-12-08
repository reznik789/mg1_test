<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:04 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('articleGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('zaproo/article')->getCollection()
            ->addAttributeToSelect('publish_date')
            ->addAttributeToSelect('status')
            ->addAttributeToSelect('url_key');
        $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
        $store = $this->_getStore();
        $collection->joinAttribute('title', 'zaproo_article/title', 'entity_id', null, 'inner', $adminStore);
        if ($store->getId()) {
            $collection->joinAttribute('zaproo_article_title', 'zaproo_article/title', 'entity_id', null, 'inner', $store->getId());
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('zaproo')->__('Id'),
            'index' => 'entity_id',
            'type' => 'number'
        ));
        $this->addColumn('title', array(
            'header' => Mage::helper('zaproo')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));
        if ($this->_getStore()->getId()) {
            $this->addColumn('zaproo_article_title', array(
                'header' => Mage::helper('zaproo')->__('Title in %s', $this->_getStore()->getName()),
                'align' => 'left',
                'index' => 'zaproo_article_title',
            ));
        }

        $this->addColumn('status', array(
            'header' => Mage::helper('zaproo')->__('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('zaproo')->__('Enabled'),
                '0' => Mage::helper('zaproo')->__('Disabled'),
            )
        ));
        $this->addColumn('publish_date', array(
            'header' => Mage::helper('zaproo')->__('Publish Date'),
            'index' => 'publish_date',
            'type' => 'date',

        ));
        $this->addColumn('url_key', array(
            'header' => Mage::helper('zaproo')->__('URL key'),
            'index' => 'url_key',
        ));
        $this->addColumn('created_at', array(
            'header' => Mage::helper('zaproo')->__('Created at'),
            'index' => 'created_at',
            'width' => '120px',
            'type' => 'datetime',
        ));
        $this->addColumn('updated_at', array(
            'header' => Mage::helper('zaproo')->__('Updated at'),
            'index' => 'updated_at',
            'width' => '120px',
            'type' => 'datetime',
        ));
        $this->addColumn('action',
            array(
                'header' => Mage::helper('zaproo')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('zaproo')->__('Edit'),
                        'url' => array('base' => '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'is_system' => true,
                'sortable' => false,
            ));
        $this->addExportType('*/*/exportCsv', Mage::helper('zaproo')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('zaproo')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('zaproo')->__('XML'));
        return parent::_prepareColumns();
    }

    protected function _getStore()
    {
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('article');
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('zaproo')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('zaproo')->__('Are you sure?')
        ));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('zaproo')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'status' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('zaproo')->__('Status'),
                    'values' => array(
                        '1' => Mage::helper('zaproo')->__('Enabled'),
                        '0' => Mage::helper('zaproo')->__('Disabled'),
                    )
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}