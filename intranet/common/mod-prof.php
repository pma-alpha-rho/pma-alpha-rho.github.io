<?php

require_once('db_conn.php');

$pledge_id = $_POST['pledge_id'];

$sql = "SELECT id FROM active_brothers";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$brother_id = $row['id'];

$inner_sql = "SELECT score FROM notebook_score WHERE brother_id='$brother_id' AND pledge_id='$pledge_id'";
$inner_result = mysql_query($inner_sql);
if(mysql_num_rows($inner_result) == 0) {
   $inner_sql = "INSERT INTO notebook_score(pledge_id, brother_id, score) VALUES('$pledge_id','$brother_id','{$_POST[$brother_id]}'";
} else {
   $inner_sql = "UPDATE notebook_score SET score='{$_POST[$brother_id]}' WHERE pledge_id='$pledge_id' AND brother_id='$brother_id'";
}

mysql_query($inner_sql);

header("Location: profile.php?id=$pledge_id");

}


?>
