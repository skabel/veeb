<?php
// /acts/login.php

$login = new template('login');

$login->set('user', 'Kasutajanimi');
$login->set('pass', 'Parool');
$login->set('button', 'Logi sisse!');

$link = $http->getLink(array('act'=>'login_do'));
$login->set('link', $link);

$tmpl->set('body', $login->parse());

?>