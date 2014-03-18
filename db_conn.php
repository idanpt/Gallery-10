<?php
//mysql connection vars
$hostname_phpimage='localhost';
$database_phpimage='phpimage';
$username_phpimage='root';
$password_phpimage='';
$phpimage=mysql_pconnect($hostname_phpimage,$username_phpimage,$password_phpimage) or trigger_error(mysql_error('error shmerror'), E_USER_ERROR);

?>
