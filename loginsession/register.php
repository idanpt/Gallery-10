<?php
include ('../config.php');
// Report all errors except E_NOTICE   
error_reporting(E_ALL ^ E_NOTICE);

echo "<h1>Register</h1>";
if(isset($_POST['submit'])){
	$submit=$_POST['submit'];
	$fullname=strip_tags($_POST['fullname']);
	$username=strtolower(strip_tags($_POST['username']));

	$password=strip_tags($_POST['password']);
	$repeatpassword=strip_tags($_POST['repeatpassword']);
	$date= date("Y-m-d");
}

if($submit){

	$namecheck=mysql_query("SELECT username FROM users WHERE username = '$username'")or die (mysql_error());
	$count=mysql_num_rows($namecheck);
	if($count!=0){
		die('Username already taken');	
	}
		
//check for existance
	if($fullname&&$username&&$password&&$repeatpassword){
		
			//check if passwords match
		if($password==$repeatpassword){
			//check names length
			if(strlen($username)>25 or strlen($fullname)>25){
			echo "Max limit for username/full name are 24 characters";
			}else{
			//check password length
				if(strlen($password)>25 or strlen($password)<6){
				echo "Password must be between 6 and 25 characters";
				}else{
					//encrypt password:
					$password=md5($_POST['password']);
					$repeatpassword=md5($_POST['repeatpassword']);
					//register the user:
					$queryreg= mysql_query("INSERT INTO users 
					VALUES('','$fullname','$username','$password','$date')");
					die ("You have been registered! <a href='login.php'>Return to login page</a>");
				}
			}
		}else{
			echo "Your passwords dont match";
		}
	}else{
		echo "Please enter <b>all</b> of the fields ";
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		
	</head>
	
<body>
	<p>
	<form action="register.php" method="post">
		<table>
			<tr>
				<td>
				Your full name:	
				</td>
				<td>
				<input type="text" name="fullname" value="<?php echo $fullname; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					Choose a username:
				</td>
				<td>
					<input type="text" name="username" value="<?php echo $username; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					Choose a password:
				</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td>
					Repeat your password:
				</td>
				<td>
					<input type="password" name="repeatpassword" />
				</td>
			</tr>
		</table>
		<p>
			<input type="submit" name="submit" value="Register" />
		
		
	</form>

</body>	
</html>