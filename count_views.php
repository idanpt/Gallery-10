<?php
include 'config.php';
 //Adds to the click count for a particular link
$id=$_GET['id'];
 mysql_query("UPDATE $tbl_name SET views = views + 1 WHERE mid = $id")or die(mysql_error()); 

 //Retrieves information
 $data = mysql_query("SELECT * FROM $tbl_name WHERE mid = $id") or die(mysql_error()); 
 $info = mysql_fetch_array($data); 

 //redirects them to the link they clicked
 header( "Location:" .$info['path'] ); 
 ?> 
