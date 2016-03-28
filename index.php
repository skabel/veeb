<?php
/**
 * Created by PhpStorm.
 * User: siim-kaarel.kabel
 * Date: 7.03.2016
 * Time: 15:04
 */

//loome pealehe template
$tmpl = new template('main');

require_once('menu.php');

$tmpl->set('menuu', $menu->parse());
$tmpl->set('nav_bar', strftime(' %A, %d.%B.%Y %H:%M'));
$tmpl->set('lang_bar', 'Siia tuleb keelevahetus (kunagi)');
$tmpl->set('body', 'Lehe sisu');
$tmpl->add('body', '<br /> ja midagi veel');

// väljastamise täidetud template
echo $tmpl->parse();
// andmebaasipäringute kontroll

$db->showHistory();

?>