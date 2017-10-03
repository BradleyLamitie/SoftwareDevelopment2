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
include ( 'includes/header.html' ) ;


# Display body section.
echo "<h1>Admin Home</h1><p>You are now logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
echo "<form action='adminReport.php' method='get'><p><input type='submit' value='Update a Record:' > *</p></form>";
echo "<p>       * For this function you need to know the ID number</p>";
echo "<form action='adminPurge.php' method='get'><p> <input type='submit' value='Delete a Record: ' > *</p></form>";
echo "<p>* For this function you need to know the ID number</p>";
echo "<form action='adminReport.php' method='get'><p> <input type='submit' value='Run a Report:' ></p></form>";
?>
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>

<?php
# Create navigation links.
echo '<p><a href="login.php" >Logout</a></p>';


# Display footer section.
include ( 'includes/footer.html' ) ;
?>