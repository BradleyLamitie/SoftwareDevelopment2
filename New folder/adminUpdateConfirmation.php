<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - landing.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

echo '<link rel="stylesheet" href="Limbo.css">';

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'includes/login_tools.php' ) ; load() ; }

?>
<!-- -------------------------------------------- -->
<!-- Display button section -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo"></div>

<form action="landing.php"> <input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
<form action="contactSuperAdmin.php"><input class="sideButton" id="button4" type="submit" 
	value="Contact Super Admin" style="font-size:13px;"/></form>
<form><input type="button" value="Back" onClick="history.go(-4);return true;" class="sideButton" id="button5"/></form>

<div id = "centerContent">
<!-- -------------------------------------------- -->

<h1> You have updated the admin's info successfully!</h1>
<h3>Please press the back button below to return to the login page.</h3>
<form action="superAdminHome.php"><input type="submit" value="Super Admin Home"  class="centerButton" style="font-size:13px;"/></form>

</div>
<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
