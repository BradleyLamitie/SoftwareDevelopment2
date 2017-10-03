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

# DISPLAY COMPLETE LOGIN PAGE.
$page_title = 'quicklink' ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

# style sheet
echo '<link rel="stylesheet" href="Limbo.css">';
?>
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo" style="position: absolute; top:300px; height: 125px; right:27px;">
</div>

<form action="landing.php">	    <input type="submit" class="sideButton" id="button1" value="Limbo Home" /></form>
<form action="lost.php">   		<input type="submit" class="sideButton" id="button2" value="Back to Lost" /></form>
<form action="found.php">       <input type="submit" class="sideButton" id="button3" value="Back to Found" /></form> 
<form action="contactAdmin.php"><input type="submit" class="sideButton" id="button4" value="Contact an Admin" /></form>

<div id = "centerContent">
<?php
$var_value = $_GET['id'];

$query = 'SELECT picture,stuff_id, name, loc_name, brand, color, room, lf_date, description, status 
	FROM stuff s INNER JOIN locations l ON s.location_id = l.loc_id WHERE stuff_id = ' .  $var_value;
		
$result = mysqli_query($dbc, $query);
 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
?>

<!-- Display body section. -->
<h1>Quick Link</h1>
    <p>Picture: 		<img src = "<?php echo($row['picture']);?>" 
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
		
		
<h4>Use the buttons below to start over, go to lost or found, contact an Administrator if you have found a match,
		<p>or back up one page if this is not a match to the item you are reporting.</p>  If you are contacting an
		Administrator, he/she will want to know the Item id number of the match.</h4>		
	
<?php 
if ($last_page == "landing")
{
?>
	<form action="landing.php"> <input type="submit" value="Back" class="centerButton"/></form> 
<?php 
}
else 
{
?>
	<form> <input type="button" value="Back" onClick="history.go(-2); return true;"	class="centerButton" /></form> 
<?php
}

?>
</div>