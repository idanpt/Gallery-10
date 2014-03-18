<?php
session_start();
ob_start();
include 'config.php';
include 'functions.php';

$make_pages=make_pages();  //configure pagination of mysql query
?>
<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gallery 6.3</title>
	<link href="lightbox/css/lightbox.css" rel="stylesheet" />
	<link type="text/css" rel="stylesheet" href="css/mystyle.css" />
        <link type="text/css" rel="stylesheet" href="css/loader.css" />
        <link type="text/css" rel="stylesheet" href="css/header_style.css" />
	<script src="lightbox/js/jquery-1.10.2.min.js"></script>
	<script src="lightbox/js/lightbox-2.6.min.js"></script>
	<script type="text/javascript" src="jquery-data-load-while-scroll/js/jquery-ias.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        	// Infinite Ajax Scroll configuration
            jQuery.ias({
                container : '#gallery', // main container where data goes to append
                item: '.item', // single items
                pagination: '.nav', // page navigation
                next: '.nav a', // next page selector
                loader: '<img src="30.GIF"/>', // loading gif
                triggerPageThreshold: 3 // show load more if scroll more than this
            });
        });
        $(document).ready(function(){
        jQuery('.item a img').removeAttr('title');
        });
    </script>
</head>
<body>
    
<div class="wrap">
	<header>
            <ul id="home_link_c">
            <li><a href="index.php" id="home_link"><h1>Gallery 6.4</h1></a></li>
            </ul>
                <nav>
		<ul id="navigator">
                   <li> <a href="upload_multiple.php" id="backlink">Upload</a></li>
<li>Filter by user
	<ul>
<?php

$users= get_users();      //function to check db for photographers
$counts=array_count_values($users);
$users=array_unique($users);
foreach ($users as $key => $value) {
			         // add links for spasific photographer
	?> <li><a href="index.php?user=<?php echo $value;?>">
                show only <?php echo $value;?>'s pics <?php echo "(" . $counts[$value] . ")";?></a></li>
		<?php 
				 ?>
<?php }?> </ul> 
	</li><?php
if(isset($_GET['user'])){
	?> <li><a href="index.php">Back to main gallery</a></li>
<?php }

	?>
	<li><a href="loginsession/admin.php" id="admin_link">Im the admin BIATCH</a></li>
        <?php if(isset($_SESSION['username'])){
         ?>   

        <li><?php echo $_SESSION['username']; ?><ul><li id="logout"><a href="loginsession/logout.php"><b>Logout</b></a></li></ul></li>
        <?php }else{?> <li><a href="loginsession/login.php">Login</a></li>  <?php } ?> 
</ul>
</nav>
</header>
<?php	

if (isset($_GET['user'])) {        // if a spacific photographer link pressed - 
	$user=$_GET['user'];
	                                       //show images from chosen photographer
	?>
	<div id="gallery">
            <h4>Images from <?php echo $user;?></h4>                    
	<?php $imgsfromuser=imgsfromuser(); ?>
</div>
	<?php
}else{                                     // defult case - show all images
?>
<div id="gallery"><?php $get_pages=get_pages(); ?>
</div>


<?php }?>

<footer>
    <ul style="margin-top:5px;">
        <li><a href="index.php">Up & fold</a></li>
    </ul>
    <?php include 'counter.php'; ?>
    <H3>You are the #<?php echo $visitor_count; ;?> visitor </H3>

<h2>&#169;</h2>
</footer>
</div><!--.wrap-->

</body>
</html>
<?php mysql_close();
ob_end_flush();?>