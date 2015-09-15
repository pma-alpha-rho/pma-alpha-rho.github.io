<img src="images/board-main4.jpg">
<script type="text/javascript" src="http://www.shawnolson.net/scripts/public_smo_scripts.js"></script>
<div style="width: 860px; background: #eee url('images/2g15.jpg') top right no-repeat; padding: 20px; margin-left: -155px; margin-bottom: 5px;">
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


?></div>
<table width="600" border="0" cellpadding="5">
<thead style="background-color: white;"><th width="50%"><b>Name</b></th><th width="50%"><b>Notebook Completion %</b></th></thead>
<?php

require_once('db_conn.php');

$sql = "Select * from the_board.pledges
ORDER BY `facts` DESC, `questions` DESC";
$result = mysql_query($sql);

$count = 0;

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$name = $row['name'];
$id = $row['id'];
$alt = false;
if($count%2 == 1) { $alt = true; }
echo "<tr";
if($alt) {
	$color = 'white';
echo " style='background-color: white;'";
} else {
	$color = '#eee';
}
$sql1 = "SELECT * FROM active_brothers";
$result1 = mysql_query($sql1);
$total_brothers = mysql_num_rows($result1);

$percent_q = ($row['questions'] + $row['facts']) / $total_brothers * 100;
$percent_f = $row['facts'] / $total_brothers * 100;
$comp_per = round(completion_percent($row['id']), 1);

?>


<?php
echo "><td width='50%'><a href='common/profile.php?id=$id'><span style='font-size: 20px;'>$name</span></a></td>
<td width = '50%' align = 'right'><div class='grad$count')>";
echo "$comp_per%</div></td></tr>";
?>
<script>
	changecss('.grad<?php echo"$count"?>', 'background', '-webkit-linear-gradient(left, #15C221 0%, #6EF054 <?php echo"$percent_f%, #FFFF10 $percent_f%, #FFFF65 $percent_q%, $color $percent_q%"?>)');
	changecss('.grad<?php echo"$count"?>', 'background', '-o-linear-gradient(right, #15C221 0%, #6EF054 <?php echo"$percent_f%, #FFFF10 $percent_f%, #FFFF65 $percent_q%, $color $percent_q%"?>)');
	changecss('.grad<?php echo"$count"?>', 'background', '-moz-linear-gradient(right, #15C221 0%, #6EF054 <?php echo"$percent_f%, #FFFF10 $percent_f%, #FFFF65 $percent_q%, $color $percent_q%"?>)');
	changecss('.grad<?php echo"$count"?>', 'background', 'linear-gradient(to right, #15C221 0%, #6EF054 <?php echo"$percent_f%, #FFFF10 $percent_f%, #FFFF65 $percent_q%, $color $percent_q%"?>)');
</script>
<?php
$count++;
}

?>
</table>
<div style="background-color: #fff; padding: 10px; width: 600px; margin-top: 15px;">
<h3 style="margin-bottom: 3px;">Thoughts or Opinions about 2G15? &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; font-size: 14px;"><a href="common/view-comments.php">View All Comments</a></span></h3><i>Recent Comments:</i><br><br>
<font size="1">
<?php

$sql = "SELECT name, comment, post_date, label FROM gen_comments ORDER BY post_date DESC LIMIT 7";
$result = mysql_query($sql);

if(mysql_num_rows($result) == 0) { echo "&nbsp;&nbsp;There are no recent comments.<br><br>"; }

while($row = mysql_fetch_array($result)) {
   $datetime = $row['post_date'];
   echo "{$row['name']} on $datetime said...<br><br><font color='#444444'>{$row['comment']}</font><br>";
   if($_SESSION['admin'])
	echo "<a href=\"common/rem-comm.php?id={$row['label']}\"> Delete comment.</a>";
   echo "<br><br><center><img src='images/comment-divider.jpg'></center><br><br>";
}


function completion_percent($theId) {

$sql = "SELECT score FROM notebook_score WHERE pledge_id='$theId'";
$result = mysql_query($sql);

$total = 0;
$questions = 0;
$facts = 0;

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$score = $row['score'];

if($score == 1) {
   $total += 0.25;
   $questions+= 1;
}
if($score == 2) {
   $total += 1;
   $facts+= 1;
}

}
$sql1 = "SELECT * FROM the_board.pledges";
$sql_q = "UPDATE the_board.pledges SET questions = $questions WHERE id = $theId";
$sql_f = "UPDATE the_board.pledges SET facts = $facts WHERE id = $theId";
$result1 = mysql_query($sql1) or die(mysql_error());
$result2 = mysql_query($sql_q) or die(mysql_error());
$result3 = mysql_query($sql_f) or die(mysql_error());

$sql = "SELECT * FROM active_brothers";
$result = mysql_query($sql);
$total_brothers = mysql_num_rows($result);

$percent = ($total/($total_brothers))*100;

return $percent;

}

?></font>
<form action="common/gen-comm-submit.php" method="POST">
Name: <input type="text" size="25" name = $_SESSION['username']/><br><br>
Comment:<br><textarea rows="5" cols="70" name="comment"></textarea>
<div style="text-align: right; margin-top: 10px;"><input type="submit" value="Post Comment"></div>
</form>
</div>
</div>
<div style="width: 880px; padding: 5px; margin-left: -155px; text-align: right;">
<?php if ($_SESSION['admin']) { ?>
<a href="common/admin.php">Add a PM</a> | <?php } ?><a href="common/full-report.php">View Full Report</a></div>
