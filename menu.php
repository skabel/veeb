<?php
/**
 * Created by PhpStorm.
 * User: siim-kaarel.kabel
 * Date: 21.03.2016
 * Time: 12:28
 */
// /menu.php

if(!defined('BASE_DIR')){
    exit;
}
$menu = new template('menu.menu');
$item = new template('menu.item');

$item->set('name','kontakt');
$link = $http->getLink(array('act'=>'contact'));
$item->set('link', $link);
$menu->add('items', $item->parse());
?>