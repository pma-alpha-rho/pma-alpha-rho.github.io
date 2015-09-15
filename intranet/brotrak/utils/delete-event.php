<?php

session_start();
include("../common/authentication/database.php");
include("../common/authentication/login.php");

if($logged_in && $_SESSION['admin']) {

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM opportunities WHERE event_id='$id';";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)) {
		$sql1 = "DELETE FROM opportunities WHERE opp_id='{$row['opp_id']}';";
		mysql_query($sql1) or die(mysql_error());
		$sql2 = "DELETE FROM registration WHERE opp_id='{$row['opp_id']}';";
		mysql_query($sql2) or die(mysql_error());
	}
	$sql3 = "DELETE FROM events WHERE event_id='$id';";
	mysql_query($sql3) or die(mysql_error());
	header("Location: ../admin.php?msg=3");
} else {
	die('No event was selected for deletion.');
}

} else {
	die('You do not have permission to access this page.');
}

?>