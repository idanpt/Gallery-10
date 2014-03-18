<?php
session_start();
session_destroy();
setcookie("remember_user", "value", time()-10);

echo "You've been logged out. <a href='../index.php'>Click here</a> to return.";


?>