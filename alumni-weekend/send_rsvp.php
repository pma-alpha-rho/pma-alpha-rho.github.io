<?php
// Contact subject
$subject = "PMA Alumni Weekend";
// Details
$message=$_POST['rsvp'];
$message= stripslashes($message);

// Mail of sender
$mail_from=$_REQUEST['email'];
// From
$header=$_REQUEST['name'];

// Enter your email address
$to ='dave.t.steele@gmail.com';

$send_contact= mail($to,$subject,$message,"From: $header <$mail_from>");

$username="geoff";
$password="spider";
$database="alumni_weekend";
mysql_connect('152.2.45.143',$username,$password);
mysql_select_db($database) or die( "Unable to select database");

$pledge = $_POST['pledge'];

$sql = "INSERT INTO attending (name, pledge) VALUES ('$header', '$pledge')";
mysql_query($sql);

// Check, if message sent to your email
if($send_contact){
header("Location: index.php?msg=1");
}
else {
header("Location: index.php?msg=2");
}
?>