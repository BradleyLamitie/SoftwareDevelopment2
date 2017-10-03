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
echo "<h1>Report and Update</h1>";
echo "<form action='adminql.php' method='get'><p>ID Number: <input type='text' name='id' id = 'id'> <input type='submit' value='Submit' > </p></form>";
echo "<form action='adminSearch.php' method='get'><p>Before:  <input type='date' name='beforeDate' id = 'beforeDate'><input type='submit' value='Submit' ></p></form>";
echo "<form action='adminSearch.php' method='get'><p>Between:  <input type='date' name='betweenDate1'> & <input type='date' name='betweenDate2'><input type='submit' value='Submit' ></p></form>";
echo "<form action='adminSearch.php' method='get'><p>After:  <input type='date' name='afterDate'>   <input type='submit' value='Submit' ></p></form>";

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