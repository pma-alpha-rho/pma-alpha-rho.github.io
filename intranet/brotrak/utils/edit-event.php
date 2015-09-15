<?php
	session_start();
	include("../common/authentication/database.php");
	include("../common/authentication/login.php");
	include("time-functions.php");
	
	if(isset($_POST['event_name'])) {
		$event_id = $_GET['id'];
		$event_nm = $_POST['event_name'];
		$date = $_POST['date'];
		$start_time = convert_24($_POST['start-time']);
		$end_time = convert_24($_POST['end-time']);
		$desc = $_POST['desc'];
		$sql = "UPDATE `events` SET `event_name`='$event_nm', `date`='$date', `start_time`='$start_time', `end_time`='$end_time', `desc`='$desc' WHERE `event_id`=$event_id;";
		if($_GET['dup']) {
			$sql = "INSERT INTO `events` (`event_name`, `date`, `start_time`, `end_time`, `desc`) VALUES ('$event_nm', '$date', '$start_time', '$end_time', '$desc');";
		}
		mysql_query($sql) or die(mysql_error());
		header("Location: ../admin.php?msg=2");
	}
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM events WHERE event_id='$id';";
		$result = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_array($result)) {
			$event_name = $row['event_name'];
			$event_date = $row['date'];
			$event_stime = $row['start_time'];
			$event_etime = $row['end_time'];
			$event_desc = $row['desc'];
		}
		$event_date_mysql = $event_date;
		$event_date = $event_date[5].$event_date[6]."/".$event_date[8].$event_date[9]."/".substr($event_date,0,4);
		$event_stime = convert_12($event_stime);
		$event_etime = convert_12($event_etime);
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
		$("#date").datepicker( { altField: '#actualdate', altFormat: 'yy-mm-dd' });
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
		<h3 style="margin-bottom: 5px;">Currently editing: <span style="color: #cb4b4b;"><?=$event_name?></span></h3>
		<a href="../admin.php"><div style="margin-bottom: 25px;"><- Return to Control Panel</div></a>
		<form method="POST" action="edit-event.php?id=<?=$id?>" onsubmit="return validate_form(this);">
		<b>Event Name</b> :&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="event_name" title="Please fill out an event name." value="<?=$event_name?>"><br><br>
		<b>Date</b> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="date" size="20" title="Please fill out a date for the event." value="<?=$event_date?>"><input type="hidden" name="date" id="actualdate" value="<?=$event_date_mysql?>"><br><br>
		<b>Start Time</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 6em;" name="start-time" title="Please fill out a start time for the event." id="start-time" value="<?=$event_stime?>"><br><br>
		<b>End Time</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="end-time" style="width: 6em;" name="end-time" title="Please fill out an end time for the event." value="<?=$event_etime?>"><br><br>
		<b>Description</b> : <br><br>
		<textarea name="desc" rows="5" cols="65" title="Please fill in a description for the event."><?=$event_desc?></textarea>
		<br><br>
		<input type="submit" value="Update Event" style="float: right;">
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