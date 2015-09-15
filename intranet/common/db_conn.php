<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '0nc3And4lw4y$!';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'the_board';
mysql_select_db($dbname);

?>
