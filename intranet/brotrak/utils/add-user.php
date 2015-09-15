<?php
	session_start();
	include("../common/authentication/database.php");
        include("../common/authentication/login.php");
	
if($logged_in && $_SESSION['admin']) {
	
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
		$clean_pass = $_POST['password'];
		$pass = md5($clean_pass);
		$admin = $_POST['admin'];
		$email = $_POST['email'];
		if($admin == "on") {
			$admin = 1;
		} else {
			$admin = 0;
		}
		$sql = "INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `admin`, `points`) VALUES (NULL, '$name', '$pass', '$email', '$admin', 0);";
		require '../PHPMailer/PHPMailer/PHPMailerAutoload.php';
		mysql_query($sql) or die(mysql_error());
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0; $mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "alpharhocalender@gmail.com";
		$mail->Password = "IWishToBe";
		$mail->setFrom('webmaster@pma-alpha-rho.org', 'Webmaster');
		//Set an alternative reply-to address
		$mail->addReplyTo('mjlitzster@gmail.com', 'Matt Litzsinger');
		$mail->addAddress("{$registrant['email']}", "{$registrant['name']}");
		$mail->Subject = "[pma] Your {$_SESSION['system_name']} account has been set up.";
		$mail->msgHTML("An account has been set up for you in the {$_SESSION['system_name']} system.  You may log in to your account with the following credentials:<br><br><b>username</b>: $name<br><b>password</b>: $clean_pass<br><br>Once you log in, you'll be able to change your password.<br><br>OAS AAS LLS,<br>{$_SESSION['system_name']}");
		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			echo "<span style='color: red; font-size: 24px;'>Message sending failed, please contact the Tech Director.</span><br><br>";
		}
		header("Location: ../manage-users.php?msg=1");
	}

?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="../style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="../js/form-validation.js"></script>
	<script type="text/javascript">
	function randomPassword(length, field) {
		e = document.getElementById(field);
		chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		pass = "";
		for(x=0;x<length;x++) {
			i = Math.floor(Math.random() * 62);
			pass += chars.charAt(i);
		}
		e.value=pass;
		return false;
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
		<h3 style="margin-bottom: 5px;">Add a User</h3>
		<a href="../manage-users.php"><div style="margin-bottom: 25px;"><- Return to Control Panel</div></a>
		<form method="POST" action="add-user.php" onsubmit="return validate_form(this);">
		<b>Name</b> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="name" title="Please fill in your name."><br><br>
		<b>Password</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" size="20" id="pass" name="password" title="Please fill in your password."> &nbsp;<br><br>
		<b>E-mail</b> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="email" title="Please fill in your email."><br><br>
		<b>Is Admin</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="admin">
		<input type="submit" value="Add User" style="float: right;">
		</form>
	</div>
	<div id="menu">
		<h3>Menu</h3>
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
        <li><a href="password.php";>My Account</a></li>
        <li><a href="../../common/authentication/logout.php">Logout</a></li>
<ul>
<?php
}
?>
	</div>
 </div>
</body>
</html>

<?php
} else {
	die('You do not have permission to access this page.');
}
?>
