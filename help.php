<?php 
session_start();
$_SESSION['gname'] = $_POST['nnnn'];
header("Location:postpage.php");


 ?>