<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 1:38 PM
 */

class AlexDev_Zaproo_Model_Resource_Setup
    extends Mage_Catalog_Model_Resource_Setup {

    public function getDefaultEntities(){
        $entities = array();
        $entities['zaproo_article'] = array(
            'entity_model'                  => 'zaproo/article',
            'attribute_model'               => 'zaproo/resource_eav_attribute',
            'table'                         => 'zaproo/article',
            'additional_attribute_table'    => 'zaproo/eav_attribute',
            'entity_attribute_collection'   => 'zaproo/article_attribute_collection',
            'attributes'        => array(
                'title' => array(
                    'group'          => 'General',
                    'type'           => 'varchar',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Title',
                    'input'          => 'text',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '1',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '10',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'short_description' => array(
                    'group'          => 'General',
                    'type'           => 'text',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Short description',
                    'input'          => 'textarea',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '1',
                    'user_defined'   => true,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '20',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'description' => array(
                    'group'          => 'General',
                    'type'           => 'text',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Description',
                    'input'          => 'textarea',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '1',
                    'user_defined'   => true,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '30',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '1',
                ),
                'publish_date' => array(
                    'group'          => 'General',
                    'type'           => 'datetime',
                    'backend'        => 'eav/entity_attribute_backend_datetime',
                    'frontend'       => '',
                    'label'          => 'Publish Date',
                    'input'          => 'date',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    'required'       => '1',
                    'user_defined'   => true,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '40',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'status' => array(
                    'group'          => 'General',
                    'type'           => 'int',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Enabled',
                    'input'          => 'select',
                    'source'         => 'eav/entity_attribute_source_boolean',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '50',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'url_key' => array(
                    'group'          => 'General',
                    'type'           => 'varchar',
                    'backend'        => 'zaproo/article_attribute_backend_urlkey',
                    'frontend'       => '',
                    'label'          => 'URL key',
                    'input'          => 'text',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '60',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'in_rss' => array(
                    'group'          => 'General',
                    'type'           => 'int',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'In RSS',
                    'input'          => 'select',
                    'source'         => 'eav/entity_attribute_source_boolean',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '70',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'meta_title' => array(
                    'group'          => 'General',
                    'type'           => 'varchar',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Meta title',
                    'input'          => 'text',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '80',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'meta_keywords' => array(
                    'group'          => 'General',
                    'type'           => 'text',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Meta keywords',
                    'input'          => 'textarea',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '90',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),
                'meta_description' => array(
                    'group'          => 'General',
                    'type'           => 'text',
                    'backend'        => '',
                    'frontend'       => '',
                    'label'          => 'Meta description',
                    'input'          => 'textarea',
                    'source'         => '',
                    'global'         => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                    'required'       => '',
                    'user_defined'   => false,
                    'default'        => '',
                    'unique'         => false,
                    'position'       => '100',
                    'note'           => '',
                    'visible'        => '1',
                    'wysiwyg_enabled'=> '0',
                ),

            )
        );
        return $entities;
    }
}