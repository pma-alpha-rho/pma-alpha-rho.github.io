<?php
if($logged_in) {
?>
<ul>
	<li><a href="/intranet/brotrak/index.php">Calendar</li>
	<li><a href="/intranet/brotrak/profile.php?id=<?php echo $_SESSION['user_id']; ?>">My Profile</li>
	<?php if($_SESSION['admin']) { ?>
	<li><a href="/intranet/brotrak/admin.php">Control Panel</a></li>
	<li><a href="/intranet/brotrak/settings.php">Settings</a></li>
	<?php } ?>
	<li><a href="/intranet/brotrak/utils/password.php";>My Account</a></li>
	<li><a href="/intranet/brotrak/common/authentication/logout.php">Logout</a></li>
	<?php /*if($_SESSION['username'] == 'mlitz') { ?>
	<li><a href="/intranet/brotrak/treasurer/treasurer.php">Treasurer App</a></li>
	<li><a href="/intranet/brotrak/test">Test Area</a></li>
	<?php } */?>
<ul>
<?php
}
?>
