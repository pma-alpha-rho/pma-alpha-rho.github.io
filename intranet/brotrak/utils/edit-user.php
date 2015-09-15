<?php
	session_start();
	include("../common/authentication/database.php");
	include("../common/authentication/login.php");
	
	if(isset($_POST['name'])) {
		$user_id = $_GET['id'];
		$name = $_POST['name'];
		$pass = md5($_POST['password']);
		$admin = $_POST['admin'];
		//$email = $_POST['email'];
		if($admin == "on") {
			$admin = 1;
		} else {
			$admin = 0;
		}
		$sql1 = "UPDATE `users` SET `user_id`='$user_id', `name`='$name', `password`='$pass', `admin`='$admin' WHERE `user_id`=$user_id;";
		mysql_query($sql1) or die(mysql_error());
		header("Location: ../manage-users.php?msg=2");
	}
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM users WHERE user_id='$id';";
		$result = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_array($result)) {
			$user_name = $row['name'];
			$admin = $row['admin'];
		#	$email = $row['email'];
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
		<h3 style="margin-bottom: 5px;">Currently editing: <span style="color: #cb4b4b;"><?=$user_name?></span></h3>
		<a href="../manage-users.php"><div style="margin-bottom: 25px;"><- Return to Control Panel</div></a>
		<form method="POST" action="edit-user.php?id=<?=$id?>" onsubmit="return validate_form(this);">
		<b>Name</b> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="name" title="Please fill in your name." value="<?=$user_name?>"><br><br>
		<b>Password</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" size="20" name="password" title="Please fill in a password." value="<?=$password?>"><br><br>
		<b>Is Admin</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="admin"<?php if($admin) { echo " checked"; } ?>>		<input type="submit" value="Update User" style="float: right;">
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
