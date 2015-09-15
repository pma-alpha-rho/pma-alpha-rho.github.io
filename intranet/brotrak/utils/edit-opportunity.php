<?php
	session_start();
	include("../common/authentication/database.php");
	include("../common/authentication/login.php");
	include("time-functions.php");
	
	if(isset($_POST['opportunity_name'])) {
		$opp_name = $_POST['opportunity_name'];
		$start_time = convert_24($_POST['start-time']);
		$end_time = convert_24($_POST['end-time']);
		$desc = $_POST['desc'];
		$point_value = $_POST['point_value'];
		$slots = $_POST['slots'];
		$event_id = $_POST['event_id'];
		$opp_id = $_GET['id'];
		$sql1 = "UPDATE `opportunities` SET `event_id`='$event_id', `title`='$opp_name', `start_time`='$start_time', `end_time`='$end_time', `value`='$point_value', `desc`='$desc', `slots`='$slots' WHERE `opp_id`=$opp_id;";
		mysql_query($sql1) or die(mysql_error());
		header("Location: ../manage-opportunities.php?msg=2");
	}
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM opportunities WHERE opp_id='$id';";
		$result = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_array($result)) {
			$opp_name = $row['title'];
			$event_id = $row['event_id'];
			$opp_stime = $row['start_time'];
			$opp_etime = $row['end_time'];
			$opp_desc = $row['desc'];
			$opp_value = $row['value'];
			$opp_slots = $row['slots'];
		}
		$opp_stime = convert_12($opp_stime);
		$opp_etime = convert_12($opp_etime);
	}
	
?>
<html>
<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="../style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="../js/jquery.timePicker.js"></script>
	<script type="text/javascript" src="../js/form-validation.js"></script>
	<script type="text/javascript">
	$(function() {
		$("#start-time").timePicker({
			startTime: "00:00", // Using string. Can take string or Date object.
			endTime: new Date(0, 0, 0, 23, 45, 0), // Using Date object here.
			show24Hours: false,
			separator: ':',
			step: 15});
		$("#end-time").timePicker({
			startTime: "00:00", // Using string. Can take string or Date object.
			endTime: new Date(0, 0, 0, 23, 45, 0), // Using Date object here.
			show24Hours: false,
			separator: ':',
			step: 15});
	});
</script>
</head>
<body>
<div id="content-wrap">
	<?php if($logged_in) { ?>
	<span style="float: right;">Logged in as: <span style="color: green;"><?php echo $_SESSION['username']; ?></span></span>
	<?php } ?>
	<h1><?=$_SESSION['system_name']?> | <span style="font-size: 18px;">Service Point Management System</span></h1>
	<div id="left-well">
		<h3 style="margin-bottom: 5px;">Currently editing: <span style="color: #cb4b4b;"><?=$opp_name?></span></h3>
		<a href="../manage-opportunities.php"><div style="margin-bottom: 25px;"><- Return to Control Panel</div></a>
		<form method="POST" action="edit-opportunity.php?id=<?=$id?>" onsubmit="return validate_form(this);">
		<b>Event</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="event_id"><?php
			$sql2 = "SELECT * FROM events ORDER BY event_name ASC";
			$result2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($result2)) {
				echo "<option value='{$row2['event_id']}'";
				if($event_id == $row2['event_id']) {
					echo " selected='selected'";
				}
				echo ">{$row2['event_name']}</option>";
			}
		?>
		</select><br><br>
		<b>Opportunity Name</b> :&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="opportunity_name" title="Please fill out an opportunity name." value="<?=$opp_name?>"><br><br>
		<b>Start Time</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 6em;" name="start-time" value="<?=$opp_stime?>" title="Please fill out a start time for the opportunity." id="start-time"><br><br>
		<b>End Time</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="end-time" style="width: 6em;" value="<?=$opp_etime?>" name="end-time" title="Please fill out an end time for the opportunity."><br><br>
		<?php if($_SESSION['points_on']) { ?>
		<b>Point value</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 6em;" name="point_value" value="<?=$opp_value?>" title="Please fill in a point value."><br><br>
		<?php } else { ?>
		<input type="hidden" name="point_value" value="0">
		<?php } ?>
		<b>Slots Available</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 6em;" name="slots" value="<?=$opp_slots?>" title="Please fill in the number of slots available for this opportunity."><br><br>
		<b>Description</b> : <br><br>
		<textarea name="desc" rows="5" cols="65" title="Please fill in a description for the opportunity."><?=$opp_desc?></textarea>
		<br><br>
		<input type="submit" value="Update Opportunity" style="float: right;">
		</form>
	</div>
	<div id="menu">
		<h3>Menu</h3>
		<?php
			include('../common/menu.php');
		?>
	</div>
</div>
</body>
</html>