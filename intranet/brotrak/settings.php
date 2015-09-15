<?php
	include("common/authentication/database.php");
if(isset($_POST['form_submit'])) {
	$points_on = 0;
	if($_POST['points_on'] == "on") {
		$points_on = 1;
	}
	$updated_system_name = $_POST['system_name'];
	$updated_required_points = $_POST['required_points'];
	$sql = "UPDATE `settings` SET `points_on`='$points_on', `system_name`='$updated_system_name', `required_points`='$updated_required_points'";
	mysql_query($sql) or die(mysql_error());
}
	session_start();
	include("common/authentication/login.php");
if($logged_in && $_SESSION['admin']) {
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="style.css" type="text/css" rel="stylesheet">
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
	echo "<span style='color: green; font-size: 20px;'>Settings have been saved.</span>";
}

?>

<h3>Control Panel</h3>
<b>General Settings:</b><br><br>
<form action="settings.php?msg=1" method="POST">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="system_name" value="<?=$_SESSION['system_name']?>"><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Opportunities have point values: &nbsp;<input type="checkbox" name="points_on" <?php if($_SESSION['points_on']) { echo "checked"; } ?>><input type="hidden" name="form_submit" value="its_set"><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Required Points: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="3" name="required_points" value="<?=$_SESSION['required_points']?>"><br><br>
<br><br><br>
<input type="submit" value="Save Settings">
</form>

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
<?php
} else {
	die('You do not have permission to access this page.');
}
?>