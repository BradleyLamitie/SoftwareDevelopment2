
<?php 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminPurge.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
$page_title = 'Admin Report' ;
 echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="lost.php">         <input type="submit" value="Lost Something" class="sideButton" id="button2"/></form>
    <form action="found.php"> 	        <input type="submit" value="Found Something" class="sideButton" id="button3"/></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button4" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<form><input type="button" value="Back" onClick="history.go(-4);return true;" class="sideButton" id="button5"/></form>

	<div id = "centerContent"> 
<h1> You have updated the item's info successfully!</h1>
<h3>Please press the back button below to return to the admin home page.</h3>
<?php
# Display body section.
echo "<h1>Purge Claimed items</h1>";
echo "<form action='adminPurgeConfirm.php' method='get'><p>ID Number: <input type='text' name='id' id = 'id'> <input type='submit' value='Submit' > </p></form>";
echo "<form action='adminPurgeConfirm.php' method='get'><p>Before:  <input type='date' name='beforeDate' id = 'beforeDate'><input type='submit' value='Submit' ></p></form>";

# Create navigation links.
?>
<form action="login.php"><input type="submit" value="Logout"  class="centerButton" /></form>

</div>
<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
