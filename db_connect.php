<?php
$conn = mysql_connect('localhost','root','123') or die("Error:".mysql_error());
mysql_select_db('sutilities',$conn) or die("Error:".mysql_error());
?>