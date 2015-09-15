<?php
	session_start();
	include("../common/authentication/database.php");
	include("../common/authentication/login.php");
	include("time-functions.php");
	
if($logged_in && $_SESSION['admin']) {
	
	if(isset($_POST['event_name'])) {
		$event_name = $_POST['event_name'];
		$date = $_POST['date'];
		$start_time = convert_24($_POST['start-time']);
		$end_time = convert_24($_POST['end-time']);
		$desc = $_POST['desc'];
		$sql = "INSERT INTO `events` (`event_id`, `event_name`, `date`, `start_time`, `end_time`, `desc`) VALUES (NULL, '$event_name', '$date', '$start_time', '$end_time', '$desc');";
		mysql_query($sql);
		header("Location: ../admin.php?msg=1");
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
		<h3 style="margin-bottom: 5px;">Add an Event</h3>
		<a href="../admin.php"><div style="margin-bottom: 25px;"><- Return to Control Panel</div></a>
		<form method="POST" action="add-event.php" onsubmit="return validate_form(this);">
		<b>Event Name</b> :&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="20" name="event_name" title="Please fill out an event name."><br><br>
		<b>Date</b> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="date" size="20" title="Please fill out a date for the event."><input type="hidden" name="date" id="actualdate"><br><br>
		<b>Start Time</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 6em;" name="start-time" title="Please fill out a start time for the event." id="start-time"><br><br>
		<b>End Time</b> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="end-time" style="width: 6em;" name="end-time" title="Please fill out an end time for the event."><br><br>
		<b>Description</b> : <br><br>
		<textarea name="desc" rows="5" cols="65" title="Please fill in a description for the event."></textarea>
		<br><br>
		<input type="submit" value="Add Event" style="float: right;">
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

<?php
} else {
	die('You do not have permission to access this page.');
}
?>