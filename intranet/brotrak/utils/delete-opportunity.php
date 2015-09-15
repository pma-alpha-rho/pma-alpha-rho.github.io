<?php

session_start();
include("../common/authentication/database.php");
include("../common/authentication/login.php");

if($logged_in && $_SESSION['admin']) {

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM opportunities WHERE opp_id='$id';";
	mysql_query($sql) or die(mysql_error());
	$sql1 = "DELETE FROM registration WHERE opp_id='$id';";
	mysql_query($sql1) or die(mysql_error());
	if(!isset($_GET['skip'])) {
		header("Location: ../manage-opportunities.php?msg=3");
	}
} else {
	die('No opportunity was selected for deletion.');
}

} else {
	die('You do not have permission to access this page.');
}

?>