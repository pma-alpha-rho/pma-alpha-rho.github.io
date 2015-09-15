<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
   <title>PMA Sinfonia Intranet</title>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
   <script type="text/javascript" src="../jquery/filetree/jquery.js"></script>
   <script type="text/javascript" src="../jquery/process.js"></script>
   <link href="../jquery/filetree/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
   <link href="../css/menu-tabs.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript">
      function submitForm() {
         document.getElementById('theForm').submit();
      }
   </script>
</head>
<body>

<div id="header">
   <a href="http://www.pma-alpha-rho.org/">
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
<form action="mod-prof.php" method="POST" id="theForm">
<a href="profile.php?id=<?php echo $_GET['id']; ?>">(X) Cancel</a> &nbsp;&nbsp;<a href="#" onClick="submitForm();">Save & Close</a>
<div style="background-color: #fff; padding: 10px; width: 600px; margin-top: 15px;">
<?php

require_once('db_conn.php');

$id = $_GET['id'];

$sql = "SELECT name, profile FROM pledges WHERE id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$pledge_name = $row['name'];

echo "<h3>".$pledge_name."</h3>".$row['profile'];

echo "<h3>Notebook Progress</h3>";

$sql = "SELECT `active_brothers`.`id`, `active_brothers`.`name` , `notebook_score`.`score` FROM active_brothers, notebook_score WHERE ( `active_brothers`.`id` = notebook_score.brother_id ) AND notebook_score.pledge_id = '$id'";
$result = mysql_query($sql);
echo "<table width='100%' cellpadding='5'>";
while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$degree = "";
$score = $row['score'];
$brotherId = $row['id'];
if($score == 0) {
   $degree = "<select name='$brotherId'>
               <option value='0' selected='selected'>Has not met with this brother.</option>
               <option value='1'>Got Questions.</option>
               <option value='2'>Has FACT!</option>
             </select>";
}
if($score == 1) {
   $degree = "<select name='$brotherId'>
               <option value='0'>Has not met with this brother.</option>
               <option value='1' selected='selected'>Got Questions.</option>
               <option value='2'>Has FACT!</option>
             </select>";
}
if($score == 2) {
   $degree = "<select name='$brotherId'>
               <option value='0'>Has not met with this brother.</option>
               <option value='1'>Got Questions.</option>
               <option value='2' selected='selected'>Has FACT!</option>
             </select>";
}

echo "<tr><td width='50%'>{$row['name']}</td><td width='50%' align='right'>$degree</td></tr>";

}

echo "<input type='hidden' name='pledge_id' value='$id'>";
?>
</table>
<div style="text-align: right; margin-right: 10px; margin-top: 10px;"><a href="#" onClick="submitForm();">Save & Close</a></div>
</form>
</div>
</div>
   </div>
</body>
</html>
