<h2>Add a new adminstrator to The Board 3.0</h2>

<form name="myForm" action="add-admin.php" method="POST">
Username: <input type="text" size="25" name="username"><br><br>
Password: <input type="password" size="25" name="password"><br><br>
<input type="submit" value="Create Admin">
</form>

<?php

require_once('db_conn.php');

if(isset($_POST['username']) && isset($_POST['password'])) {
   $username = $_POST['username'];
   $password = md5($_POST['password']);
   $sql = "INSERT INTO admins(username, password) VALUES('$username','$password');";
   mysql_query($sql);
   echo "Admin <b>$username</b> was successfully created.";
}
?>
