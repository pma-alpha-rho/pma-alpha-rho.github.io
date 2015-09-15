<?php
global $conn;
$result = mysql_query("SELECT * FROM treasurer");

// newLineItem - adds a new line item into the "treasurer" table of the "brotrak" database.
function newLineItem($name, $value, $direction, $expected_value)
{
    SELECT MAX(line_ID) AS $lines FROM treasurer;
    INSERT INTO treasurer VALUES ($lines-1, $name, $value, $direction, $expected_value);
}

// balanceAll - adds up all the line-items and returns the balance.  The "direction" column of the
//              "treasurer" table indicates whether an item is a withdrawal or an expenditure, and 
//.             should only be 1 or -1 (a multiplier for the value of the item).                    
function balanceAll()
{
    $lines = SELECT COUNT(*) FROM treasurer;
    $total = 0;
    for ($i=0; $i<$lines; $i++)
    {
        $value = SELECT value FROM treasurer WHERE line_ID=$i;
        $multiplier = SELECT direction FROM treasurer WHERE line_ID=$i;
        $total += $total + $value*$multiplier;
    }
    return $total;
}


?>