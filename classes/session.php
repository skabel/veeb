<?php
// /classes/session.php
class session{
    var $sid = false;
    var $vars = array();
    var $http = false;
    var $db = false;
    var $anonymous = true;
    var $timeout = 1800; // 30 minutit

    function __construct(&$http, &$db){
        $this->http = &$http;
        $this->db = &$db;
        $this->sid = $http->get('sid');
    }// konstruktor

    function setTimeout($t){
        $this->timeout = $t;
    }// setTimeout

    function setAnonymous($bool){
        $this->anonymous = $bool;
    }// setAnonymous

    function get ($name){
        if(isset($this->vars[$name])){
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

    function clearSessions(){
        $sql = 'DELETE FROM session'.' WHERE '.time().' - UNIX_TIMESTAMP(changed) >'.
        $this->timeout;
        $this->db->query($sql);
    }// clearSessions
    function checkSession(){
        $this->clearSessions();
        if($this->sid === false and $this->anonymous){
            $this->createSession();
            // tuleb luua sessioon

        }
        if($this->sid !== false){
            $sql = 'SELECT * FROM session'.
                ' WHERE sid='.fixDb($this->sid);
            $res = $this->db->getArray($sql);
            if($res == false){
                if($this->anonymous){
                    // loome anonüümse sessiooni
                    $this->createSession();
                }
                else{
                    $this->sid = false;
                    $this->http->del('sid');
                }
                define('ROLE_ID', 0);
                define('USER_ID', 0);

            }
            else{
                $vars = unserialize($res[0]['svars']);
                if(!is_array($vars)){
                    $vars = array();
                }
                $this->vars = $vars;
                $user_data = unserialize($res[0]['user_data']);
                define('ROLE_ID', $user_data['role_id']);
                define('USER_ID', $user_data['user_id']);
                $this->user_data = $user_data;
            }
        }
        else{
            define('ROLE_ID',0);
            define('USER_ID',0);
        }
    }// checkSession
    function createSession($user = false){
        if($user){
            $user = array(
                'user_id' = 0,
                'role_id' = 0,
                'username' = 'Anonymous'
            );
        }
        $sid = md5(uniqid(time().mt_rand(1,1000), true));

        $sql = 'INSERT INTO session SET '.
            'sid='.fixDb($sid).', '.
            'user_id='.fixDb($user['user_id']).', '.
            'user_data='.fixDb(serialize($user)).', '.
            'login_ip='.fixDb(REMOTE_ADDR).', '.
            'created=NOW()';

        $this->db->query($sql);
        $this->sid = $sid;
        $this->http->set('sid', $sid);

        // luua cookie lehe nimega
    }
}// session klassi lõpp
?>