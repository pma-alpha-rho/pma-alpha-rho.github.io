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
<table width="100%">
	<tr style="background-color: #eeeeee; color: #777;">
		<td class="list">Name</td>
		<td class="list">Admin</td>
		<td class="list">Manage</td>
	</tr>
<?php

$sql = "SELECT * FROM users";
$result = mysql_query($sql);
USE users
SHOW TABLES;

//while($row = mysql_fetch_array($result)) {
//}

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
