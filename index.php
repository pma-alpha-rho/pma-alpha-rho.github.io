<?php
// include the script at the _top_
//include('News/news_home.php'); //news changed to News !!!!!!!!!
require 'email-notify.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="icon" type=image/jpg href="images/favicon.ico"
<link rel="alternate" type="application/rss+xml" title="Alpha Rho News RSS" href="http://www.pma-alpha-rho.org/news/rss.php">
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="container">
 <div id="header">
	<a href="http://pma-alpha-rho.org">
		<h1><img src="images/header.png" alt="Alpha Rho Chapter" /></h1>
	</a>
  <!-- end #header --></div>
  <div id="sidebar1">
  <?php require_once ("menu.inc.php"); ?>
    <!-- end #sidebar1 --></div>
  <div id="sidebar2">
  
  <!-- SIDEBAR 2 -->
  <div class="fb-like-box" data-href="https://www.facebook.com/PMAUNC" 
  data-width="250" data-height="585" data-colorscheme="light" data-show-faces="false" 
  data-header="true" data-stream="true" data-show-border="true"></div>
  </div>

  <div id="mainContent">
  <img src="images/object.png" alt="Object" />
  <img src="images/Alpha_Rogue.jpg" alt="Brothers of the Alpha Rho Chapter" width=400 height=225/> 
  <!--Alumni Weekend registration link-->
  <br/>
  <br/>
  <!--End alumni weekend link-->
            <p>&nbsp</p>
               <!-- end #mainContent -->
         </div>
  <br class="clearfloat" />
  <div id="footer">
    <?php require_once ("footer.inc.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("tracking.inc.php"); ?></body>
</html>
