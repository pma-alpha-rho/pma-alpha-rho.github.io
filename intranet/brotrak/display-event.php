<?php
session_start();
include("common/authentication/database.php");
include("common/authentication/login.php");
include("utils/time-functions.php");

$event_id = $_GET['id'];
$sql = "SELECT * FROM events WHERE event_id='$event_id'";
$result = mysql_query($sql) or die(mysql_error());
$event = mysql_fetch_array($result);
$event_date = $event['date'];
$event_date = $event_date[5].$event_date[6]."/".$event_date[8].$event_date[9]."/".substr($event_date,0,4);
$sql1 = "SELECT * FROM opportunities WHERE event_id='$event_id' ORDER BY start_time ASC";
$result1 = mysql_query($sql1);
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript">
		function confirm_del(uid, oid, eid) {
			if(confirm("Are you sure you want to remove yourself from this event?")) {
				document.location='utils/registration.php?uid='+uid+'&oid='+oid+'&eid='+eid+'&action=rem&ref=event';
			} else {
				return false;
			}
		}
	</script>
</head>
<body>
<div id="content-wrap">
	<?php if($logged_in) { ?>
	<span style="float: right;">Logged in as: <span style="color: green;"><?php echo $_SESSION['username']; ?></span></span>
	<?php } ?>
	<h1><?=$_SESSION['system_name']?> | <span style="font-size: 18px;">Service Point Management System</span></h1>
	<div id="left-well">
<?php if($logged_in) { 
?>
<h1><?=$event['event_name']?> | <span style="font-weight: normal; font-size: 16px;"><?=$event_date?>, <?=convert_12($event['start_time'])?> - <?=convert_12($event['end_time'])?></span></h1>
<p><?=$event['desc']?></p>
<h3>Opportunities for this event</h3>
<?php
while($row = mysql_fetch_array($result1)) {
	$opp_id = $row['opp_id'];
	$opp_title = $row['title'];
	$opp_start_time = convert_12($row['start_time']);
	$opp_end_time = convert_12($row['end_time']);
	$opp_desc = $row['desc'];
	$opp_point_value = $row['value'];
	$opp_slots_left = $row['slots'];
	$user_id_opp = $_SESSION['user_id'];
	$sql2 = "SELECT * FROM registration WHERE user_id='$user_id_opp' AND opp_id='$opp_id'";
	$result = mysql_query($sql2) or die(mysql_error());
	if(mysql_num_rows($result) > 0) {
		$user_is_registered = 1;
	} else {
		$user_is_registered = 0;
	}
?>
<div class="calendar_event">
<div style="float: left; width: 78%;">
<div style="float: left; border-right: 1px solid #eee; padding: 10px;">
<b><?=$opp_title?></b><br><br>
Start Time: <?=$opp_start_time?><br>
End Time: <?=$opp_end_time?>
</div>
<div style="float: left; padding: 10px;">
<span style="color: #777;"><?=$opp_desc?></span>
</div>
<div class="clear"></div>
</div>
<div style="float: right; width: 18%; background-color: #eee; padding: 10px;">
Current Volunteers:<div style="margin-top: 5px; margin-bottom: 5px;">
<?php
$vol_sql = "SELECT * FROM registration WHERE opp_id='$opp_id'";
$vol_result = mysql_query($vol_sql);
while($vol_row = mysql_fetch_array($vol_result)) {
	$user_id_list = $vol_row['user_id'];
	$user_sql = "SELECT * FROM users WHERE user_id='$user_id_list'";
	$user_result = mysql_query($user_sql);
	$user_row = mysql_fetch_array($user_result);
	echo "- <a href='profile.php?id=$user_id_list'>{$user_row['name']}</a>";
	if($vol_row['approved'] == 0) { echo "<span style='color: #777;'>*</span>"; }
	echo "<br>";
}
?>
</div>
<span style="color: #777;">Slots Left: <span style="color: green;"><?=$opp_slots_left?></span></span><br>
<?php if($_SESSION['points_on']) { ?>
<span style="color: #777;">Point value: <span style="color: green;"><?=$opp_point_value?></span></span><br>
<?php } ?>
<center>
<?php if(!$user_is_registered) { ?>
<input type="button" value="Sign Up" style="margin-top: 5px;" <?php if($opp_slots_left < 1) { echo "disabled='true'"; } ?> onclick="document.location='utils/registration.php?uid=<?=$_SESSION['user_id']?>&oid=<?=$opp_id?>&eid=<?=$event['event_id']?>&action=add&ref=event';">
<?php }  else { ?>
<input type="button" value="Leave List" style="margin-top: 5px;" onclick="return confirm_del(<?=$_SESSION['user_id']?>,<?=$opp_id?>,<?=$event['event_id']?>);">
<?php } ?>
</center>
<br>
<span style="font-size: 10px; color: #777;">* = Pending Approval</span>
</div>
<div class="clear"></div>
</div>
<?php } ?>
</div>
<?php } else { ?>
You do not have permission to view this page.
<?php } ?>

	<div id="menu">
		<h3>Menu</h3>
		<?php include('common/menu.php'); ?>
	</div>
</div>
</body>
</html>