<?php
if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
   setcookie("cookname", "", time()-60*60*24*100, "/");
   setcookie("cookpass", "", time()-60*60*24*100, "/");
}
session_start();
include("database.php");
include("login.php");
$currentpage = "blog";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>Carolina Women's Center - Blog</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<script type="text/javascript" src="common/animatedcollapse.js"></script>
<script type="text/javascript" src="../common/mootools.js"></script>
<script type="text/javascript" src="../common/demo.js"></script>
<link rel="shortcut icon" href="../common/favicon.ico">
<link rel="alternate" type="application/rss+xml" title="RSS" href="http://152.2.45.143/blog_feed.rss">
<script type="text/javascript">
var win;
function eventPop(theUrl) {
   win = window.open(theUrl, '', 'width=350, height=400, left=5, top=5, location=no, scrollbars=yes, toolbar=no, reziseable=no, menubar=no, status=no');
   if (window.focus) {win.focus()}
   return false;
}

function limitChars(textarea, limit, infodiv)
{
   var text = textarea.value;
   var textlength = text.length;
   var info = document.getElementById(infodiv);

   if(textlength > limit)
   {
      info.innerHTML = 'You cannot write more then '+limit+' characters!';
      textarea.value = text.substr(0,limit);
      return false;
   }
   else
   {
      info.innerHTML = 'You have '+ (limit - textlength) +' characters left.';
      return true;
   }
}

function check_comment(theForm) {
   if(document.getElementById('comment').value == "") {
      alert("Please fill in a comment to post");
      return false;
   }

   theForm.submit();
}
</script>
</head>

<body>
<div id="bg_effect"></div>


<div id="page">
   <div id="main">

      <div id="header">
                     <div id="top_box"><div id="unc_name" onclick="window.location='http://www.unc.edu'">
</div>
            <?php include('../common/search_box_home.php'); ?>
         </div><div id="cwc_name" style="top: 160px;">
</div>
               <div id="sub-header">
         </div>
      </div>

      <div id="middle_wrapper">

      <div id="left">
         <?php include('common/menu.php'); ?>
      </div>

      <div id="content">
      <center><img src="../images/blog_top.jpg" alt="The CWC Blog" title=""></center>


<?

if(!$logged_in){
   echo "<h1>Error!</h1>\n";
   echo "You are not currently logged in, logout failed. Back to <a href=\"index.php\">CWC Blog</a>";
}
else{
   /* Kill session variables */
   unset($_SESSION['username']);
   unset($_SESSION['password']);
   $_SESSION = array(); // reset session array
   session_destroy();   // destroy session.

   echo "<h1>Logged Out</h1>\n";
   echo "You have successfully <b>logged out</b>. Back to <a href=\"index.php\">CWC Blog</a>";
}

?>

      </div>

      <div id="right">

         <?php
               include('../common/blog_archives.php');
               include('../common/updates.php');
         ?>
      </div>

      </div>

      <div id="footer">
         <?php include('../common/footer.php'); ?>
      </div>

   </div>
</div>

</body>
</html>
