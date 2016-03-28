<?php
// /acts/login_do.php

$username = $http->get('username');
$password = $http->get('password');

$sql = 'SELECT * FROM user WHERE'.'username'.fixDb($username).' AND'.'password'=fixDb(md5($password)).' AND '.
    'is_active=1';

$res = $db->getArray($sql);

echo '<pre>';
print_r($res);
echo '</pre>';

?>