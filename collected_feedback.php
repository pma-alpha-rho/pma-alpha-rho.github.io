<?php
// include the script at the _top_
include('news/news_home.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="alternate" type="application/rss+xml" title="Alpha Rho News RSS" href="http://www.unc.edu/sinfonia/news/rss.php">
<title>The Alpha Rho Chapter :: Phi Mu Alpha Sinfonia</title>

<link href="primary.css" rel="stylesheet" type="text/css" />
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
    <h1><img src="images/header.png" alt="Alpha Rho Chapter" /></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
  <?php require_once ("menu.inc.php"); ?>
    <!-- end #sidebar1 --></div>
  <div id="sidebar2">
<!-- BEGIN UPCOMING EVENTS

Type in upcoming events in this format:

<p>TITLE OF EVENT<br />
DATE OF EVENT<br />
TIME OF EVENT</p>

Example
<h3>Upcoming Events</h3>
<p>Spring Cookout<br />
April 28, 2009<br />
1PM
</p>
<p>Halo 3 Tournament<br />
April 28, 2009<br />
7:30PM
</p>
-->
<!-- END UPCOMING EVENTS -->
<a href="donate.php">
	<div class="notify">
		Donate to the Alpha Rho Fund
	</div>
</a>
<h3>Upcoming Events</h3>
<p>
<a href="recruitment.php">Spring Rush</a>
<br/>
January 19-29, 2011
<br/>
<br/>
<a href="alumni-weekend">Alumni Weekend</a><br> February 18-19, 2011
</p>
<h3>News</h3>
<?php
// display 3 latest news entries
$categories = array(1);
show_news(5, $categories);
?>
</div>
  <div id="feedbackReport">
  <?php
    $exec = array("Zach Mitchell"=>"", "Paul Rosser"=>"", "John Fratianni"=>"", "Michael Crosa"=>"", "Michael Stanley"=>"", "Alex Basinger"=>"");
    if ($_POST['name'] == "Zach Mitchell"){
      $exec[$_POST['name']] = $exec['name'].$_POST['comments']; 
    }
    elseif ($_POST['name'] == $exec[1]){
      $exec['name'] = $exec['name'].$_POST['comments'];
    }
    elseif ($_POST['name'] == $exec[2]){
      $exec['name'] = $exec['name]

  ?>
  <!-- end #feedbackReport --></div>
  <br class="clearfloat" />
  <div id="footer">
    <?php require_once ("footer.inc.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("tracking.inc.php"); ?></body>
</html>
