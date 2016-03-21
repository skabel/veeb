<?php
/**
 * Created by PhpStorm.
 * User: siim-kaarel.kabel
 * Date: 21.03.2016
 * Time: 10:24
 */
// /classes/mysql.php
class mysql{
    var $conn = false;
    var $host = false;
    var $user = false;
    var $pass = false;
    var $dbname = false;

    var $history = array();

    function __construct($h, $u, $p, $n){
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $n;
        $this->connect();
    }// konstruktor

    function connect(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if (mysqli_connect_error()) {
            echo 'Viga andmebaasi serveriga ühenduses<br />';
            exit;
        }
    }// connect
    function selectDb(){
        $res = mysqli_select_db($this->conn, $this->dbname);
        if($res === false){
            echo 'Ei saanud andmebaasi kätte<br />';
        }
    }// selectDb()

    function getMicrotime(){
        list ($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    } // getMicrotime

    function query($sql){
        $begin = $this->getMicrotime();
        $res = mysqli_query($this->conn, $sql);
        if($res == false){
            echo 'Viga paringus!<br />'.$sql.'<br />';
            echo mysqli_error($this->conn).'<br />';
            exit;
        }
        $time = $this->getMicrotime() - $begin;
        $this->history[] = array(
            'sql' => $sql,
            'time' => $time
        );
        return $res;
    }// query
    function getArray($sql){
        $res = $this->query($sql);
        $data = array();
        while($record = mysqli_fetch_assoc($res)){
            $data[] = $record;
        }
        if(count($data) == 0){
            return false;
        }
        return $data;
    }// getArray()
    function showHistory(){
        if(count($this->history) > 0){
            echo '<hr />';
            foreach($this->history as $key=>$val){
                echo '<li>'.$val['sql'].'<br /><strong>';
                echo round($val['time'], 6).'</strong></li>';
            }
        }
    }//showHistory()
}// mysql klassi lopp
/*echo '<pre>';
print_r ($db);
echo '</pre>';
echo '<pre>';
print_r($db->query('SHOW TABLES'));
print_r($db->getArray('SELECT * FROM EMAD'));
print_r($db);
echo '</pre>';

$db->query('SHOW TABLES');
$db->getArray('SELECT * FROM EMAD');
$db->showHistory();
*/
?>