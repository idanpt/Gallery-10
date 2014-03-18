 <?php
 include 'config.php';
 //Adds one to the counter
 $ip=$_SERVER['REMOTE_ADDR'];
 $query="SELECT * FROM counter WHERE ip = '$ip'";
 $result=  mysql_query($query);
 $num_rows=  mysql_num_rows($result);
 if($num_rows==0){
     //the current ip doesnt exist in database - insert it
     $sql="INSERT INTO counter (id, ip) VALUES ('', '$ip')";
     $qur=mysql_query($sql);

 }
          $get_current_number="SELECT * FROM counter";
         $qur2= mysql_query($get_current_number);   
 $visitor_count=  mysql_num_rows($qur2);          
?>