<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<?php
	
	session_start();
	include("brotrak/common/authentication/database.php");
	include("brotrak/common/authentication/login.php");
	include("brotrak/utils/time-functions.php");
	if($logged_in == 0) {
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=intranet-login.php\">";
	} ?>
<head>
   <title>PMA Sinfonia Intranet</title>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
   <script type="text/javascript" src="jquery/filetree/jquery.js"></script>
   <script type="text/javascript" src="jquery/process.js"></script>
   <link href="jquery/filetree/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
   <link href="css/menu-tabs.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="header">
   <a href="http://pma-alpha-rho.org">
      <img src="images/phimualpha.jpg" style="border: 0px;" alt="Alpha Rho" title="Alpha Rho Homepage" />
   </a>
   <div id="menu">
      <?php
         include('common/menu.php');
      ?>
   </div>
</div>
<div id="resultDiv" style="position: absolute; top: 125px; left: 325px; background-color: #ffcaca; border: 3px solid #ff8484; padding: 10px; display: none;">
</div>
   <div style="position: absolute; left: 50%; width: 600px; margin-left: -300px; top: 140px;">
      <?php
         include('common/board-main.php');
      ?>
   </div>
</body>
</html>
