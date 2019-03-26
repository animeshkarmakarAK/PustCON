<?php 
session_start();
$_SESSION['gname'] = $_POST['nnn'];
header("Location:postpage.php");


 ?>