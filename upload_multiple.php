
<?php session_start(); 
// Increase max upload file size and execution time
/*ini_set( 'upload_max_size' , '20M' );
ini_set( 'post_max_size', '20M');
ini_set( 'max_execution_time', '300' );
ini_set('max_file_uploads', '20');
ini_set('memory_limit', '200M');*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css/upload_page_style.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <title>Upload images</title>
    </head>
    <body>
<?php



        if(isset($_SESSION['username']) || isset($_COOKIE['value'])){
        $username=$_SESSION['username'];
        ?>
		<div id="upload_form">
        <h2>Upload your image(s), <?php echo $username; ?></h2>
			<form enctype="multipart/form-data" action="" method="POST">
				<table>
    				<tr>
    			    	<td>Choose images to upload (or drag one over here):</td>
    					<td><input name="files[]" type="file" multiple="multiple" accept="image/*" /></td>
    				</tr>
    				<tr>
    				<td>Caption/describe (in a few words):</td>
    				<td><input type="text" name="caption" /></td></tr>
                                <tr><td><input type="hidden" value="<?php echo $username ;?>" name="user" /></td></tr>
				</table><br />
                <div id="button-holder"><input type="submit" value="Upload image(s)" name="submit" id="submit" /></div>
			</form>
        <a id="admin_link_container" href='loginsession/admin.php'><div id="admin_link"><b>Admin access</b></div></a>
		</div>
		
		<?php 
        }else{die('<div id="login">Please <a href="loginsession/login.php">login</a> to upload images</div> ');}  //if user isnt logged in

		
if(isset($_POST['submit'])){
    // validate duplicity, file type & size and move tmp file to /uploads folder
    include'config.php';            //db info
    include 'functions.php';
    $max_file_size=2000*2000;
    $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
    $path="uploads/";
    $count=0;

    foreach ($_FILES['files']['name'] as $f => $name) {     
                if ($_FILES['files']['error'][$f] == 4) {
                    continue; // Skip file if any error found
                }	       
                if ($_FILES['files']['error'][$f] == 0) {	           
                    if ($_FILES['files']['size'][$f] > $max_file_size) {
                        $message[] = "$name is too large!.";
                        continue; // Skip large files
                    }
                            elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
                                    $message[] = "$name is not a valid format";
                                    continue; // Skip invalid file formats
                            }
                            elseif(file_exists($path.$name)){
                                $message[] = "$name is already in the gallery"; //skip existing files

                            }

                    else{ // No error found! Move uploaded files and insets info into db
                        if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)){
                            $query="insert into image (mid, name, path, user, caption) 
                            values ('','$name','uploads/$name','$username', '$caption')";
                            $res=mysql_query($query,$link);
                              if($res){
                                  $count++; // Number of successfully uploaded file
                              }
                        }

                    }
                }
                }?>
                

                <div id="results">
             <?php
            if(isset($message)){
                foreach ($message as $key=>$value){
                echo $value."<br>";
                }
            }

             echo "<b>".$count." image(s) have been uploaded.</b><br>"; 
             ?>
                    <a id="go-to-gallery" href='index.php'><div id="gallery_link"><b>Go to gallery</b></div></a>
                </div>
      <!--  <div style="text-align: center;"><progress max="100" value="80"></progress></div> -->
<?php
    }

?>
    </body>
</html>
