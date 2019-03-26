<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);


include("./inc/connection.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>pustCON</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header clear">
	<div class="header_name clear">
		<p>PustCON</p>
	</div>

	<div class="search_box clear" >
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" >
			<input type="text" name="search" size ="60" 
			placeholder="  search ...">
					<button name="search_button" type="submit">
					<i class="fa fa-search" ></i>
				</button>

		</form>
		
	</div>
</div>

<div class="search_result " clear="both">
<?php 
//$search_result =array();
$no_result = '';
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	if ($searchq !='') {

	$query = "select * from users where username LIKE '%$searchq%'";
	$result = mysql_query($query);
    if (mysql_num_rows($result)>0) {
    	while ($arr = mysql_fetch_array($result)) {
    		//$search_result[] = array($arr['username']);
    		//var_dump($search_result);

    		?>
    		<form method="post" enctype="multipart/form-data">
    		<button name="search-result-btn" formaction="profile.php" value="<?php
    		echo $arr['username']?>"><?php echo $arr['username']?></button>
    	</form>
    		<?php
    	}
    }
    else echo   "No result found";
}
}
	 ?>
</div>