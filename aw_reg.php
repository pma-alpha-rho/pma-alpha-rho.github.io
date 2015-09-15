<!-- This template is what you would use if you wanted to add a page to the website.
Since there is so much going on with layouts and styling blah blah blah, just say what you want to say inside the "mainContent" division. -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="alternate" type="application/rss+xml" title="Alpha Rho News RSS" href="http://www.unc.edu/sinfonia/news/rss.php">
<title>The Alpha Rho Chapter :: Phi Mu Alpha Sinfonia</title>

<link href="secondary.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="news/display/basic/style.css" />
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
    <h1><img src="images/header.png"  alt="Alpha Rho Chapter" /></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
  <?php require_once ("menu.inc.php"); ?>
    <!-- end #sidebar1 --></div>
 
  <div id="mainContent">
  <!-- Put your content here. -->
  
  <form action="aw_attendance.php" method="post">
  Name: <input type="text" name="name"/><br/>
  Pledge Class: <input type="text" name="class"/><br/>
  Email: <input type="text" name="email"/><br/>
  <input type="checkbox" value="yes" name="playing"/> I plan to play in the basketball tournament.<br/>
  <input type="checkbox" value="yes" name="dinner"/>I plan to come to dinner.<br/>
  <br/>
  We will be presenting membership pins for brothers who have been members for 10, 25, and 50 years.
  <br />
  Please indicate when you pledged:
  <br />
  <input type="radio" name="pin" value="None" checked>I pledged after Feb 1st, 2004 (including active brothers). <br />
  <input type="radio" name="pin" value="10 years"/>I pledged before Feb 1st, 2004. <br />
  <input type="radio" name="pin" value="25 years"/>I pledged before Feb 1st, 1989. <br /> 
  <input type="radio" name="pin" value="50 years"/>I pledged before Feb 1st, 1964. <br />
  <br />
  In addition, we will be honoring brothers who have served in the military. <br />
  <input type="checkbox" value="yes" name="military"/> I served in the military. <br />
  <input type="submit"/>
  </form>
  <p>If you have any special dietary needs, please send an email to <a href="mailto:mhinkle64@yahoo.com">mhinkle64@yahoo.com</a>.</p>

  <br class="clearfloat" />
    </div>
   <div id="footer">
    <?php require_once ("footer.inc.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("tracking.inc.php"); ?></body>
</html>
