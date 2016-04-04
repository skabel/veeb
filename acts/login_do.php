<?php
// /acts/login_do.php

$username = $http->get('username');
$password = $http->get('password');

$sql = 'SELECT * FROM user WHERE '.
'username='.fixDb($username).' AND '.
'password='.fixDb(md5($password)).' AND '.
'is_active=1';

$res = $db->getArray($sql);

if($res === false){
    // koostame veateate
    // suuname tagasi sisselogimise vormi koos veateatega
    $link = $http->getLink(array('act'=>'login'));
    $http->redirect($link);
}
else{
    // avame kasutajale sessiooni
    // suuname pealehele, mis on vastava sisuga
    $http->redirect();
}
?>