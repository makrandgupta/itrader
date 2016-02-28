<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Sutilities = "localhost";
$database_Sutilities = "sutilities";
$username_Sutilities = "root";
$password_Sutilities = "123";
$Sutilities = mysql_pconnect($hostname_Sutilities, $username_Sutilities, $password_Sutilities) or trigger_error(mysql_error(),E_USER_ERROR); 
?>