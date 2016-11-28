<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 11/28/16
 * Time: 2:52 PM
 */

require_once ('app/Mage.php');

Mage::app();

//$test = Mage::getModel('zaproo/index');
//$test->sayHello();
$product = Mage::getModel('catalog/product')->load(46);
var_dump($product);
$pages = Mage::getModel('cms/page')->getCollection();
var_dump($pages);
