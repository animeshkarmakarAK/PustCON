<?php
@mysql_connect("localhost","root","") or die("couldn't connect to the database");
@mysql_select_db("dbtest") or die("couldn't select the database");

$query = mysql_query("INSERT INTO admin values('2','animesh','karmakar')");

  ?>