<!-- The point of this file it to test out the Winged News program in its current state on this server. -->

<?php
  include('News/news.php');
?>

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
  <?php
  $articles = 1;
  $categories = array(1);
  show_news($articles, $categories);
  ?>

  <br class="clearfloat" />
    </div>
   <div id="footer">
    <?php require_once ("footer.inc.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("tracking.inc.php"); ?></body>
</html>
