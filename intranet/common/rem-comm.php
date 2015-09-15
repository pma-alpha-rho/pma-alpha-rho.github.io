<?php

require_once('db_conn.php');

$commId = $_GET['id'];

$sql = "DELETE FROM gen_comments WHERE label='$commId'";
mysql_query($sql);

header("Location: /intranet/the-board.php");

?>
	
