<?php

require_once('db_conn.php');

$pledge_name = $_POST['name'];
$pledge_profile = $_POST['profile'];
$pledge_profile = nl2br($pledge_profile);

$sql = "INSERT INTO pledges(name, profile) VALUES('$pledge_name','$pledge_profile');";
mysql_query($sql);

$sql = "SELECT * FROM active_brothers";
$result = mysql_query($sql);
$i = 0;
while($row = mysql_fetch_array($result))
  {
  $bro_ids[$i] = $row['id'];
  $i++;
  }
  
$sql = "SELECT id FROM pledges ORDER BY id DESC LIMIT 1";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$pledge_id = $row['id'];

foreach($bro_ids as $bro_id) {

$sql = "INSERT INTO notebook_score(pledge_id, brother_id, score) VALUES('$pledge_id','$bro_id','0')";
mysql_query($sql);

}

header("Location: user.php?addsuccess=true");

?>
