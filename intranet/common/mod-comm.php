<div style="background-color: #fff; padding: 10px; width: 600px; margin-top: 15px; margin-left: -10px;">
<div style="margin-top:20px; border-top: 1px solid #ccc; padding: 10px;">
<div style="position: relative; text-align: center; padding: 2px; border-top: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc; top: -33px; width: 70px; cursor: pointer; cursor: hand;" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#fff'" onClick="window.location = 'user.php'">Add PM</div>
<div style="position: relative; text-align: center; padding: 2px; border-top: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc; top: -55px; left: 90px; width: 170px; cursor: pointer; cursor: hand;" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#fff'" onClick="window.location = 'user.php?p=mod'">Moderate Comments</div>
<div style="margin-top: -30px;">
<b>Comments</b><br><br>
<?php

require_once('db_conn.php');

$sql = "SELECT id, name, comment FROM gen_comments ORDER BY id DESC";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$name = $row['name'];
$comment = $row['comment'];
$id = $row['id'];

echo "<font size='1'>$name says... &nbsp;&nbsp;<a href='#' onClick='return deleteComm($id);'>[Delete]</a><br><br>$comment</font><center><img src='../images/comment-divider.jpg' style='margin-top: 4px; margin-bottom: 4px;'></center>";

}

?>
</div>
   </div>
