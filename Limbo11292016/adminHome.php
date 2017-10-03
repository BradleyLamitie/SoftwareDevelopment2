<?php # DISPLAY COMPLETE LOGGED IN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminhome.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Access session.
session_start() ; 

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Admin Home' ;

echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
     <form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<div id = "centerContent"> 
<?php	
# Display body section.
echo "<h1>Admin Home</h1><p>You are now logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
echo "<form action='adminReport.php' method='get'><p><input type='submit' value='Update a Record:'class='centerButton' > *</p></form>";
echo "<p>       * For this function you need to know the ID number</p>";
echo "<form action='adminPurge.php' method='get'><p> <input type='submit' value='Delete a Record: ' class='centerButton'> *</p></form>";
echo "<p>* For this function you need to know the ID number</p>";
echo "<form action='adminReport.php' method='get'><p> <input type='submit' value='Run a Report:' class='centerButton'></p></form>";
?>
<form action="login.php"><input type="submit" value="Logout"  class="centerButton" /></form>



</div>
<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>