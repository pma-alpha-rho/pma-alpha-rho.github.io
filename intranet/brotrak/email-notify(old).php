<?php
include("common/authentication/login.php");
require 'PHPMailerAutoload.php';
/* 
- find upcoming events
- find people registered and approved to work those events
- email people a reminder 
*/

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '0nc3And4lw4y$!';
$dbname = 'brotrak';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

mysql_select_db($dbname);

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
		} else {
			$hour = substr($time, 0, 2);
		}
	}
	return $hour.":".substr($time, 3, 2)." ".$ampm;
}

$sql = "SELECT * FROM events WHERE (DATEDIFF(date,curdate()))=1;";
$result = mysql_query($sql) or die(mysql_error());

while($upcoming_events = mysql_fetch_array($result)) {
	$start_time = convert_12($upcoming_events['start_time']);
	$sql1 = "SELECT * FROM opportunities WHERE event_id='{$upcoming_events['event_id']}';";
	$result1 = mysql_query($sql1) or die(mysql_error());
	while($upcoming_opportunities = mysql_fetch_array($result1)) {
		$sql2 = "SELECT * FROM registration WHERE opp_id='{$upcoming_opportunities['opp_id']}' AND approved>0;";
		$result2 = mysql_query($sql2) or die(mysql_error());
		while($registrants = mysql_fetch_array($result2)) {
			$sql3 = "SELECT * FROM users WHERE user_id='{$registrants['user_id']}';";
			$result3 = mysql_query($sql3) or die(mysql_error());
			$registrant = mysql_fetch_array($result3);
			require 'PHPMailer/PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 3;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "alpharhocalender@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "IWishToBe";

//Set who the message is to be sent from
$mail->setFrom('webmaster@pma-alpha-rho.org', 'Webmaster');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
		$mail->addAddress({$registrant['email']}, {$registrant['name']});

//Set the subject line
$mail->Subject = '[pma] {$_SESSION['system_name']} Reminder';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('PHPMailer/PHPMailer/examples/contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'Could not load html text.';

//Attach an image file
//$mail->addAttachment('PHPMailer/PHPMailer/examples/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
			$subject = "[pma] {$_SESSION['system_name']} REMINDER";
			$message = "{$registrant['name']},<br><br>This is just a reminder that you signed up to work at {$upcoming_events['event_name']} tomorrow.  The event begins at $start_time.  Please come prepared for the event at the designated time.<br><br>OAS AAS LLS,<br>BroTrak";
			$to = $registrant['email'];
		}
	}
}
echo "Code running.";
?>
