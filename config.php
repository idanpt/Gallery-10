<?php
/**
 * DB Configuration
 */
define('DB_HOST',			'mysql.serversfree.com');
define('DB_USER',			'u631439974_root');
define('DB_PASS',			'KmjkDO8');
define('DB_NAME',			'u631439974_image');
$limit = 10; #item per page
# db connect
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to MySQL DB ') . mysql_error();
$db = mysql_select_db(DB_NAME, $link); 
$tbl_name="image";
?>
