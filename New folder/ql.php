<?php
 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - ql.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.

# This page gives the user a little more information for a possible match.
# If determined not a match, they can continue to add_more.php to input more information.

session_start();
$last_page = $_SESSION['last_page'];

# DISPLAY Quicklink PAGE.
$page_title = 'quicklink' ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

# style sheet
echo '<link rel="stylesheet" href="Limbo.css">';

?>
<!-- -------------------------------------------- -->
<!-- Display button section. -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" 
	id="logo" style="position: absolute; top:300px; height: 125px; right:27px;"></div>

<form action="landing.php"><input type="submit" class="sideButton" id="button1" value="Limbo Home" /></form>
<form action="lost.php"><input type="submit" class="sideButton" id="button2" value="Lost Something?" /></form>
<form action="found.php"><input type="submit" class="sideButton" id="button3" value="Found Something?" /></form> 
<form action="contactAdmin.php"><input type="submit" class="sideButton" id="button4" value="Contact an Admin" /></form>

<div id = "centerContent">
<!-- -------------------------------------------- -->
<?php
# Grabs the stuff_id value to be used in the query.
$var_value = $_GET['id'];

# Selects the requested information from the stuff database if the stuff location_id == locations loc_id.
$query = 'SELECT picture, stuff_id, name, loc_name, brand, color, room, lf_date, description, status 
	FROM stuff s INNER JOIN locations l ON s.location_id = l.loc_id WHERE stuff_id = ' .  $var_value;
$result = mysqli_query($dbc, $query);

# No while is needed here, because we are only looking for the information from 1 record. 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
?>

<!-- -------------------------------------------- -->
<!-- Display body section. -->

<!-- Display page heading. -->
<h1>Quick Link</h1>

<p><h4>Use the buttons to the left to start over, go to lost or found, or contact an Administrator with 
	the Item ID if you have found a match.</p></h4>	
		
    <p>Picture: 		<img src = "uploads/<?php echo($row['picture']);?>" 
		alt = "No Picture Available" height="100" width="100">
	<p>Status:      	<input type = "text" id = "status" value = "<?php 
		echo($row['status']); ?>" style =" width: 200px; " readonly />	
    <p>Item ID: 		<input type = "text" id = "idnum" value = "<?php 
		echo($row['stuff_id']); ?>" style =" width: 200px; " readonly />
	<p>Item name:		<input type = "text" id = "itemname" value = "<?php 
		echo($row['name']); ?>"style =" width: 200px; " readonly />
	<p>Brand: 			<input type = "text" id = "brand" value = "<?php 
		echo($row['brand']); ?>"style =" width: 200px; " readonly />
	<p>Color:           <input type = "text" id = "color" value = "<?php 
		echo($row['color']); ?>" style =" width: 200px; " readonly />
	<p>Building: 		<input type = "text" id = "building" value = "<?php 
		echo($row['loc_name']); ?>"style =" width: 200px; " readonly />
	<p>Room: 			<input type = "text" id = "room" value = "<?php 
		echo($row['room']); ?>"style =" width: 200px; " readonly />
	<p>Date Reported: 	<input type = "text" id = "date" value = "<?php 
		echo($row['lf_date']); ?>"style =" width: 200px; " readonly />
	<p>Description: 	<input type = "text" id = "description" value = "<?php 
		echo($row['description']); ?>" style = "width:  400px; " readonly />	
	
<?php 
if ($last_page == "landing") 
{
?>
	<form action="landing.php"> <input type="submit" value="Back" /></form>
<?php 
}
else
{
?>
	<form><input type="button" value="Back" onClick="history.go(-2);return true;"/></form> 
<?php
}

?>
</div>