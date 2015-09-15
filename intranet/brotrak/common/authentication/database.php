<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '0nc3And4lw4y$!';
$dbname = 'brotrak';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql: ' . mysql_error());

mysql_select_db($dbname);

?>
