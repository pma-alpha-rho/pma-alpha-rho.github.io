<?php
	session_start();
	
	include("database.php");
	include("login.php");
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="../../style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div id="content-wrap">
	<h1><?=$_SESSION['system_name']?> | <span style="font-size: 18px;">Service Point Management System</span></h1>
	<div id="left-well">
<?php

if(!$logged_in){
   echo "<h1>Error!</h1>\n";
   echo "You are not currently logged in, logout failed. <br /><br /> <a href='../../index.php'>Return Home</a>";
}
else{

// Unset all of the session variables.
$_SESSION = array();
$_COOKIE = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
setcookie("cookname", "", time()-3600);
setcookie("cookpass", "", time()-3600);

// Finally, destroy the session.
session_destroy();

   echo "<h1>Logged Out</h1>\n";
   echo "You have successfully <b>logged out</b>. <br /><br /> <a href='../../index.php'>Return Home</a>";
}

?>
	</div>
	<div id="menu">
		<h3>Menu</h3>
	</div>
</div>
</body>
</html>