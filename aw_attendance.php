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
  
  <?php
include("intranet/brotrak/common/authentication/database.php");

// Get the form data.
$name = $_POST['name'];
$class = $_POST['class'];
$email = $_POST['email'];
$playing = $_POST['playing'];
$dinner = $_POST['dinner'];
$pin = $_POST['pin'];
$military = $_POST['military'];

// Insert the form data into the alumni_weekend table.
if($name)
{
	$query = "INSERT INTO alumni_weekend VALUES('$name', '$class', '$email', '$dinner', '$playing', '$pin', '$military')";
mysql_query($query);
}
?>

<?php
// Select everything from the alumni_weekend table.
$query2 = "SELECT * FROM alumni_weekend";
$result = mysql_query($query2);

mysql_close();

$rows = mysql_num_rows($result);
$i = 0;
?>

<b><center>Attending so far</center></b>

<center>
<table border="1" cellspacing="2" cellpadding="2">
<tr>
<th>Name</th>
<th>Pledge Class</th>
<th>Dinner</th>
<th>Basketball</th>
<th>Pin</th>
<th>Military</th>
</tr>

<?php
// Loop through the result, creating an HTML table.
while($i < $rows)
{

    $name = mysql_result($result, $i, "name");
    $class = mysql_result($result, $i, "class");
    $playing = mysql_result($result, $i, "playing");
    $dinner = mysql_result($result, $i, "dinner");
    $pin = mysql_result($result, $i, "pin");
    $military = mysql_result($result, $i, "military");

    // Since I don't know what the checkbox returns when it is unchecked, I need to make sure
    // that it returns a useful value when unchecked.
    if($playing != "yes")
    {
        $playing = "no";
    }
    if($dinner != "yes")
    {
        $dinner = "no";
    }
    if($military != "yes")
    {
        $military = "no";
    }
    //$query = "DELETE FROM alumni_weekend WHERE name=''";
    //mysql_query($query):
?>

<tr>
    <td><?php echo $name; ?></td>
    <td><?php echo $class; ?></td>
    <td><?php echo $dinner; ?></td>
    <td><?php echo $playing; ?></td>
    <td><?php echo $pin; ?></td>
    <td><?php echo $military; ?></td>
</tr>

<?php
$i++;
}
?>

</table>
</center>

  <br class="clearfloat" />
    </div>
   <div id="footer">
    <?php require_once ("footer.inc.php"); ?>
    <?php 
        mysql_query("DELETE FROM alumni_weekend WHERE name=''");        
    ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("tracking.inc.php"); ?></body>
</html>
