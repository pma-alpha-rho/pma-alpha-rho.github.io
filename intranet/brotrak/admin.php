<?php
	session_start();
	include("common/authentication/database.php");
	include("common/authentication/login.php");
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript">
		function confirm_del() {
			return confirm("WARNING: Deleting this event will also delete all opportunities and registrations associated with it, are you sure you want to continue?");
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
		echo "<span style='color: green; font-size: 20px;'>Event successfully added.</span>";
	} else if($_GET['msg'] == 2) {
		echo "<span style='color: green; font-size: 20px;'>Event successfully updated.</span>";
	} else if($_GET['msg'] == 3) {
		echo "<span style='color: green; font-size: 20px;'>Event successfully deleted.</span>";	
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
<span style="margin-left: 10px;"><b>Event Manager</b></span>
<span style="float: right;"><a href="utils/add-event.php" style="color: #cb4b4b; border: none;">+ Add Event</a></span>
<br><br>
<table width="100%">
	<tr style="background-color: #eeeeee; color: #777;">
		<td class="list">Event Name</td>
		<td class="list">Date</td>
		<td class="list">Manage</td>
	</tr>
<?php

$sql = "SELECT * FROM events ORDER BY date DESC";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)) {
	$event_date = $row['date'];
	echo "<tr>
				<td class='list'><a href='display-event.php?id={$row['event_id']}'>{$row['event_name']}</a></td>
				<td class='list'>";
				echo $event_date[5].$event_date[6]."/".$event_date[8].$event_date[9]."/".substr($event_date,0,4);
				echo "</td>
				<td class='list'><a href='utils/edit-event.php?id={$row['event_id']}'>Edit</a> | <a href='utils/delete-event.php?id={$row['event_id']}' onclick='return confirm_del();'>Delete</a></td>
			</tr>";
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
