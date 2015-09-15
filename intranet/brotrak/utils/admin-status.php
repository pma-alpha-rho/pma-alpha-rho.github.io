<?php
	session_start();
	include("../common/authentication/database.php");
	include("../common/authentication/login.php");
	
	if($logged_in && $_SESSION['admin']) {
		$user_id = $_GET['id'];
		$admin_status = $_GET['a'];
		$sql = "UPDATE `users` SET `admin`='$admin_status' WHERE `user_id`=$user_id;";
		mysql_query($sql) or die(mysql_error());
		header("Location: ../manage-users.php");
	} else {
?>
<span style="color: red;">You do not have permission to access this page.</span>
<?php
}
?>