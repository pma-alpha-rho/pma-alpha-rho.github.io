<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	include("brotrak/common/authentication/database.php");
	include("login.php");
	include("brotrak/utils/time-functions.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
   <title>PMA Sinfonia Intranet</title>
   <link rel="icon" type=image/jpg href="images/favicon.ico"
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
   <link href="jquery/filetree/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
   <link href="css/menu-tabs.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="content-wrap">
	
	<div id="left-well">
		<?php
				displayLogin();
		?>
	</div>
	
	
	<?php 
		$logged_in = checkLogin();
		if($logged_in == true) { ?>
		<meta http-equiv="REFRESH" content="0;url=index.php">
	<?php } ?>
</div>

</body>
</html>
