<?php
 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - ql.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.

# DISPLAY COMPLETE LOGIN PAGE.
$page_title = 'quicklink' ;
session_start();

include ( 'includes/header.html' ) ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

  //Using GET 
  $var_value = $_GET['id'];
  // echo $var_value; SELECT picture,stuff_id, name, brand, color, loc_name, room,  lf_date, 
  //		description, owner_finder, phone, email FROM stuff s INNER JOIN 
  //		locations l ON s.stuff_id = l.loc_id WHERE stuff_id = 3;

$query = 'SELECT * FROM users WHERE user_id = '. $var_value;
		
$result = mysqli_query($dbc, $query);
 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$super_admin = ($row['superAdmin']); 
echo($super_admin);
#mysqli_real_escape_string(connection,escapestring);
// echo  $row['picture'];
?>
<form method = "post" name = "deleteAdmin">
<!-- Display body section. -->
<h1>Admin Info:</h1>
	<p>Admin ID: 			<input type = "text" id = "user_id" name = "user_id" value = "<?php 
		echo($row['user_id']); ?>"style =" width: 200px; " readonly />
    <p>First Name: 		<input type="text" id= "first_name" name="first_name" value = "<?php 
		echo($row['first_name']);?>" style ="width = 200px;">
	<p>Last Name:      	<input type = "text" id = "last_name" name="last_name" value = "<?php 
		echo($row['last_name']); ?>" style =" width: 200px; "  />	
    <p>Email: 		<input type = "text" id = "email" name="email" value = "<?php 
		echo($row['email']); ?>" style =" width: 200px; "  />
	<p>Registration Date:		<input type = "text" id = "reg_Date" value = "<?php 
		echo($row['reg_date']); ?>"style =" width: 200px; " readonly />
	<p>Status: <select name = "superAdmin" id = "superAdmin" name="superAdmin" >superAdmin?</option>
					<option value =  "True"  <?php if($super_admin == 1){ echo('selected = "selected"');}?> >True</option>
					<option value =  "False" <?php if($super_admin == 0){ echo('selected = "selected"');}?>  > False </option>
				</select>				
<input type="submit" value="Update Admin" name = "update"/></form>
<h4>Use the buttons below to start over, contact an Administrator if you have found a match,
		or back up one page.</h4>		

<form action="landing.php">	    <input type="submit" value="Limbo Home" /></form>
<!-- <form action="lost.php">   <input type="submit" value="Lost Something" /></form>
<form action="found.php">       <input type="submit" value="Found Something" /></form> -->
<form action="contactAdmin.php"><input type="submit" value="Contact an Admin" /></form>
<form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form>

<h4><p>If the information above does not match the item you are reporting, click Continue to be </p>
	<p>directed to a page where you will enter more information about the item to be added to the database.</p><h4> 

 <form action="add_more.php"> <input type="submit" value="Continue" /></form> 
<!-- <form action="add_more.php"> <input type="submit" 
	value= "Continue" /></form> -->

<?php 
if(isset($_POST['update'])){
	  $first_name = $_POST['first_name'];
	  $last_name = $_POST['last_name'];
	  $email = $_POST['email'];
	  $superAdmin = $_POST['superAdmin'];
	  $user_id = $_POST['user_id'];
	 #echo('hi'.'.,.'.$stuff_id.'.,.'. $owner_finder.'.,.'. $picture.'.,.'. $phone.'.,.'. $email.'.,.'.  $itemname.'.,.'. $brand.'.,.'. $color.'.,.'. $building.'.,.'. $room.'.,.'. $date.'.,.'. $description.'.,.'. $status);
	  #update_records($dbc,$stuff_id, $owner_finder, $picture, $phone, $email,  $itemname, $brand, $color, $building, $room, $date, $description, $status);
		$updatequery = 'UPDATE users SET first_name = "'.$first_name.'",last_name = "'.$last_name.'",email = "'.$email.'",superAdmin = '.$superAdmin.' WHERE user_id = '. $user_id;
		echo($updatequery);
		$updateResults = mysqli_query($dbc,$updatequery);
		//echo($updatequery);
		
		#updateLoad($stuff_id);
		$page = 'adminUpdateInfo.php';
		# Begin URL with protocol, domain, and current directory.
		$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;
	
		# Remove trailing slashes then append page name to URL.
		$url = rtrim( $url, '/\\' ) ;
		$url .= '/' . $page . '?id=' . $user_id;

		# Execute redirect then quit. 
		header( "Location: $url" ) ; 

		exit() ;

 }
	
# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
