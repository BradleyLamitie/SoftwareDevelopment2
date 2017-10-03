<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminReport.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.
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
	<?php
# Display body section.
echo "<h1>Report and Update</h1>";
echo "<form action='adminql.php' method='get'><p>ID Number: <input type='text' name='id' id = 'id'> <input type='submit' value='Submit' class='centerButton'> </p></form>";
echo "<form action='adminSearch.php' method='get'><p>Before:  <input type='date' name='beforeDate' id = 'beforeDate'><input type='submit' value='Submit'class='centerButton'></p></form>";
echo "<form action='adminSearch.php' method='get'><p>Between:  <input type='date' name='betweenDate1'> & <input type='date' name='betweenDate2'><input type='submit' value='Submit' class='centerButton' ></p></form>";
echo "<form action='adminSearch.php' method='get'><p>After:  <input type='date' name='afterDate'>   <input type='submit' value='Submit' class='centerButton'></p></form>";
?>
	<form action="login.php"><input type="submit" value="Logout"  class="centerButton" /></form>

</div>
<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
</div>