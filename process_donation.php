<?php

$name = $_POST['name'];
$pledge_class = $_POST['pledge_class'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$donation_level = $_POST['donation_level'];
if($donation_level == "other") {
	$donation_level = $_POST['other_amount'];
}
$preferences = $_POST['preferences'];
$give_tokens = 0;
$anonymous = 0;
if($preferences[0] == "give_tokens") {
	$give_tokens = 1;
}
if($preferences[0] == "anonymous") {
	$anonymous = 1;
}
if($preferences[1] == "anonymous") {
	$anonymous = 1;
}
$amount = $donation_level;

if(50 > $amount && $amount >= 25) {
	$donation_level = "Once a Sinfonian";
} else if(100 > $amount && $amount >= 50) {
	$donation_level = "Always a Sinfonian";
} else if(500 > $amount && $amount >= 100) {
	$donation_level = "Long Live Sinfonia";
} else if($amount >= 500) {
	$donation_level = "Orpheus";
} else {
	if($amount <= 0) {
		die("Please enter an amount greater than $0.00.  Hit your browser's back button to retry.");
	}
	$donation_level = "Donor";
}

$dbserver = "152.2.45.143";
$dbuser = "geoff";
$dbpass = "spider";
$dbname = "pma_donations";

$conn = mysql_connect($dbserver, $dbuser, $dbpass);
if (!$conn) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db($dbname);

$sql = "INSERT INTO donors (name, pledge_class, email, phone, donation_level, give_tokens, anonymous) VALUES ('$name','$pledge_class','$email','$phone','$donation_level','$give_tokens','$anonymous');";
mysql_query($sql) or die(mysql_error());

mysql_close($conn);

header("Location:https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=XVQBK7G6KC93C&lc=US&item_name=Phi%20Mu%20Alpha%20Sinfonia%20-%20Alpha%20Rho%20Chapter&amount=$amount&currency_code=USD&bn=PP-DonationsBF:btn_donateCC_LG.gif:NonHosted");

?>
