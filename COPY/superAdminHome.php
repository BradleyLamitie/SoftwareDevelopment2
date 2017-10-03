<?php # DISPLAY COMPLETE LOGGED IN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - superAdminHome.php
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
echo "<h1>Super Admin Home</h1><p>You are logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
echo "<form action='updatePassword.php' method='post'><p> <input type='submit' value='Change Password' ></p></form>";
echo "<form action='addAdmin.php' method='get'><p> <input type='submit' value='Add an Admin' ></p></form>";
echo "<p>       To add an admin, simply click the button above and fill out the form.</p>";
echo "<form action='deleteAdmin.php' method='get'><p> <input type='submit' value='Delete an Admin' ></p></form>";
echo "<p>       To delete an admin, you can search by name and choose to delete them.</p>";
echo "<form action='updateAdmin.php' method='get'><p> <input type='submit' value='Update an Admin' ></p></form>";
echo "<p>       To update an admin's record, you can search by name and edit their form.</p>";
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