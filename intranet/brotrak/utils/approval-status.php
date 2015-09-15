<?php
session_start();
include("../common/authentication/database.php");
include("../common/authentication/login.php");
$user_id = $_GET['id'];
$opp_id = $_GET['o'];
$approval = $_GET['a'];	
	if($logged_in && $_SESSION['admin']) {
		if($_GET['a'] == 1) {
		$sql2 = "SELECT `value` FROM opportunities WHERE `opp_id` = $opp_id;";
		$sql = "UPDATE `registration` SET `approved`='$approval' WHERE `user_id`=$user_id AND `opp_id` =$opp_id;";
		$result = mysql_query($sql2);
		$row = mysql_fetch_array($result);
		$added_points += $row['value'];
		$sql1 = "UPDATE `users` SET `points`=`points` + $added_points WHERE `user_id`=$user_id;";
		mysql_query($sql) or die(mysql_error());
		mysql_query($sql1) or die(mysql_error());
		header("Location: ../approvals.php?msg=2");
		} else {
			header("Location: registration.php?uid=$user_id&oid=$opp_id&action=rem&ref=app");
		}
	} else {
?>
<span style="color: red;">You do not have permission to access this page.</span>
<?php
}
?>