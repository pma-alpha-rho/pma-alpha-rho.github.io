<?php

$dbhost = '152.2.45.143:3306';
$dbuser = 'geoff';
$dbpass = 'spider';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'pma_ushering';
mysql_select_db($dbname);

$query  = "SELECT name, date FROM list";
$result = mysql_query($query);

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $listings[$row['date']] = $row['name'];
}

echo '

<h3>Sign Up List, Ushering 2008-2009</h3>
<form name="myForm">
<div style="position: absolute; top: 60px; width: 975px; background-color: #e0ecff; text-align: center;">

   <div style="width: 21.7%; background-color: white; float: left; margin: 10px; padding: 5px;">
      <p><b>October 2<sup>nd</sup> - Jazz Band, HHA at 7:30PM</b></p>
      1. <input type="text" id="oct-2-1"';

if($listings['oct-2-1'] != null) {
   echo " value=\"{$listings['oct-2-1']}\" disabled=\"disabled\"";
}

      echo '><input id="oct-2-1-button" type="button" onclick="ajaxFunction(\'oct-2-1\')" value=">"';

if($listings['oct-2-1'] != null) { echo "disabled=\"disabled\""; }

echo'><br />
      2. <input type="text" id="oct-2-2"';

if($listings['oct-2-2'] != null) {
   echo " value=\"{$listings['oct-2-2']}\" disabled=\"disabled\"";
}

      echo ' /><input id="oct-2-2-button" type="button" onclick="ajaxFunction(\'oct-2-2\')" value=">"';

if($listings['oct-2-2'] != null) { echo "disabled=\"disabled\""; }
      echo' />
<div style="background-color: #EEE;">
<p><b>October 3<sup>rd</sup> - Jazz Combos, HH107 at 4:00PM</b></p>
      1. <input type="text" id="oct-3-1"';

if($listings['oct-3-1'] != null) {
   echo " value=\"{$listings['oct-3-1']}\" disabled=\"disabled\"";
}

      echo '/><input id="oct-3-1-button" type="button" onclick="ajaxFunction(\'oct-3-1\')" value=">"';

if($listings['oct-3-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="oct-3-2"';

if($listings['oct-3-2'] != null) {
   echo " value=\"{$listings['oct-3-2']}\" disabled=\"disabled\"";
}

      echo '/><input id="oct-3-2-button" type="button" onclick="ajaxFunction(\'oct-3-2\')" value=">" ';

if($listings['oct-3-2'] != null) { echo "disabled=\"disabled\""; }

      echo'/><br /><br />
</div>
<p><b>October 23<sup>rd</sup> - Brass Chamber Music, HHA at 7:30PM</b></p>
      1. <input type="text" id="oct-23-1"';

if($listings['oct-23-1'] != null) {
   echo " value=\"{$listings['oct-23-1']}\" disabled=\"disabled\"";
}

      echo ' /><input id="oct-23-1-button" type="button" onclick="ajaxFunction(\'oct-23-1\')" value=">"';

if($listings['oct-23-1'] != null) { echo "disabled=\"disabled\""; }

echo' /><br />
      2. <input type="text" id="oct-23-2"';

if($listings['oct-23-2'] != null) {
   echo " value=\"{$listings['oct-23-2']}\" disabled=\"disabled\"";
}

      echo' /><input id="oct-23-2-button" type="button" onclick="ajaxFunction(\'oct-23-2\')" value=">"';
if($listings['oct-23-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>October 30<sup>th</sup> - Percussion Ensemble, HH107 at 7:30PM</b></p>
      1. <input type="text" id="oct-30-1"';

if($listings['oct-30-1'] != null) {
   echo " value=\"{$listings['oct-30-1']}\" disabled=\"disabled\"";
}

      echo' /><input id="oct-30-1-button" type="button" onclick="ajaxFunction(\'oct-30-1\')" value=">"';
if($listings['oct-30-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="oct-30-2" ';

if($listings['oct-30-2'] != null) {
   echo " value=\"{$listings['oct-30-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="oct-30-2-button" type="button" onclick="ajaxFunction(\'oct-30-2\')" value=">"';
if($listings['oct-30-2'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br /><br />
</div>
<p><b>November 14<sup>th</sup> - Chamber Players, PRH at 7:30PM</b></p>
      1. <input type="text" id="nov-14-1" ';

if($listings['nov-14-1'] != null) {
   echo " value=\"{$listings['nov-14-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-14-1-button" type="button" onclick="ajaxFunction(\'nov-14-1\')" value=">" ';
if($listings['nov-14-1'] != null) { echo "disabled=\"disabled\""; }

      echo'/><br />
      2. <input type="text" id="nov-14-2" ';

if($listings['nov-14-2'] != null) {
   echo " value=\"{$listings['nov-14-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-14-2-button" type="button" onclick="ajaxFunction(\'nov-14-2\')" value=">"';
if($listings['nov-14-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>November 15<sup>th</sup> - Jazz Band, HHA at 8:00PM</b></p>
      1. <input type="text" id="nov-15-1" ';

if($listings['nov-15-1'] != null) {
   echo " value=\"{$listings['nov-15-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-15-1-button" type="button" onclick="ajaxFunction(\'nov-15-1\')" value=">"';
if($listings['nov-15-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="nov-15-2"';

if($listings['nov-15-2'] != null) {
   echo " value=\"{$listings['nov-15-2']}\" disabled=\"disabled\"";
}

      echo' /><input id="nov-15-2-button" type="button" onclick="ajaxFunction(\'nov-15-2\')" value=">"';
if($listings['nov-15-2'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br /><br />
</div>
   </div>

   <div style="width: 21.7%; background-color: white; float: left; margin: 10px; padding: 5px;">
<div style="background-color: #EEE;">
<p><b>November 16<sup>th</sup> - Carolina Choir/Chamber Singers, HHA at 7:30PM</b></p>
      1. <input type="text" id="nov-16-1" ';

if($listings['nov-16-1'] != null) {
   echo " value=\"{$listings['nov-16-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-16-1-button" type="button" onclick="ajaxFunction(\'nov-16-1\')" value=">"';
if($listings['nov-16-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="nov-16-2" ';

if($listings['nov-16-2'] != null) {
   echo " value=\"{$listings['nov-16-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-16-2-button" type="button" onclick="ajaxFunction(\'nov-16-2\')" value=">" ';
if($listings['nov-16-2'] != null) { echo "disabled=\"disabled\""; }

      echo'/><br /><br />
</div>
<p><b>November 21<sup>st</sup> - Opera, HHA at 7:30PM</b></p>
      1. <input type="text" id="nov-21-1" ';

if($listings['nov-21-1'] != null) {
   echo " value=\"{$listings['nov-21-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-21-1-button" type="button" onclick="ajaxFunction(\'nov-21-1\')" value=">"';
if($listings['nov-21-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="nov-21-2" ';


if($listings['nov-21-2'] != null) {
   echo " value=\"{$listings['nov-21-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-21-2-button" type="button" onclick="ajaxFunction(\'nov-21-2\')" value=">"';

if($listings['nov-21-2'] != null) { echo "disabled=\"disabled\""; }
      echo' />
<div style="background-color: #EEE;">
<p><b>November 22<sup>nd</sup> - Opera, HHA at 8:00PM</b></p>
      1. <input type="text" id="nov-22-1" ';

if($listings['nov-22-1'] != null) {
   echo " value=\"{$listings['nov-22-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-22-1-button" type="button" onclick="ajaxFunction(\'nov-22-1\')" value=">"';

if($listings['nov-22-1'] != null) { echo "disabled=\"disabled\""; }
      echo' /><br />
      2. <input type="text" id="nov-22-2" ';

if($listings['nov-22-2'] != null) {
   echo " value=\"{$listings['nov-22-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-22-2-button" type="button" onclick="ajaxFunction(\'nov-22-2\')" value=">"';
if($listings['nov-22-2'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br /><br />
</div>
<p><b>November 23<sup>rd</sup> - Glee Clubs, HHA at 3:00PM</b></p>
      1. <input type="text" id="nov-23-1" ';

if($listings['nov-23-1'] != null) {
   echo " value=\"{$listings['nov-23-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-23-1-button" type="button" onclick="ajaxFunction(\'nov-23-1\')" value=">"';
if($listings['nov-23-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="nov-23-2" ';

if($listings['nov-23-2'] != null) {
   echo " value=\"{$listings['nov-23-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="nov-23-2-button" type="button" onclick="ajaxFunction(\'nov-23-2\')" value=">"';
if($listings['nov-23-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>December 2<sup>nd</sup> - Jazz Band and Charanga, Great Hall at 8:00PM</b></p>
      1. <input type="text" id="dec-2-1" ';

if($listings['dec-2-1'] != null) {
   echo " value=\"{$listings['dec-2-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="dec-2-1-button" type="button" onclick="ajaxFunction(\'dec-2-1\')" value=">"';
if($listings['dec-2-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="dec-2-2" ';

if($listings['dec-2-2'] != null) {
   echo " value=\"{$listings['dec-2-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="dec-2-2-button" type="button" onclick="ajaxFunction(\'dec-2-2\')" value=">"';
if($listings['dec-2-2'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      3. <input type="text" id="dec-2-3" ';

if($listings['dec-2-3'] != null) {
   echo " value=\"{$listings['dec-2-3']}\" disabled=\"disabled\"";
}

      echo'/><input id="dec-2-3-button" type="button" onclick="ajaxFunction(\'dec-2-3\')" value=">"';
if($listings['dec-2-3'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br /><br />
</div>
<p><b>December 5<sup>th</sup> - Baroque Ensemble, PRH at 8:00PM</b></p>
      1. <input type="text" id="dec-5-1"';

if($listings['dec-5-1'] != null) {
   echo " value=\"{$listings['dec-5-1']}\" disabled=\"disabled\"";
}

      echo' /><input id="dec-5-1-button" type="button" onclick="ajaxFunction(\'dec-5-1\')" value=">"';
if($listings['dec-5-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="dec-5-2"';

if($listings['dec-5-2'] != null) {
   echo " value=\"{$listings['dec-5-2']}\" disabled=\"disabled\"";
}

      echo' /><input id="dec-5-2-button" type="button" onclick="ajaxFunction(\'dec-5-2\')" value=">"';
if($listings['dec-5-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />

</div>

   <div style="width: 21.7%; background-color: white; float: left; margin: 10px; padding: 5px;">

<p><b>December 7<sup>th</sup> - Consort of Viols, PRH at 3:00PM</b></p>
      1. <input type="text" id="dec-7-1" ';

if($listings['dec-7-1'] != null) {
   echo " value=\"{$listings['dec-7-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="dec-7-1-button" type="button" onclick="ajaxFunction(\'dec-7-1\')" value=">"';
if($listings['dec-7-1'] != null) { echo "disabled=\"disabled\""; }
      echo' /><br />
      2. <input type="text" id="dec-7-2" ';

if($listings['dec-7-2'] != null) {
   echo " value=\"{$listings['dec-7-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="dec-7-2-button" type="button" onclick="ajaxFunction(\'dec-7-2\')" value=">"';
if($listings['dec-7-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>March 1<sup>st</sup> - Symphony Orchestra, HHA at 7:30PM</b></p>
      1. <input type="text" id="mar-1-1" ';

if($listings['mar-1-1'] != null) {
   echo " value=\"{$listings['mar-1-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="mar-1-1-button" type="button" onclick="ajaxFunction(\'mar-1-1\')" value=">"';
if($listings['mar-1-1'] != null) { echo "disabled=\"disabled\""; }
      echo' /><br />
      2. <input type="text" id="mar-1-2" ';

if($listings['mar-1-2'] != null) {
   echo " value=\"{$listings['mar-1-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="mar-1-2-button" type="button" onclick="ajaxFunction(\'mar-1-2\')" value=">"';
if($listings['mar-1-2'] != null) { echo "disabled=\"disabled\""; }
      echo' /><br />
      3. <input type="text" id="mar-1-3" ';

if($listings['mar-1-3'] != null) {
   echo " value=\"{$listings['mar-1-3']}\" disabled=\"disabled\"";
}

      echo'/><input id="mar-1-3-button" type="button" onclick="ajaxFunction(\'mar-1-3\')" value=">"';
if($listings['mar-1-3'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<br /><br /></div>
<p><b>March 26<sup>th</sup> - Brass Chamber Music, HHA at 7:30PM</b></p>
      1. <input type="text" id="mar-26-1" ';

if($listings['mar-26-1'] != null) {
   echo " value=\"{$listings['mar-26-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="mar-26-1-button" type="button" onclick="ajaxFunction(\'mar-26-1\')" value=">"';
if($listings['mar-26-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="mar-26-2" ';

if($listings['mar-26-2'] != null) {
   echo " value=\"{$listings['mar-26-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="mar-26-2-button" type="button" onclick="ajaxFunction(\'mar-26-2\')" value=">"';
if($listings['mar-26-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>March 31<sup>st</sup> - Jazz Band, HHA at 7:30PM</b></p>
      1. <input type="text" id="mar-31-1"';

if($listings['mar-31-1'] != null) {
   echo " value=\"{$listings['mar-31-1']}\" disabled=\"disabled\"";
}

      echo' /><input id="mar-31-1-button" type="button" onclick="ajaxFunction(\'mar-31-1\')" value=">"';
if($listings['mar-31-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="mar-31-2" ';

if($listings['mar-31-2'] != null) {
   echo " value=\"{$listings['mar-31-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="mar-31-2-button" type="button" onclick="ajaxFunction(\'mar-31-2\')" value=">"';
if($listings['mar-31-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<br /><br /></div>
<p><b>April 21<sup>st</sup> - Percussion Ensemble, HH107 at 7:30PM</b></p>
      1. <input type="text" id="apr-2-1" ';

if($listings['apr-2-1'] != null) {
   echo " value=\"{$listings['apr-2-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-2-1-button" type="button" onclick="ajaxFunction(\'apr-2-1\')" value=">"';
if($listings['apr-2-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-2-2" ';

if($listings['apr-2-2'] != null) {
   echo " value=\"{$listings['apr-2-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-2-2-button" type="button" onclick="ajaxFunction(\'apr-2-2\')" value=">"';
if($listings['apr-2-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>April 16<sup>th</sup> - Jazz Band, HHA at 7:30PM</b></p>
      1. <input type="text" id="apr-16-1" ';

if($listings['apr-16-1'] != null) {
   echo " value=\"{$listings['apr-16-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-16-1-button" type="button" onclick="ajaxFunction(\'apr-16-1\')" value=">"';
if($listings['apr-16-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-16-2" ';


if($listings['apr-16-2'] != null) {
   echo " value=\"{$listings['apr-16-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-16-2-button" type="button" onclick="ajaxFunction(\'apr-16-2\')" value=">"';
if($listings['apr-16-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<br /><br /></div>
   </div>

   <div style="width: 21.7%; background-color: white; float: left; margin: 10px; padding: 5px;">
<div style="background-color: #EEE;">
<p><b>April 17<sup>th</sup> - Jazz Combos, HH107 at 2:00PM</b></p>
      1. <input type="text" id="apr-17-1"';

if($listings['apr-17-1'] != null) {
   echo " value=\"{$listings['apr-17-1']}\" disabled=\"disabled\"";
}

      echo' /><input id="apr-17-1-button" type="button" onclick="ajaxFunction(\'apr-17-1\')" value=">"';
if($listings['apr-17-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-17-2" ';


if($listings['apr-17-2'] != null) {
   echo " value=\"{$listings['oct-3-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-17-2-button" type="button" onclick="ajaxFunction(\'apr-17-2\')" value=">"';
if($listings['apr-17-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<br /><br /></div>
<p><b>April 23<sup>rd</sup> - Opera, HHA at 7:30PM</b></p>
      1. <input type="text" id="apr-23-1" ';

if($listings['apr-23-1'] != null) {
   echo " value=\"{$listings['apr-23-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-23-1-button" type="button" onclick="ajaxFunction(\'apr-23-1\')" value=">"';
if($listings['apr-23-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-23-2" ';

if($listings['apr-23-2'] != null) {
   echo " value=\"{$listings['apr-23-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-23-2-button" type="button" onclick="ajaxFunction(\'apr-23-2\')" value=">"';
if($listings['apr-23-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>April 25<sup>th</sup> - Opera, HHA at 8:00PM</b></p>
      1. <input type="text" id="apr-25-1" ';


if($listings['apr-25-1'] != null) {
   echo " value=\"{$listings['apr-25-1']}\" disabled=\"disabled\"";
}
      echo'/><input id="apr-25-1-button" type="button" onclick="ajaxFunction(\'apr-25-1\')" value=">"';
if($listings['apr-25-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-25-2" ';

if($listings['apr-25-2'] != null) {
   echo " value=\"{$listings['apr-25-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-25-2-button" type="button" onclick="ajaxFunction(\'apr-25-2\')" value=">"';
if($listings['apr-25-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<br /><br /></div>
<p><b>April 26<sup>th</sup> - Glee Clubs, HHA at 4:00PM</b></p>
      1. <input type="text" id="apr-26-1" ';

if($listings['apr-26-1'] != null) {
   echo " value=\"{$listings['apr-26-1']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-26-1-button" type="button" onclick="ajaxFunction(\'apr-26-1\')" value=">"';
if($listings['apr-26-1'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-26-2" ';

if($listings['apr-26-2'] != null) {
   echo " value=\"{$listings['apr-26-2']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-26-2-button" type="button" onclick="ajaxFunction(\'apr-26-2\')" value=">"';
if($listings['apr-26-2'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<div style="background-color: #EEE;">
<p><b>April 26<sup>th</sup> - Baroque Ensemble/Consort of Viols, PRH at 7:30PM</b></p>
      1. <input type="text" id="apr-26-3" ';

if($listings['apr-26-3'] != null) {
   echo " value=\"{$listings['apr-26-3']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-26-3-button" type="button" onclick="ajaxFunction(\'apr-26-3\')" value=">"';
if($listings['apr-26-3'] != null) { echo "disabled=\"disabled\""; }

      echo' /><br />
      2. <input type="text" id="apr-26-4" ';

if($listings['apr-26-4'] != null) {
   echo " value=\"{$listings['apr-26-4']}\" disabled=\"disabled\"";
}

      echo'/><input id="apr-26-4-button" type="button" onclick="ajaxFunction(\'apr-26-4\')" value=">"';
if($listings['apr-26-4'] != null) { echo "disabled=\"disabled\""; }

      echo' />
<br /><br /></div>
   </div>

</div>
</form>';

?>
