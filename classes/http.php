<?php
/**
 * Created by PhpStorm.
 * User: siim-kaarel.kabel
 * Date: 14.03.2016
 * Time: 10:26
 */
function fixHtml($val){
    return htmlentities($val);
}


class http{
    var $vars = array(); // http päringust tulenevad andmsed
    var $server = array(); // serveri poolsed andmed
    var $cookie = array(); // küpsiste andmed

    function __construct(){
        $this->init();
        $this->initConst();
    }// konstruktor

    function init(){
        $this->vars = array_merge($_GET, $_POST, $_FILES);
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
    }// init
    function initConst()
    {
        $vars = array('REMOTE_ADDR', 'PHP_SELF', 'SCRIPT_NAME', 'HTTP_HOST');
        foreach ($vars as $var) {
            if (!defined($var) and isset($this->server[$var])) {
                define($var, $this->server[$var]);
            }
        }
    }// initConst
    function get ($name, $fix = false){
            if(isset($this->vars[$name])){
                if($fix){
                return fixHtml($this->vars[$name]);
                }
            return $this->vars[$name];
            }
             return false;
    } // get
    function  set($name, $val){
        $this->vars[$name] = $val;
    }

    function del($name){
        if(isset($this->vars[$name])){
            unset($this->vars[$name]);
        }
    }
    function redirect($url = false){
        global $sess;
        $sess->flush();

        if ($url === false){
            $url = $this->getLink();
        }
        $url = str_replace('&amp;', '&', $url);
        header('Location: '.$url);
        exit;
    }

} // http klassi lõpp
/*
$http = new http();
$http->set('eesnimi', 'Siim-Kaarel');
$http->set('perenimi', 'Kabel');
#$http->init();
#$http->initConst();
echo '<pre>';
print_r($http->vars);
#print_r($http->server);
#print_r($http->cookie);
echo '</pre>';
#echo HTTP_HOST;
echo $http->get('eesnimi').'<br />';
echo $http->get('perenimi', true);

$http->del('eesnimi');
echo '<pre>';
print_r($http->vars);
echo '</pre>';
*/
?>