<?php
function imgsfromsql() //not in use
{

	global $tbl_name;
	global $start;
	global $limit;
	
	$sql = "SELECT * FROM $tbl_name ORDER BY time DESC";
	
	$result = mysql_query($sql);

	while ($row=mysql_fetch_array($result)) {?>
			
			<div class="img">
		<a href="<?php echo $row['path']?>" data-lightbox="image-1" title="<?php echo $row['caption'];?>">
			<img src="<?php echo $row['path']?>" height="220px" width="220px"/>
		</a>
			</div>
			
        <?php 
        }
}

function get_users()  //check for photographer in the db to create links
{
	global $tbl_name;
	
	$sql_p = "SELECT * FROM $tbl_name";
	
	$result_p = mysql_query($sql_p);
	$users=array();
	
	while ($row_p= mysql_fetch_array($result_p)){         //add all photographers to array (with duplicates)
		$users[]=$row_p['user'];
	}

	return $users;
}

function imgsfromuser()
{
	global $user;
	global $tbl_name;
# sql query
$sql = "SELECT * FROM $tbl_name WHERE user = '$user' ORDER BY mid DESC";

$query = mysql_query( $sql);?>

	<!-- loop row data -->
	<?php while ($row = mysql_fetch_array($query)){ ?>
	<div class="item" id="item-<?php echo $row['mid']?>">
		
		<a href="<?php echo $row['path']?>" data-lightbox="image-1" title="<?php echo $row['caption'];?>">
			<img src="<?php echo $row['path']?>" height="220px" width="220px" alt="<?php echo $row['path']?>"/>
                        <div id="image_info"><div id="info"><?php echo "Date Uploaded:" . date("d/m/y", strtotime($row['time']));
            ?></div>
            </div>
		</a>
	</div>
	<?php } 
}



function make_pages()  //divide the gallery into pages 
{
	global $tbl_name;
	$limit=20;  //indicates the numeber of item in each page
	$page = (int) (!isset($_GET['p'])) ? 1 : $_GET['p'];
# sql query
$sql = "SELECT * FROM $tbl_name ORDER BY mid DESC";
# find out query stat point
$start = ($page * $limit) - $limit;
# query for page navigation
if( mysql_num_rows(mysql_query($sql)) > ($page * $limit) ){
	$next = ++$page;
}
$query = mysql_query( $sql . " LIMIT {$start}, {$limit}");
if (mysql_num_rows($query) < 1) {
	header('HTTP/1.0 404 Not Found');
	echo 'Page not found!';
	exit();
}
}

function get_pages(){  //show images in gallery
	global $tbl_name;
	$limit=20;  //indicates the numeber of item in each page
	$page = (int) (!isset($_GET['p'])) ? 1 : $_GET['p'];
# sql query
$sql = "SELECT * FROM $tbl_name ORDER BY mid DESC";
# find out query stat point
$start = ($page * $limit) - $limit;
# query for page navigation
if( mysql_num_rows(mysql_query($sql)) > ($page * $limit) ){
	$next = ++$page;
}
$query = mysql_query( $sql . " LIMIT {$start}, {$limit}");?>

	<!-- loop row data -->
	<?php while ($row = mysql_fetch_array($query)){ 
		
		if(file_exists($row['path'])){     //checks if the file from db records actually exsists in folder
		?>
	<div class="item">
		
            <a href="count_views.php?id=<?php echo $row['mid']?>" data-lightbox="images" 
               title="<?php echo $row['name']. '<br>'; 
                         echo "Date Uploaded: " . date("d/m/y", strtotime($row['time'])) . "<br>" ;
                              echo "User: " . $row['user']. "<br>";   echo "views: ". $row['views'].'<br>';   echo $row['caption'];?>">
                <img src="<?php echo $row['path']?>" height="220" width="220" alt="<?php echo $row['path']?>"/>
            <div class="image_info">
                <div class="info"><?php echo "Date Uploaded: " . date("d/m/y", strtotime($row['time'])) . "<br>" ;
                              echo "User: " . $row['user']. "<br>";   echo "views: ". $row['views']; 
            ?></div>
            </div>
            
		</a>
	</div><?php } 
	} 

	//page navigation-->
	if (isset($next)){ ?>
	<div class="nav">
		<a href='index.php?p=<?php echo $next?>'>Next</a>
	</div>
	<?php } ?>

<?php }

function delete_missing_images()   //check db for non exsiting images and deletes them
{
	global $tbl_name;
	global $link;
	$sql = "SELECT * FROM $tbl_name";      
	$result = mysql_query($sql,$link);
	while ($row=mysql_fetch_array($result)) {
		if(!file_exists($row['path'])){
			$p=$row['path'];
			$sql2= "DELETE FROM $tbl_name WHERE path = '$p'";
			$delete=mysql_query($sql2, $link)or die (mysql_error());
			if($delete){
				echo "deleted!";
				break;
			}
		}
	}
}
?>