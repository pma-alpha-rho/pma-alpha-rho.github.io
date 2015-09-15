<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>The Alpha Rho Chapter :: Phi Mu Alpha Sinfonia</title>

<link href="secondary.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.thrColLiqHdr #sidebar2, .thrColLiqHdr #sidebar1 { padding-top: 30px; }
.thrColLiqHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->

<script type="text/javascript">
	function checkForm(theForm) {
		if(theForm.name.value == "") {
			alert("Please fill in your name.");
			return false;
		}
		if(theForm.pledge_class.value == "") {
			alert("Please fill in your pledge class.");
			return false;
		}
		if(theForm.email.value == "") {
			alert("Please fill in your email address.");
			return false;
		}
		if(theForm.phone.value == "") {
			alert("Please fill in your phone number.");
			return false;
		}
		if(!valButton(theForm.donation_level)) {
			alert("Please select a donation amount.");
			return false;
		}
		
	}
	
	function valButton(btn) {
		var cnt = -1;
		for (var i=btn.length-1; i > -1; i--) {
			if (btn[i].checked) {cnt = i; i = -1;}
		}
		if (cnt > -1) return btn[cnt].value;
			else return null;
	}
</script>

</head>

<body class="thrColLiqHdr">

<div id="container">
 <div id="header">
    <h1><img src="images/header.png"  alt="Alpha Rho Chapter" /></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
  <?php require_once ("menu.inc.php"); ?>
    <!-- end #sidebar1 --></div>
 
  <div id="mainContent">
    <h3>Alpha Rho Fund Donation Form</h3>
    <p>Thank you for your interest in donating to our chapter!  Please fill out the form below.  After completing the form below, you will be directed to paypal where you will find further instructions for credit card payment.
    </p>
	<form name="donate_form" action="process_donation.php" onSubmit= "return checkForm(this)" method="POST">
		Name: <input type="text" size="20" name="name" /> &nbsp;&nbsp;&nbsp;Pledge Class: <input type="text" size="4" name="pledge_class" /><br /><br />
		Email: <input type="text" size="20" name="email" /><br />
Phone: <input type="text" size="20" name="phone" /><br /><br />
		<b>Donation Level:</b><br /><br />
		<input type="radio" name="donation_level" value="25.00" /> Once a Sinfonian - $25.00<br />
		<input type="radio" name="donation_level" value="50.00" /> Always a Sinfonian -$50.00<br />
		<input type="radio" name="donation_level" value="100.00" /> Long Live Sinfonia -$100.00<br />
		<input type="radio" name="donation_level" value="500.00" /> Orpheus -$500.00<br />
		<input type="radio" name="donation_level" value="other" /> Other Amount: <input type="text" size="4" name="other_amount" /><br /><br />
			<b>Preferences:</b><br /><br />
			<input type="checkbox" name="preferences[]" value="give_tokens" /> I would like to receive the corresponding tokens of appreciation for my donation.<br />
			<input type="checkbox" name="preferences[]" value="anonymous" /> Please list me as an anonymous donor.<br /><br />

		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
    <p>&nbsp</p>
    <br class="clearfloat" />
    <!-- end #mainContent -->
  </div>
  <div id="footer">
    <?php require_once ("footer.inc.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
<?php require_once ("tracking.inc.php"); ?></body>
</html>
