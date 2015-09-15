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
			return confirm("Are you sure you want to delete this user?");
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
		echo "<span style='color: green; font-size: 20px;'>User successfully added.</span>";
	} else if($_GET['msg'] == 2) {
		echo "<span style='color: green; font-size: 20px;'>User successfully updated.</span>";
	} else if($_GET['msg'] == 3) {
		echo "<span style='color: green; font-size: 20px;'>User successfully deleted.</span>";	
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
<span style="margin-left: 10px;"><b>User Account Manager</b></span>
<span style="float: right;"><a href="utils/add-user.php" style="color: #cb4b4b; border: none;">+ Add User</a></span>
<br><br>
<table width="100%" class="sortable">
<thead>
	<tr style="background-color: #eeeeee; color: #777;">
		<td class="list">Name</td>
		<td class="list">Admin</td>
		<td class="list">Points</td>
		<td class="sorttable_nosort">Manage</td>
	</tr>
</thead>
<?php

$sql = "SELECT * FROM users ORDER BY `points` DESC";
$sql1 = "SELECT * FROM settings";
$result = mysql_query($sql);
$result1 = mysql_query($sql1);
$settings = mysql_fetch_array($result1);
$total_points = 0;
echo "<tbody>";

while($row = mysql_fetch_array($result)) {
	echo "<tr>
				<td class='list'><a href='profile.php?id={$row['user_id']}'>{$row['name']}</a></td>
				<td class='list'>";
				if($row['admin']) {
					echo "<a href='utils/admin-status.php?id={$row['user_id']}&a=0'>Remove Admin</a>";
				} else {
					echo "<a href='utils/admin-status.php?id={$row['user_id']}&a=1'>Make Admin</a>";
				}
	echo "</td>";
				if ($row['points'] >= $settings['required_points']) {
					echo "<td class = 'list' align = 'center' style='background-color:#B2FFB2; color:#006E00'>";
				} else {
					echo "<td class = 'list' align = 'center' style='background-color:#FFFFC1; color:#E6B800'>";
				}
				echo "<b>{$row['points']}</td>
				<td class='list'><a href='utils/edit-user.php?id={$row['user_id']}'>Edit</a> | <a href='utils/delete-user.php?id={$row['user_id']}' onclick='return confirm_del();'>Delete</a></td>
			</tr>";
$total_points += $row['points'];
}
echo "</tbody><tfoot><tr style = 'background-color: #eeeeee; color: #777;'>
		<td class='list' colspan = '2'>Total Points</td>
		<td class='list' colspan = '2'>{$total_points}</td>
		<tr>";

?>
</tfoot>
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
