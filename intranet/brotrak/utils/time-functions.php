<?php
function convert_12($time) {
	if(substr($time, 0, 2) >= 0 && substr($time, 0, 2) <= 11) {
		$ampm = "AM";
	} else {
		$ampm = "PM";
	}
	if($ampm == "AM") {	
		if(substr($time, 0, 2) == "00") {
			$hour = "12";		
		} else {
			$hour = substr($time, 0, 2);
		}
	} else if($ampm == "PM") {
		if(substr($time, 0, 2) != 12) {
			$hour = substr($time, 0, 2)-12;
			if($hour != 12) { $hour = "0".$hour; }
		} else {
			$hour = substr($time, 0, 2);
		}
	}
	return $hour.":".substr($time, 3, 2)." ".$ampm;
}

function convert_24($time) {
	$ampm = substr($time, -2);
	if($ampm == "AM") {	
		if(substr($time, 0, 2) == 12) {
			return "00:".substr($time, 3, 2).":00";
		} else {
			return substr($time, 0, 5).":00";
		}
	} else if($ampm == "PM") {
		$pmhour = substr($time, 0, 2);
		if($pmhour != 12) { $pmhour = $pmhour+12; }
		return $pmhour.":".substr($time, 3, 2).":00";
	}
	return "There was an error in your time format.";
}
?>