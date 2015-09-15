<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php
	session_start();
	include("brotrak/common/authentication/database.php");
	include("brotrak/common/authentication/login.php");
	include("brotrak/utils/time-functions.php");
	if($logged_in) {
		?>
   <title>PMA Sinfonia Intranet</title>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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

<!--<div id="fileBrowser">
<iframe src="Files/ft2.php" style="border-width: 0;" width="100%" height="400" frameborder="0"></iframe>
</div>-->
<!--<div id="theObject">-->
<div id="resultDiv" style="position: absolute; top: 125px; left: 325px; background-color: #ffcaca; border: 3px solid #ff8484; padding: 10px; display: none;">
</div>
   <div style="position: absolute; left: 40%; width: 1000px; margin-left: -500px; top: 140px;">
		<iframe src="https://www.google.com/calendar/embed?src=alpharhocalender%40gmail.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="yes"></iframe>
	</div>
<!--<iframe src="//www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=350&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=pma.alpha.rho%40gmail.com&amp;color=%2328754E&amp;ctz=America%2FNew_York" style=" border-width:0 " width="300" height="420" frameborder="0" scrolling="yes"></iframe>-->
<!--</div>-->
<?php } ?>

<div id="left-well">
	<?php
			displayLogin();
	?>
</div>
</body>
</html>
