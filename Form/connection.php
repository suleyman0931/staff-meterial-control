<?php
define("db_server","localhost");
define("db_user","root");
define("db_name","registration");
define("db_password","");
$conn=mysql_connect(db_server,db_user,db_name,db_password) or die("Error in connection".mysql_error());
$db_select=mysql_select_db(db_name,$conn) or die("Error in db selection".mysql_error());
?>