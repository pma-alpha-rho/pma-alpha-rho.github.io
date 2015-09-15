<?php

/**
 * Checks whether or not the given username is in the
 * database, if so it checks if the given password is
 * the same password in the database for that user.
 * If the user doesn't exist or if the passwords don't
 * match up, it returns an error code (1 or 2).
 * On success it returns 0.
 */
function confirmUser($username, $password){
   global $conn;
   /* Add slashes if necessary (for query) */
   if(!get_magic_quotes_gpc()) {
   $username = addslashes($username);
   }

   /* Verify that user is in database */
   $q = "SELECT password FROM admins WHERE username = '$username'";
   $result = mysql_query($q,$conn);
   if(!$result || (mysql_numrows($result) < 1)){
      return 1; //Indicates username failure
   }

   /* Retrieve password from result, strip slashes */
   $dbarray = mysql_fetch_array($result);
   $dbarray['password']  = stripslashes($dbarray['password']);
   $password = stripslashes($password);

   /* Validate that password is correct */
   if($password == $dbarray['password']){
      return 0; //Success! Username and password confirmed
   }
   else{
      return 2; //Indicates password failure
   }
}

/**
 * checkLogin - Checks if the user has already previously
 * logged in, and a session with the user has already been
 * established. Also checks to see if user has been remembered.
 * If so, the database is queried to make sure of the user's
 * authenticity. Returns true if the user has logged in.
 */
function checkLogin(){
   /* Check if user has been remembered */
   if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
      $_SESSION['username'] = $_COOKIE['cookname'];
      $_SESSION['password'] = $_COOKIE['cookpass'];
   }

   /* Username and password have been set */
   if(isset($_SESSION['username']) && isset($_SESSION['password'])){
      /* Confirm that username and password are valid */
      if(confirmUser($_SESSION['username'], $_SESSION['password']) != 0){
         /* Variables are incorrect, user not logged in */
         unset($_SESSION['username']);
         unset($_SESSION['password']);
         return false;
      }
      return true;
   }
   /* User not logged in */
   else{
      return false;
   }
}

/**
 * Determines whether or not to display the login
 * form or to show the user that he is logged in
 * based on if the session variables are set.
 */
function displayLogin(){
   global $logged_in;
   if($logged_in){
      if($_GET['p'] == 'mod') {
         include('mod-comm.php');
      } else {
         include('admin.php');
      }
   }
   else{
?>

<div style="text-align: center; width: 600px; margin-left: 60px; margin-bottom: 30px;">
<span style="position: relative; background-color: #FFFFFF; top: 24px; font-size: 14px; font-weight: bold; left: -220px;">&nbsp;Login&nbsp;</span>
<div style="margin-top: 15px; margin-left: 40px; border: 1px solid #555555; height: 110px; width: 350px; padding: 30px;">
<form action="" method="post">
<table align="left" border="0" cellspacing="0" cellpadding="3" style="margin-top: 0px; margin-left: 47px; width: 250px;">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30"></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30"></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" style="margin-left: 10px;" name="remember">
<font size="2">Remember me next time</td></tr>
</table>
<p align="right" style="margin-right: 20px; margin-top: 5px;"><input type="submit" name="sublogin" value="Login"></p>
</form>
</div>
</div>

<?
   }
}


/**
 * Checks to see if the user has submitted his
 * username and password through the login form,
 * if so, checks authenticity in database and
 * creates session.
 */
if(isset($_POST['sublogin'])){
   /* Check that all fields were typed in */
   if(!$_POST['user'] || !$_POST['pass']){
      die('<script language="javascript">alert("You didn\'t fill in a required field."); history.back();</script>');
   }
   /* Spruce up username, check length */
   $_POST['user'] = trim($_POST['user']);
   if(strlen($_POST['user']) > 30){
      die('<script language="javascript">alert("Sorry, the username is longer than 30 characters, please shorten it."); history.back();</script>');
   }

   /* Checks that username is in database and password is correct */
   $md5pass = md5($_POST['pass']);
   $result = confirmUser($_POST['user'], $md5pass);

   /* Check error codes */
   if($result == 1){
      die('<script language="javascript">alert("That username doesn\'t exist in our database."); history.back();</script>');
   }
   else if($result == 2){
      die('<script language="javascript">alert("Incorrect password, please try again."); history.back();</script>');
   }

   /* Username and password correct, register session variables */
   $_POST['user'] = stripslashes($_POST['user']);
   $_SESSION['username'] = $_POST['user'];
   $_SESSION['password'] = $md5pass;

   /**
    * This is the cool part: the user has requested that we remember that
    * he's logged in, so we set two cookies. One to hold his username,
    * and one to hold his md5 encrypted password. We set them both to
    * expire in 100 days. Now, next time he comes to our site, we will
    * log him in automatically.
    */
   if(isset($_POST['remember'])){
      setcookie("cookname", $_SESSION['username'], time()+60*60*24*100, "/");
      setcookie("cookpass", $_SESSION['password'], time()+60*60*24*100, "/");
   }

   /* Quick self-redirect to avoid resending data on refresh */
   echo "<meta http-equiv=\"Refresh\" content=\"0;url=$HTTP_SERVER_VARS[PHP_SELF]\">";
   return;
}

/* Sets the value of the logged_in variable, which can be used in your code */
$logged_in = checkLogin();

?>
