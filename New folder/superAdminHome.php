<?php # DISPLAY COMPLETE LOGGED IN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - superAdminHome.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Access session.
session_start() ; 
# Call functions from another php file
require( 'includes/limbo_functions.php' );

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'includes/login_tools.php' ) ; load() ; }
 
# checks to see if an admin is a superAdmin 
# If they are a superAdmin allow the connection_aborted
# otherwise, redirect them to the login page.
if(!$_SESSION['superAdmin']){require ( 'includes/login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Admin Home' ;
echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>

	<div id = "centerContent"> 
<?php

# Display body section.
echo "<h1>Super Admin Home</h1><p>You are logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
echo "<form action='updatePassword.php' method='post'><p> <input type='submit' value='Change Password' class='centerButton'></p></form>";
echo "<p>       To add an admin, simply click the button above and fill out the form.</p>";
echo "<form action='addAdmin.php' method='get'><p> <input type='submit' value='Add an Admin'class='centerButton' ></p></form>";
echo "<p>       To delete an admin, you can search by name and choose to delete them.</p>";
echo "<form action='deleteAdmin.php' method='get'><p> <input type='submit' value='Delete an Admin' class='centerButton'></p></form>";
echo "<p>       To update an admin's record, you can search by name and edit their form.</p>";
echo "<form action='updateAdmin.php' method='get'><p> <input type='submit' value='Update an Admin' class='centerButton'></p></form>";
echo "<p>Run a report to update or see information about an item.</p>";
echo "<form action='adminReport.php' method='get'><p> <input type='submit' value='Run a Report:' class='centerButton'></p></form>";
echo "<p>To delete claimed items.</p>";
echo "<form action='adminPurge.php' method='get'><p> <input type='submit' value='Delete a Record: ' class='centerButton' > </p></form>";

?>
 <form method="post" action="login.php"><input class="centerButton" name="logout"  type="submit" value="Logout" style="font-size:13px;"/></form>

<?php
	

if(isset($_POST['logout'])){
	logout();
}

?>