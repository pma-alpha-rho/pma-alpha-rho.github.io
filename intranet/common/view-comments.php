<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
   <title>PMA Sinfonia Intranet</title>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
   <script type="text/javascript" src="../jquery/filetree/jquery.js"></script>
   <script type="text/javascript" src="../jquery/process.js"></script>
   <link href="../jquery/filetree/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
   <link href="../css/menu-tabs.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="header">
   <a href="http://www.pma-alpha-rho.org">
      <img src="../images/phimualpha.jpg" style="border: 0px;" alt="Alpha Rho" title="Alpha Rho Homepage" />
   </a>
   <div id="menu">
      <?php
         include('int_menu.php');
      ?>
   </div>
</div>
<div id="resultDiv" style="position: absolute; top: 125px; left: 325px; background-color: #ffcaca; border: 3px solid #ff8484; padding: 10px; display: none;">
</div>
   <div style="position: absolute; left: 50%; width: 600px; margin-left: -300px; top: 140px;">
     <img src="../images/board-main.jpg">
<div style="width: 860px; background: #eee url('../images/2g15.jpg') top right no-repeat; padding: 20px; margin-left: -155px; margin-bottom: 5px;">
<div style="width: 150px; position: relative; top: 130px; left: 680px; color: #ccc; font-size: 20px;">Overall:
<?php

require_once('db_conn.php');

$overalPercent = calc_overall();
echo round($overalPercent, 0)."%";

function calc_overall() {

$totalPercent = 0;

$sql = "SELECT id FROM pledges";
$result = mysql_query($sql);
$numPledges = mysql_num_rows($result);

if($numPledges == 0) { return 0; }

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
$totalPercent += completion_percent($row['id']);
}

$overallPercent = $totalPercent/$numPledges;

return $overallPercent;

}

function completion_percent($theId) {

$sql = "SELECT score FROM notebook_score WHERE pledge_id='$theId'";
$result = mysql_query($sql);

$total = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$score = $row['score'];

if($score == 1) {
   $total += 0.25;
}
if($score == 2) {
   $total += 0.75;
}

}

$sql = "SELECT * FROM active_brothers";
$result = mysql_query($sql);
$total_brothers = mysql_num_rows($result);

$percent = ($total/($total_brothers))*100;

return round($percent, 2);

}

?></div>
<a href="../the-board.php">The Board Home</a>
<div style="background-color: #fff; padding: 10px; width: 600px; margin-top: 15px;">
<b>Comments</b><br><br>
<?php

require_once('db_conn.php');

$sql = "SELECT id, name, comment, post_date FROM gen_comments ORDER BY post_date DESC";
$result = mysql_query($sql);
if(mysql_num_rows($result) == 0) {
   echo " &nbsp;&nbsp;There are no comments at this time.<br><br>";
}

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$name = $row['name'];
$comment = $row['comment'];
$id = $row['id'];
$datetime = $row['post_date'];

echo "<font size='1'>$name on $datetime said...<br><br><font color='#444444'>$comment</font></font><br><br><center><img src='../images/comment-divider.jpg' style='margin-top: 4px; margin-bottom: 4px;'></center><br><br>";

}

?>
</div>
   </div>
</body>
</html>
