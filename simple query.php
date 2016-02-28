<?php

require_once ("db_connect.php");

#header('Content-type: image/jpg');

$query = mysql_query("SELECT * FROM images");
$row = mysql_fetch_array($query);
$rownum= mysql_num_rows($query);
echo $rownum."<br>";
$n=1;
for ($i=1; $i<=$rownum;$i++){
$content = $row['img_url'];
echo $n."&nbsp;".$content."<br>";
$n++;
}
?> 