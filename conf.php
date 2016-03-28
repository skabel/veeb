<?php
/**
 * Created by PhpStorm.
 * User: siim-kaarel.kabel
 * Date: 28.03.2016
 * Time: 10:43
 */

error_reporting(E_ALL);

// vajalikud konstandid
define('BASE_DIR', './');

define('SITENAME', 'Veebiprogrammeerimine');

// kaustade konstandid
define('CLASSES_DIR', BASE_DIR.'classes/');
define('TMPL_DIR', BASE_DIR.'tmpl/');
define('ACTS_DIR', BASE_DIR. 'acts/');
define('LIB_DIR', BASE_DIR. 'lib/');

// võtame vajalikud failid kaasa
require_once(CLASSES_DIR.'template.php');
require_once(CLASSES_DIR.'http.php');
require_once(CLASSES_DIR.'linkobject.php');
require_once(CLASSES_DIR.'mysql.php');

require_once(LIB_DIR.'utils.php');

// defineerime rollide konstandid
define('ROLE_NONE', 0);
define('ROLE_ADMIN', 1);
define('ROLE_USER', 2);

// defineerime tegevuste konstandid
define('DEFAULT_ACT', 'default');

require_once('../dbconf.php');

$http = new linkobject();
$db = new mysql(DBHOST, DBUSER, DBPASS, DBNAME);


?>