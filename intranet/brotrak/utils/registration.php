<?php
session_start();
include("../common/authentication/database.php");
include("../common/authentication/login.php");
	
$user_id = $_GET['uid'];
$opp_id = $_GET['oid'];
$action = $_GET['action'];
$referrer = $_GET['ref'];
if(($logged_in && $_SESSION['admin']) || ($logged_in && $_SESSION['user_id'] == $user_id)) {
if($referrer == "app") {
	$ref_url = "../approvals.php?msg=1";
} else if($referrer == "prof") {
	$ref_url = "../profile.php?id=$user_id";
} else if($referrer == "event") {
	$event_id = $_GET['eid'];
	$ref_url = "../display-event.php?id=$event_id";
}

if($action == "rem") {
	// remove user from registration
	$sql = "DELETE FROM registration WHERE user_id='$user_id' AND opp_id='$opp_id';";
	mysql_query($sql) or die(mysql_error());
	$sql2 = "SELECT * FROM opportunities WHERE opp_id='$opp_id'";
	$result = mysql_query($sql2) or die(mysql_error());
	$row = mysql_fetch_array($result);
	$slots_left = $row['slots'];
	$slots_left = $slots_left+1;
	$sql3 = "UPDATE `opportunities` SET `slots`='$slots_left' WHERE `opp_id`=$opp_id;";
	mysql_query($sql3) or die(mysql_error());
	header("Location: $ref_url");
} else if($action == "add") {
	// add user registration
	$sql1 = "INSERT INTO `registration` (`user_id`, `opp_id`, `approved`, `reminder_sent`) VALUES ('$user_id', '$opp_id', 0, 0);";
	mysql_query($sql1) or die(mysql_error());
	$sql4 = "SELECT * FROM opportunities WHERE opp_id='$opp_id'";
	$result1 = mysql_query($sql4) or die(mysql_error());
	$row1 = mysql_fetch_array($result1);
	$slots_left1 = $row1['slots'];
	$slots_left1 = $slots_left1-1;
	$sql5 = "UPDATE `opportunities` SET `slots`='$slots_left1' WHERE `opp_id`=$opp_id;";
	mysql_query($sql5) or die(mysql_error());
	header("Location: $ref_url");
}
} else {
?>
<span style="color: red;">You do not have permission to access this page.</span>
<?php
}
?>