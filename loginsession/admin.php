<?php
include '../config.php';
include '../functions.php';
// Report all errors except E_NOTICE   
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['username']=="admin" || isset($_COOKIE['admin'])){
	echo "<h2>Welcome, Admin!</h2>";?>
		
	<h3>What do you want to do?</h3>
	<a href="admin.php?action=delete_user">Delete user</a><br>
        <a href="admin.php?action=delete_img">Delete image</a><br>
	<a href="admin.php?action=organize">Organize data/users</a><br>
	<a href="admin.php?action=statistics">Get statistics</a><br>
	<a href="../index.php">Go to gallery</a><br>
    <a href="../upload_multiple.php">Upload Image</a><br />
	<a href="admin.php?action=logout">Log out</a><p></p>
	<?php
	if($_GET['action']=="delete_user"){
		   //The delete page:
                echo "<h2>Remove user:</h2>";
                $sql_u = "SELECT * FROM users ORDER BY username";
		$qur_u=mysql_query($sql_u);
                ?> <ul> <?php
                while ($row_u = mysql_fetch_array($qur_u)){
                ?> <li><a href="admin.php?action=delete_user&user=<?php echo $row_u['username'];?>"><?php echo $row_u['username'];?></a></li>
                       <?php if($_GET['user']==$row_u['username']){
						//delete the img from db
						$selected_user=$row_u['username'];
                                                
						$delete_qur_u="DELETE FROM users WHERE username = '$selected_user' ";
						$result_u=mysql_query($delete_qur_u)or die(mysql_error());
						if($result_u){
							echo "<script>alert('The user " . $selected_user . " was removed.');
							window.location.href='admin.php?action=delete_user'</script>";

						}
				}
                }?>
                    </ul>
                
                
            <?php }
           
        
            if($_GET['action']=="delete_img"){
		echo "<h2>Click an image to delete it</h2>";
		$sql = "SELECT * FROM $tbl_name ORDER BY mid DESC";
		$qur=mysql_query($sql);
		
		 while ($row = mysql_fetch_array($qur)){ 
			$row_path="../".$row['path'];
		?>
				<div id="admin_imgs" style="display: inline-block">
					<a href="admin.php?action=delete_img&img=<?php echo $row['path'];?>" title="<?php echo $row['caption'];?>">
						<img src="<?php echo $row_path?>" height="220px" width="220px"/>
					</a>
				</div>
			<?php if($_GET['img']==$row['path']){
						//delete the img from db
						$selected_img=$row['path'];
						$delete_qur="DELETE FROM $tbl_name WHERE path = '$selected_img' ";
						$result=mysql_query($delete_qur)or die(mysql_error());
						if($result){
							$img_delete=$row['path'];
							echo "$img_delete";
							$delete_file=unlink('../' . $img_delete);
							if ($delete_file) {
								echo "File deleted";
								echo "<script>alert('The image " . basename($img_delete) . " was deleted from database and folder')
							window.location.href='admin.php?action=delete_img'</script>";
							}
							//$selected_img=basename($selected_img);
						}
				}
		}
           }
	if($_GET['action']=="statistics"){
		//get_statistic page:
        $sql = "SELECT * FROM users";
        $qur=mysql_query($sql, $link);
        
        
        ?>
        <ul>
            <li>Users:<ul><?php while ($row=mysql_fetch_assoc($qur)){
            echo "<li>" . $row['name'] . "</li>";
        }
        ?></ul></li>
        
            <li>Images per photographer:
            
              	<ul>
                    <?php
                    
                    $photographers= get_photographers();      //function to check db for photographers
                    $counts=array_count_values($photographers);
                    $photographers=array_unique($photographers);
                    foreach ($photographers as $key => $value) {
                    			         // add links for spasific photographer
                    	?> 
                    		<li><?php echo $value . ": " . $counts[$value] ;?></li>

            <?php }?> </ul>                       
            </li>
             <li>Number of images:
            <?php $sql = "SELECT * FROM $tbl_name";
                    $qur=mysql_query($sql, $link);
                    echo mysql_num_rows ($qur);
         
            ?>
            </li>

        </ul>
<?php
	}
    if($_GET['action']=='logout'){
        session_destroy();
        echo "<script>alert('Youve been logged out.'); 
        window.location.href='../index.php'</script>";

    }
	
}else{
	echo "Please login as admin:<br><br>";
	
	include 'login.php';
}

?>