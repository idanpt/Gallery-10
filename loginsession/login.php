
<?php
session_start();
include ('../config.php');
?>
    <!DOCTYPE html>
    <html>
    	<body> <?php
if(!isset($_POST['submit'])){?>

    		<form action="login.php" method="post">
            <ul style="list-style: none;">
                <li>Username: <input type="text" name="username" /></li>
    			<li>Password: <input type="password" name="password" /></li>
    			<li><input type="submit" name="submit" value="Login" /></li>
            </ul>
    			
    			
    		</form>
    		<a href="register.php">Register?</a></br>
    		

<?php
}else
{
    $username=  strtolower($_POST['username']);
    $password=$_POST['password'];
    if($username&&$password){
    	$query= mysql_query("SELECT * FROM users WHERE username='$username'")or die (mysql_error());
    	
    	$numrows=mysql_num_rows($query) or die('that user doesnt exsist');
    	
    	if($numrows>0){
    		//code to login
            
            //get user&password from db
    		while ($row=mysql_fetch_assoc($query)){     
    			$dbusername=$row['username'];
    			$dbpassword=$row['password'];
    		}
    		//check to see if they match
    		
    		if($username==$dbusername&&md5($password)==$dbpassword){     //user input match db info - set cookie and session and get in
                    
                    if($username=='admin'){                                  //check if current user is admin
                        setcookie("admin_cookie", "admin", time()+3600*24);
                        $_SESSION['username']="admin";
                        echo "<script>
                                alert('Youre in, Admin!');
                                window.location.href='admin.php';
                                </script>";
                    } else {                                                //if not admin 
                        setcookie("remember_user", "value", time()+3600*24);
                        $_SESSION['username']=$dbusername;
             
    			echo "<script>
                                alert('Youre in! (and will be for the next 24 hours /until you logout)');
                                window.location.href='../index.php';
                                </script>";
    			
                    }                                                         
    	
    		}else{
    			die("incorret password");
    		}
    		
    	}else{
    		die("that user doesnt exsist");
    	}
    	
    }else{
    	die("please enter a username and a password");
    }
}




?>
    	</body>
    </html>