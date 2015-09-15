


<?php
	session_start();
	include("common/authentication/database.php");
	include("common/authentication/login.php");
	include("utils/time-functions.php");
?>

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
