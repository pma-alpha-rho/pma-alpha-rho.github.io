<?php

if ($_SESSION['admin']) {
require_once('db_conn.php');
$name = $_POST['name'];
$counter = md5($name.$comment.$thedate);
$comment = $_POST['comment'];
$thedate = date("M dS, Y \a\\t g:ia");
$sql = "INSERT INTO gen_comments(label,name,comment,post_date) VALUES('$counter','$name','$comment','$thedate')";
mysql_query($sql);
}

header("Location: ../the-board.php");

#?>
