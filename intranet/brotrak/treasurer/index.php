<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php
	session_start();
	include("common/authentication/database.php");
	include("common/authentication/login.php");
	include("utils/time-functions.php");
?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<title><?=$_SESSION['system_name']?> Service Point Management System</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
</head>


<body>

<div id="content-wrap">

	<?php if($logged_in) { ?>
	<span style="float: right;">Logged in as: <span style="color: green;"><?php echo $_SESSION['username']; ?></span></span>
	<?php } ?>
	
	
	<h1><?=$_SESSION['system_name']?> | <span style="font-size: 18px;">Service Point Management System</span></h1>
	
	
	<div id="left-well">
		<?php
				displayLogin();
		?>
	</div>
	
	
	<?php if($logged_in) { ?>
	<div id="menu">
		<h3>Menu</h3>
		<?php
			include('common/menu.php');
		?>
	</div>
	<?php } ?>
	
	
	<table border="1">
	
	    <tr>
	        <th colspan="4">Alpha Rho Chapter Online Ledger App </th>
	    </tr>
	    
	    <tr>
	        <td>Item #</td>
	        <td>Name</td>
	        <td>Value</td>
	        <td>Expected Value</td>
	    </tr>
	    
	    <?php
	        $query = sprintf("SELECT * FROM treasurer");
	        $result = mysql_query($query);
	        
	        while ($row = mysql_fetch_array($result){
	            $value = $row['value'];
	            $direction = $row['direction'];
	            $value = $value*$direction;
	            $line = $row['line_ID'];
	            $expected_value = $row['expected_value'];
	            $name = $row['name'];
	            $data = sprintf("<td>".$line."</td><td>".$name."</td><td>".$value."</td><td>".$expected_value."</td>");
	            echo $data;
	        }
	    ?>
	    
	    
	</table>
	
</div>

</body>
</html>