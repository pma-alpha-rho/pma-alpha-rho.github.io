<?php

if($_GET['addsuccess'] == true) {

echo "<br><div style='text-align: right; width: 600px;'><font size='5' color='green'>PM Successfully Created</font></div><br>";

}

if ($_SESSION['admin'] = true ) {
?>
<div style="background-color: #fff; padding: 10px; width: 600px; margin-top: 15px; margin-left: -10px;">
<div style="margin-top:20px; border-top: 1px solid #ccc; padding: 10px;">
<div style="position: relative; text-align: center; padding: 2px; border-top: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc; top: -33px; width: 70px; cursor: pointer; cursor: hand;" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#fff'" onClick="window.location = 'user.php'">Add PM</div>
<div style="position: relative; text-align: center; padding: 2px; border-top: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc; top: -55px; left: 90px; width: 170px; cursor: pointer; cursor: hand;" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#fff'" onClick="window.location = 'user.php?p=mod'">Moderate Comments</div>
<div style="margin-top: -30px;">
<b>Add a Probationary Member</b><br><br>
<form name="myForm" action="add-pm.php" method="POST">
Name: <input type="text" size="20" name="name"><br><br>
Profile:<br><br>
<textarea name="profile" rows="7" cols="69"></textarea>
</div>
<div style="text-align: right; margin-top: 10px;"><input type="submit" value="Create"></div>
</div>
</form>
</div>
<?php }?>
   </div>
