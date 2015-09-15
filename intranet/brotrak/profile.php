<?php
session_start();
include("common/authentication/database.php");
include("common/authentication/login.php");

if(isset($_GET['id'])) {
	$user_id_page = $_GET['id'];
} else {
	$user_id_page = $_SESSION['user_id'];
}
$sql = "SELECT * FROM users WHERE user_id='$user_id_page'";
$result = mysql_query($sql) or die(mysql_error());
$user = mysql_fetch_array($result);
$sql1 = "SELECT * FROM registration WHERE user_id='$user_id_page'";
$reg_result = mysql_query($sql1);
$sql2 = "SELECT * FROM registration WHERE user_id='$user_id_page'";
$reg_result1 = mysql_query($sql2);
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript">
		function confirm_del() {
			return confirm("Are you sure you want to remove yourself from this event?");
		}
	</script>
</head>
<body>
<div id="content-wrap">
	<?php if($logged_in) { ?>
	<span style="float: right;">Logged in as: <span style="color: green;"><?php echo $_SESSION['username']; ?></span></span>
	<?php } ?>
	<h1><?=$_SESSION['system_name']?> | <span style="font-size: 18px;">Service Point Management System</span></h1>
	<div id="left-well">
<?php if($logged_in) { 
?>
<h3><?=$user['name']?></span></h3>
<div style='border-bottom: 1px solid #ddd; background-color: #eee; padding: 10px;'>
<b>Approved Commitments</b>
<ul>
<?php
$count = 0;
$total_points = 0;
while($reg_row = mysql_fetch_array($reg_result)) {
	if($reg_row['approved'] == 1) {
		$opp_sql = "SELECT * FROM opportunities WHERE opp_id='{$reg_row['opp_id']}'";
		$opp_result = mysql_query($opp_sql) or die(mysql_error());
		$opp_row = mysql_fetch_array($opp_result);
		$event_sql = "SELECT * FROM events WHERE event_id='{$opp_row['event_id']}'";
		$event_result = mysql_query($event_sql) or die(mysql_error());
		$event_row = mysql_fetch_array($event_result);
		echo "<li>".$opp_row['title']." <i>at</i> <a href='display-event.php?id={$opp_row['event_id']}'>".$event_row['event_name']."</a> ";
		if($_SESSION['admin'] || $user_id_page == $_SESSION['user_id']) {
		echo "| <a href='utils/registration.php?uid=$user_id_page&oid={$opp_row['opp_id']}&eid={$event_row['event_id']}&action=rem&ref=prof' onclick='return confirm_del();'><span style='color: #cb4b4b;'>Cancel Commitment</span></a>";
		}
		if($_SESSION['points_on'] == 1) {
			echo "<br>Point Value: <span style='color: green;'>{$opp_row['value']}</span>"; 
			$total_points += $opp_row['value'];
		}
		echo "</li>";
		$count++;
	}
}
if($count == 0) {
	echo "<li>{$user['name']} does not have any approved commitments.</li>";
}
?>
</ul>
<?php
if($_SESSION['points_on']) {
	echo "<span style='font-size: 18px; color: green;'>".$user['name']." has a total of ".$total_points." approved points.</span>";
	$sql_points = "SELECT * FROM users WHERE user_id={$user['user_id']};";
	$sql_points2 = "UPDATE `users` SET `points`=$total_points WHERE user_id={$user['user_id']};";
		mysql_query($sql_points) or die(mysql_error());
		mysql_query($sql_points2) or die(mysql_error());
}
?>
</div>
<br><br>
<b>Pending Commitments</b>
<ul>
<?php
$count = 0;
while($reg_row1 = mysql_fetch_array($reg_result1)) {
	if($reg_row1['approved'] == 0) {
		$opp_sql1 = "SELECT * FROM opportunities WHERE opp_id='{$reg_row1['opp_id']}'";
		$opp_result1 = mysql_query($opp_sql1) or die(mysql_error());
		$opp_row1 = mysql_fetch_array($opp_result1);
		$event_sql1 = "SELECT * FROM events WHERE event_id='{$opp_row1['event_id']}'";
		$event_result1 = mysql_query($event_sql1) or die(mysql_error());
		$event_row1 = mysql_fetch_array($event_result1);
		echo "<li>".$opp_row1['title']." <i>at</i> <a href='display-event.php?id={$opp_row1['event_id']}'>".$event_row1['event_name']."</a> ";
		if($_SESSION['admin'] || $user_id_page == $_SESSION['user_id']) {
		echo "| <a href='utils/registration.php?uid=$user_id_page&oid={$opp_row1['opp_id']}&eid={$event_row1['event_id']}&action=rem&ref=prof' onclick='return confirm_del();'><span style='color: #cb4b4b;'>Cancel Commitment</span></a>";
		}
		if($_SESSION['points_on'] == 1) {
			echo "<br>Point Value: <span style='color: green;'>{$opp_row1['value']}</span>"; 
		}
		echo "</li>";
		$count++;
	}
}
if($count == 0) {
	echo "<li>{$user['name']} does not have any pending commitments.</li>";
}
mysql_close($conn);
?>
</ul>
</div>
<?php } else { ?>
You do not have permission to view this page.
<?php } ?>

	<div id="menu">
		<h3>Menu</h3>
		<?php include('common/menu.php'); ?>
	</div>
</div>
</body>
</html>
