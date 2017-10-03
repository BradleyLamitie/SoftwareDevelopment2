<?php
 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - ql.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.

# DISPLAY COMPLETE LOGIN PAGE.
$page_title = 'quicklink' ;

include ( 'includes/header.html' ) ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

  //Using GET 
  $var_value = $_GET['id'];
  // echo $var_value; SELECT picture,stuff_id, name, brand, color, loc_name, room,  lf_date, 
  //		description, owner_finder, phone, email FROM stuff s INNER JOIN 
  //		locations l ON s.stuff_id = l.loc_id WHERE stuff_id = 3;

$query = 'SELECT picture,stuff_id, name, loc_name, brand, color, room, lf_date, description, status 
	FROM stuff s INNER JOIN locations l ON s.location_id = l.loc_id WHERE stuff_id = ' .  $var_value;
		
$result = mysqli_query($dbc, $query);
 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
#mysqli_real_escape_string(connection,escapestring);
// echo  $row['picture'];
?>

<!-- Display body section. -->
<h1>Quick Link</h1>
    <p>Picture: 		<img src = "<?php echo('includes/'.$row['picture']);?>" 
		alt = "Picture of item" height="80" width="80">
    <p>Item ID: 		<input type = "text" id = "idnum" value = "<?php 
		echo($row['stuff_id']); ?>"  readonly />
	<p>Item name:		<input type = "text" id = "itemname" value = "<?php 
		echo($row['name']); ?>" readonly />
	<p>Brand: 			<input type = "text" id = "brand" value = "<?php 
		echo($row['brand']); ?>" readonly />
	<p>Color:           <input type = "text" id = "color" value = "<?php 
		echo($row['color']); ?>" readonly />
	<p>Marist Building: <input type = "text" id = "building" value = "<?php 
		echo($row['loc_name']); ?>" readonly />
	<p>Room: 			<input type = "text" id = "room" value = "<?php 
		echo($row['room']); ?>" readonly />
	<p>Date Reported: 	<input type = "text" id = "date" value = "<?php 
		echo($row['lf_date']); ?>" readonly />
		
	<p>Description: 	<input type = "text" id = "description" value = "<?php 
		echo($row['description']); ?>" style = " width: 400px; " readonly />

	<p>Status:      	<input type = "text" id = "status" value = "<?php 
		echo($row['status']); ?>" style = "width: 300px;" readonly />

<h4>Use the buttons below to start over, contact an Administrator, or back up one page.</h4>        
<form action="landing.php"><input type="submit" value="Limbo Home" /></form>
<!-- <form action="lost.php"><input type="submit" value="Lost Something" /></form>
<form action="found.php"><input type="submit" value="Found Something" /></form>-->
<form action="contactAdmin.php"><input type="submit" value="Contact an Admin" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
