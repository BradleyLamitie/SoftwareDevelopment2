
<?php 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminPurge.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis?>
<p> THIS PAGE IS CURRENTLY UNDER CONSTRUCTION!!!</p>
<p> Click the back buttonm to go back to limbo functions.</p>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>
<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminReport.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.
$page_title = 'Admin Report' ;
include ( 'includes/header.html' ) ;

# Display body section.
echo "<h1>Purge Claimed items</h1>";
echo "<form action='adminPurgeConfirm.php' method='get'><p>ID Number: <input type='text' name='id' id = 'id'> <input type='submit' value='Submit' > </p></form>";
echo "<form action='adminPurgeConfirm.php' method='get'><p>Before:  <input type='date' name='beforeDate' id = 'beforeDate'><input type='submit' value='Submit' ></p></form>";

# Create navigation links.
echo '<p><a href="login.php" >Logout</a></p>';
?>
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>

<?php
# Display footer section.
include ( 'includes/footer.html' ) ;
?>