<?php
	session_start();
	include("common/authentication/database.php");
	include("common/authentication/login.php");
	
if($logged_in && $_SESSION['admin']) {
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript">
		function confirm_del() {
			return confirm("Denying approval will remove this user from this event, are you sure you want to continue?");
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
<?php if($logged_in && $_SESSION['admin']) { 

if(isset($_GET['msg'])) {
	if($_GET['msg'] == 1) {
		echo "<span style='color: green; font-size: 20px;'>Registration denial was a success.</span>";
	}
	if($_GET['msg'] == 2) {
		echo "<span style='color: green; font-size: 20px;'>Registration was successfully approved.</span>";
	}
}
?>
<h3>Control Panel</h3>
<div id="admin-menu-bg">
<ul class="admin-menu">
	<li class="admin-menu-li"><a href="admin.php">Manage Events</a></li>
	<li class="admin-menu-li"><a href="manage-opportunities.php">Manage Opportunities</a></li>
	<li class="admin-menu-li"><a href="manage-users.php">Manage Users</a></li>
	<li class="admin-menu-li"><a href="approvals.php">Approvals</a></li>
</ul>
</div>
<br>
<div class="admin-body">
<span style="margin-left: 10px;"><b>Approvals</b></span>
<br><br>
<table width="100%">
	<tr style="background-color: #eeeeee; color: #777;">
		<td class="list">Name</td>
		<td class="list">Event</td>
		<td class="list">Job</td>
		<td class="list">Status</td>
	</tr>
<?php

$sql = "SELECT * FROM registration";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)) {
	if(!$row['approved']) {
		$sql_user = "SELECT name FROM users WHERE user_id = '{$row['user_id']}'";
		$result_user = mysql_query($sql_user);
		$row_user = mysql_fetch_array($result_user);
		$user_name = $row_user['name'];
		$sql_opp = "SELECT event_id, title FROM opportunities WHERE opp_id = '{$row['opp_id']}'";
		$result_opp = mysql_query($sql_opp);
		$row_opp = mysql_fetch_array($result_opp);
		$event_id = $row_opp['event_id'];
		$opp_title = $row_opp['title'];
		$sql_event = "SELECT event_name FROM events WHERE event_id = '$event_id'";
		$result_event = mysql_query($sql_event);
		$row_event = mysql_fetch_array($result_event);
		$event_name = $row_event['event_name'];
		echo "<tr>
					<td class='list'>$user_name</td>
					<td class='list'>$event_name</td>
					<td class='list'>$opp_title</td>
					<td class='list'><a href='utils/approval-status.php?id={$row['user_id']}&o={$row['opp_id']}&a=1'>Approve</a> | <a href='utils/approval-status.php?id={$row['user_id']}&o={$row['opp_id']}&a=0' onclick='return confirm_del();'>Deny</a></td>
				</tr>";
	}
}

?>
</table>
</div>
<?php } else { ?>
You do not have permission to view this page.
<?php } ?>
	</div>
	<div id="menu">
		<h3>Menu</h3>
		<?php include('common/menu.php'); ?>
	</div>
</div>
</body>
</html>
<?php
} else {
	die('You do not have permission to access this page.');
}
?>