<?php 
session_start();
include("./inc/connection.php");

$u = "update users set activated = '0' where id = '{$_SESSION['id']}'";
$q = mysql_query($u) or die(mysql_error());

unset($_SESSION['username']);
session_unset();
session_destroy();
header("Location:index.php");
exit();
 ?>