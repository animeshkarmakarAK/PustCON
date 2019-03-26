<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/profilepage.css">
</head>
<body>

	<div class="for_textarea clear">
<form action="profile.php#basic_info" method="post">

<h4>Add Birthdate</h4>
<select name="day">
<?php
for($i=1;$i<=31;$i++)
{
    echo '<option value='.$i.'>'.$i.'</option>';
}
?>

<select name="month">
	<?php 
	for ($i="January"; $i <"December" ; $i++) { 
	 	echo '<option value='.$i.'>'.$i.'</option>';
	 } ?>
</select>

<select name="month">
<option value="January">January</option>
<option value="February">February</option>
<option value="Mars">Mars</option>
<option value="April">April</option>
<option value="May">May</option>
<option value="June">June</option>
<option value="July">July</option>
<option value="September">September</option>
<option value="October">October</option>
<option value="November">November</option>
<option value="December">December</option>
</select>

<select name="year">
<?php
for($i=2017;$i>=1950;$i--)
{
    echo '<option value='.$i.'>'.$i.'</option>';
}

?>
</select>
<br/><br/>
<button name="bd-btn">Add</button>
</form>

</div>
</body>
</html>