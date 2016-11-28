<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 11/28/16
 * Time: 2:52 PM
 */

require_once ('app/Mage.php');

Mage::app();

$test = Mage::getModel('zaproo/index');
$test->sayHello();