<?php
if($logged_in) {
?>
<ul>
	<li><a href="../index.php">Calendar</li>
	<li><a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>">My Profile</li>
	<?php if($_SESSION['admin']) { ?>
	<li><a href="../admin.php">Control Panel</a></li>
	<li><a href="../settings.php">Settings</a></li>
	<?php } ?>
	<li><a href="../utils/password.php";>My Account</a></li>
	<li><a href="../common/authentication/logout.php">Logout</a></li>
	<?php if($username='Alex Basinger') {
	echo "<li><a href="treasurer/treasurer.php">Treasurer App</a></li>"};
	?>
	<?php if($_SESSION['username'] == 'Zach Mitchell') {
	echo "<li><a href="test">Test Area</a></li>"};
	?>
<ul>
<?php
}
?>
