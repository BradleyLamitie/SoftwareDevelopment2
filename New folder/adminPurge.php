<?php 

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminPurge.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

# Set page title.
$page_title = 'Admin Report' ;

# Start the session
Session_start();

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'includes/login_tools.php' ) ; load() ; }

# style sheet
echo '<link rel="stylesheet" href="Limbo.css">';

?>
<!-- -------------------------------------------- -->
<!-- Display button section.]-->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo"></div>

<form action="landing.php"> <input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
<form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" 
	value="Contact Super Admin" style="font-size:13px;"/></form>
<form><input type="button" value="Back" onClick="history.go(-4);return true;" class="sideButton" id="button5"/></form>

<div id = "centerContent">
 
<h1> Purge Claimed Items</h1>
<h3>From here you can either delete one specific item, or delete all claimed items reported before a specified date.</h3>
<!-- -------------------------------------------- -->

<?php
# Display body section.
echo "<form action='adminPurgeConfirm.php' method='get'><p>ID Number: <input type='text' name='id' id = 'id'> 
	<input type='submit' value='Submit' > </p></form>";
echo "<form action='adminPurgeConfirm.php' method='get'><p>Before:  <input type='date' name='beforeDate' 
	id = 'beforeDate'><input type='submit' value='Submit' ></p></form>";

# Create navigation links.
?>
<form action="login.php"><input type="submit" value="Logout"  class="sideButton"id="button4"/></form>

</div>

