<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conalliance = "localhost";
$database_conalliance = "alliance";
$username_conalliance = "root";
$password_conalliance = "";
$conalliance = mysql_pconnect($hostname_conalliance, $username_conalliance, $password_conalliance) or trigger_error(mysql_error(),E_USER_ERROR); 
?>