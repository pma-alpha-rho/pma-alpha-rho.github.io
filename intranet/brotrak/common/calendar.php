<h3>Event Calendar</h3>
<?php
$year = date("Y");
if(isset($_GET['m'])) {
	$month_id = $_GET['m'];
	if($month_id < 1 || $month_id > 12) {
		$year = date("Y")+ceil($month_id/12)-1;
	} else {
		$year = date("Y");
	}
} else {
	$month_id = date("m");
}
$month = date("F", mktime(0,0,0,$month_id,1,1926));
$prev_month_id = $month_id-1;
$next_month_id = $month_id+1;
$prev_month = date("F", mktime(0,0,0,$month_id-1,1,1926));
$next_month = date("F", mktime(0,0,0,$month_id+1,1,1926));

echo "
<table width='100%'>
	<tr style='background-color: #eee;'>
		<td align='center' width='33%' style='padding: 10px;'><a href='?m=$prev_month_id'><<&nbsp; $prev_month</a></td>
		<td align='center' width='33%'>$month, $year</td>
		<td align='center' width='33%'><a href='?m=$next_month_id'>$next_month &nbsp;>></td>
	</tr>
	<tr>
		<td colspan='4'>";
$has_events = 0;
$sql = "SELECT * FROM events ORDER BY date ASC";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
	$event_id = $row['event_id'];
	$event_name = $row['event_name'];
	$event_date = $row['date'];
	$event_day = $event_date[8].$event_date[9];
	$event_day = date("jS", mktime(0,0,0,1,$event_day,1926));
	$event_month = $event_date[5].$event_date[6];
	$event_year = substr($event_date,0,4);
	$event_start_time = convert_12($row['start_time']);
	$event_end_time = convert_12($row['end_time']);
	$event_description = substr($row['desc'], 0, 300)."...";
	if($year == $event_year && $month_id == $event_month) {
	$has_events = 1;
	echo "<br><div class='calendar_event'><div class='calendar_day'><span style='font-size: 35px; color: #bbb;'>$event_day</span></div><div style='float: left; width: 78%;'><h3><a href='display-event.php?id=$event_id'>$event_name</a>&nbsp; <span style='font-weight: normal; font-size: 12px;'>($event_start_time - $event_end_time)</span></h3><p>$event_description</p></div><div class='clear'></div></div>";
	}
}
if(!$has_events) { echo "<br><div class='calendar_event'>There are no events currently scheduled for this month.</div>"; }
echo "</td></tr></table>";
?>