<?php 
session_start();
$_SESSION['gname'] = $_POST['$g_name'];
header("Location:postpage.php");
 ?>