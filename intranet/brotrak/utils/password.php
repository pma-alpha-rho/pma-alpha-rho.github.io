<?php
	session_start();
	include("../common/authentication/database.php");
	include("../common/authentication/login.php");
	
	$sql = "SELECT * FROM users WHERE user_id='{$_SESSION['user_id']}'";
	$result = mysql_query($sql) or die(mysql_error());
	$user_row = mysql_fetch_array($result);
	//$email = $user_row['email'];
	
	if(isset($_POST['pass'])) {
		if($_POST['pass'] != $_POST['conf_pass']) {
			header("Location: password.php?msg=2");
		} else {
			$name = $_POST['name'];
			$pass = md5($_POST['pass']);
			$email = $_POST['email'];
			$sql1 = "UPDATE `users` SET `password`='$pass', `name`='$name', `email`='$email' WHERE `user_id`={$_SESSION['user_id']};";
			mysql_query($sql1) or die(mysql_error());
			$_SESSION['password'] = $pass;
			header("Location: password.php?msg=1");
		}
	}
	
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="../style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="../js/form-validation.js"></script>
</head>
<body>
<div id="content-wrap">
	<?php if($logged_in) { ?>
	<span style="float: right;">Logged in as: <span style="color: green;"><?php echo $_SESSION['username']; ?></span></span>
	<?php } ?>
	<h1><?=$_SESSION['system_name']?> | <span style="font-size: 18px;">Service Point Management System</span></h1>
	<div id="left-well">
<?php
if(isset($_GET['msg'])) {
	if($_GET['msg'] == 1) {
		echo "<span style='color: green; font-size: 20px;'>Your account has been updated.</span>";
	} else if($_GET['msg'] == 2) {
		echo "<span style=' color: #cb4b4b; font-size: 20px;'>Passwords do not match.</span>";
	}
}
?>
		<h3 style="margin-bottom: 5px;">Currently editing: <span style="color: #cb4b4b;"><?=$_SESSION['username']?></span></h3><br>
		<form method="POST" action="password.php" onsubmit="return validate_form(this);">
		<b>Username</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="name" title="Please fill in your new username." value="<?=$name?>"><br><br>
		<b>New Password</b> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" size="20" name="pass" title="Please fill in your new password."><br><br>
		<b>Password (again)</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" size="20" name="conf_pass" title="Please fill in your new password twice."><br><br>
		<b>E-mail</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="email" title="Please fill in your new email." value="<?=$email?>"><br><br>
		<input type="submit" value="Update Account">
		</form>
	</div>
	<div id="menu">
		<h3>Menu</h3>
		<?php
			include('../common/menu.php');
		?>
	</div>
</div>
</body>
</html>
