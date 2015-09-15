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
	<script src="./js/sorttable.js" type="text/javascript"></script>
	<script type="text/javascript">
		function confirm_del() {
			return confirm("Deleting this opportunity will also void any registrations associated with it, are you sure you want to continue?");
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
		echo "<span style='color: green; font-size: 20px;'>Opportunity successfully added.</span>";
	} else if($_GET['msg'] == 2) {
		echo "<span style='color: green; font-size: 20px;'>Opportunity successfully updated.</span>";
	} else if($_GET['msg'] == 3) {
		echo "<span style='color: green; font-size: 20px;'>Opportunity successfully deleted.</span>";	
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
<span style="margin-left: 10px;"><b>Opportunity Manager</b></span>
<span style="float: right;"><a href="utils/add-opportunity.php" style="color: #cb4b4b; border: none;">+ Add Opportunity</a></span>
<br><br>
<table width="100%" class="sortable">
	<tr style="background-color: #eeeeee; color: #777;">
		<td class="list">Opportunity</td>
		<td class="list">Event</td>
		<?php if($_SESSION['points_on']) { ?>
		<td class="list">Point Value</td>
		<?php } ?>
		<td class="list">Slots Remaining</td>
		<td class="list">Manage</td>
	</tr>
<?php

$sql = "SELECT * FROM opportunities ORDER BY event_id DESC";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)) {
	$sql2 = "SELECT * FROM events WHERE event_id='{$row['event_id']}'";
	$result2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	echo "<tr>
				<td class='list'>{$row['title']}</td>
				<td class='list'><a href='display-event.php?id={$row['event_id']}'>{$row2['event_name']}</td>";
				if($_SESSION['points_on']) {
					echo "<td class='list' align='right'>{$row['value']}</td>";
				}
				echo "
				<td class='list' align='right'>{$row['slots']}</td>
				<td class='list'><a href='utils/edit-opportunity.php?id={$row['opp_id']}'>Edit</a> | <a href='utils/delete-opportunity.php?id={$row['opp_id']}' onclick='return confirm_del();'>Delete</a></td>
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
<?php
} else {
	die('You do not have permission to access this page.');
}
?>