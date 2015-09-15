<form action="delete-pm.php" method="POST">
<?php

require_once('db_conn.php');

if(!isset($_POST['pledge'])) {
$sql = "SELECT id, name FROM pledges";
$result = mysql_query($sql);

echo "<select name='pledge'>";
while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo "<option value='{$row['id']}'>{$row['name']}</option>";
}
echo "</select><input type='submit' value='Delete' onClick='return confirm(\"Are you sure you want to delete this PM?\");'>";
} else {

$pledgeId = $_POST['pledge'];
$sql = "DELETE FROM pledges WHERE id='$pledgeId'";
mysql_query($sql);
$sql = "DELETE FROM notebook_score WHERE pledge_id='$pledgeId'";
mysql_query($sql);
echo "PM $pledgeId successfully deleted.";

}

?>
</form>
