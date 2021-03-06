<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/6/16
 * Time: 11:23 AM
 *
 * @var $this AlexDev_Zaproo_Model_Resource_Setup
 */

$this->startSetup();
//create the entity table
$table = $this->getConnection()
    ->newTable($this->getTable('zaproo/article'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Entity ID')
    ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Type ID')
    ->addColumn('attribute_set_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Attribute Set ID')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Creation Time')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Update Time')
    ->addIndex($this->getIdxName('zaproo/article', array('entity_type_id')),
        array('entity_type_id'))
    ->addIndex($this->getIdxName('zaproo/article', array('attribute_set_id')),
        array('attribute_set_id'))
    ->addForeignKey(
        $this->getFkName(
            'zaproo/article',
            'attribute_set_id',
            'eav/attribute_set',
            'attribute_set_id'
        ),
        'attribute_set_id', $this->getTable('eav/attribute_set'), 'attribute_set_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($this->getFkName('zaproo/article', 'entity_type_id', 'eav/entity_type', 'entity_type_id'),
        'entity_type_id', $this->getTable('eav/entity_type'), 'entity_type_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Article Table');
$this->getConnection()->createTable($table);

//create the attribute values tables (int, decimal, varchar, text, datetime)
$articleEav = array();
$articleEav['int'] = array(
    'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length' => null,
    'comment' => 'Article Integer Attribute Backend Table'
);

$articleEav['varchar'] = array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'comment' => 'Article Varchar Attribute Backend Table'
);

$articleEav['text'] = array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => '64k',
    'comment' => 'Article Text Attribute Backend Table'
);

$articleEav['datetime'] = array(
    'type' => Varien_Db_Ddl_Table::TYPE_DATETIME,
    'length' => null,
    'comment' => 'Article Datetime Attribute Backend Table'
);

$articleEav['decimal'] = array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'length' => '12,4',
    'comment' => 'Article Decimal Attribute Backend Table'
);

foreach ($articleEav as $type => $options) {
    $table = $this->getConnection()
        ->newTable($this->getTable(array('zaproo/article', $type)))
        ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'nullable' => false,
            'primary' => true,
        ), 'Value ID')
        ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
        ), 'Entity Type ID')
        ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
        ), 'Attribute ID')
        ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
        ), 'Store ID')
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
        ), 'Entity ID')
        ->addColumn('value', $options['type'], $options['length'], array(), 'Value')
        ->addIndex(
            $this->getIdxName(
                array('zaproo/article', $type),
                array('entity_id', 'attribute_id', 'store_id'),
                Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
            ),
            array('entity_id', 'attribute_id', 'store_id'),
            array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
        ->addIndex($this->getIdxName(array('zaproo/article', $type), array('store_id')),
            array('store_id'))
        ->addIndex($this->getIdxName(array('zaproo/article', $type), array('entity_id')),
            array('entity_id'))
        ->addIndex($this->getIdxName(array('zaproo/article', $type), array('attribute_id')),
            array('attribute_id'))
        ->addForeignKey(
            $this->getFkName(
                array('zaproo/article', $type),
                'attribute_id',
                'eav/attribute',
                'attribute_id'
            ),
            'attribute_id', $this->getTable('eav/attribute'), 'attribute_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->addForeignKey(
            $this->getFkName(
                array('zaproo/article', $type),
                'entity_id',
                'zaproo/article',
                'entity_id'
            ),
            'entity_id', $this->getTable('zaproo/article'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->addForeignKey($this->getFkName(array('zaproo/article', $type), 'store_id', 'core/store', 'store_id'),
            'store_id', $this->getTable('core/store'), 'store_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->setComment($options['comment']);
    $this->getConnection()->createTable($table);
}
//crete the news_eav_attribute (for additional attribute settings)
$table = $this->getConnection()
    ->newTable($this->getTable('zaproo/eav_attribute'))
    ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Attribute ID')
    ->addColumn('is_global', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Attribute scope')
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Attribute position')
    ->addColumn('is_wysiwyg_enabled', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Attribute uses WYSIWYG')
    ->addColumn('is_visible', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Attribute is visible')
    ->setComment('News attribute table');
$this->getConnection()->createTable($table);

$this->installEntities();
$this->endSetup();


