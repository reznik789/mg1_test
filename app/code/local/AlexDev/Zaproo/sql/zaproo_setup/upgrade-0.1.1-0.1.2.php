<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/6/16
 * Time: 11:23 AM
 *
 */

$installer = Mage::getResourceModel('catalog/setup', 'default_setup');
/**
* @var $installer Mage_Catalog_Model_Resource_Setup
 */

$installer->startSetup();

$data = array(
        'label'         => 'Option from upgrade script',
        'type'          => 'varchar',
        'input'         => 'multiselect',
        'required'      => 0,
        'user_defined'  => 1,
        'group'         => 'Price',
        'option'        => array(
                            'order' => ['one' => 1, 'two' => 2, 'three' => 5],
                            'value' => [
                                'one'   => [ 0 => "Some Label One", 2 => 'Alt one'],
                                'two'   => [ 0 => "Some Label Two", 2 => 'Alt two'],
                                'three' => [ 0 => "Some Label Three", 2 => 'Alt three']
                            ]
                        )
);

$installer->addAttribute('catalog_product', 'attribute_installed', $data);

$installer->endSetup();


