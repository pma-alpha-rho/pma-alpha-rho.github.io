<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>The Alpha Rho Chapter :: Phi Mu Alpha Sinfonia</title>

<link href="../secondary.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.thrColLiqHdr #sidebar2, .thrColLiqHdr #sidebar1 { padding-top: 30px; }
.thrColLiqHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->

</head>

<body class="thrColLiqHdr">

<div id="container">
 <div id="header">
    <h1><img src="../images/header.png"  alt="Alpha Rho Chapter" /></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
  <?php require_once ("../menu.inc.php"); ?>
    <!-- end #sidebar1 --></div>
 
  <div id="mainContent">
  <h3>Alumni Weekend 2011</h3>
<?php
if(isset($_GET['msg'])) {
	if($_GET['msg'] == 1) {
		echo "<span style='color: green; font-size: 24px;'>Thank you for your RSVP!</span><br><br>";
	} else {
		echo "<span style='color: red; font-size: 24px;'>There was an error sending your RSVP.</span><br><br>Contact <a href='mailo:geoffmackey2@gmail.com' style='color: red;'>Geoff Mackey</a> if this problem persists.<br><br>";
	}
}

?>
<div>
<div style="float: left; width: 45%; padding: 10px; border: 1px solid #eeeeee;">
<b>Schedule</b><br><br>
<i>Friday:</i><br><br>
7pm - Dinner (Room 3206 A and B Frank Porter Graham Student Union.)<br>
9pm - Brother and Alumni Meeting (Person Recital Hall)<br><br>
<i>Saturday:</i><br><br>
7am - Basketball Tournament tip-off (Rams Head Gym)<br>
4pm - UNC vs. Boston College Basketball (Dean E. Smith Center)<br><br>
<span style="font-size:small">
*The Dance Marathon Fundraiser, which thousands of students participate in, will be occurring in Fetzer Gym during both the dinner and basketball tournament.  This will make parking difficult, and you may not be able to use Cobb or Rams deck.  The 54 lot near Jackson Hall or Franklin st. will likely be your best options.
</span>
</div>
<div style="float: right; width: 45%; padding: 10px; border: 1px solid #eeeeee;">
<b>Guest List</b><br><br>
<?php


$username="geoff";
$password="spider";
$database="alumni_weekend";
mysql_connect('152.2.45.143',$username,$password);
mysql_select_db($database) or die( "Unable to select database");

$sql = "SELECT * FROM attending";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
	echo "{$row['name']}, {$row['pledge']}<br>";
}

?>
</div>
<div style="clear: both;"></div>
</div>
<br>
To rsvp, fill out the form below and tell us which events you plan to attend.  See you soon!<br><br>
<form method="POST" action="send_rsvp.php">
Name: <input type="text" size="20" name="name"><br><br>
Pledge Class: <input type="text" size="20" name="pledge"><br><br>
Email: <input type="text" size="20" name="email"><br><br>
RSVP:<br><br>
<textarea name="rsvp" rows="5" cols="50"></textarea><br><br>
<input type="submit" value="Submit">
</form>
  </div> <!-- end #mainContent -->
  <div id="footer">
    <?php require_once ("../footer.inc.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("../tracking.inc.php"); ?></body>
</html>
