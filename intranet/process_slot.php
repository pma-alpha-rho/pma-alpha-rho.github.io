<?php

$name = $_GET['slot'];
$day = $_GET['date'];

$dbhost = '152.2.45.143:3306';
$dbuser = 'geoff';
$dbpass = 'spider';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'pma_ushering';
mysql_select_db($dbname);

$query = "INSERT INTO list (name, date) VALUES ('".$name."', '".$day."')";

mysql_query($query) or die('Error, insert query failed');

echo "Thank you for signing up, ".$name;

?>
