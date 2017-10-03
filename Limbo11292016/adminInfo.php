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

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;
 
echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
       <form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;" class="sideButton" id="button5"/></form>

	<div id = "centerContent"> 
	<?php
  //Using GET 
  $var_value = $_GET['id'];
  // echo $var_value; SELECT picture,stuff_id, name, brand, color, loc_name, room,  lf_date, 
  //		description, owner_finder, phone, email FROM stuff s INNER JOIN 
  //		locations l ON s.stuff_id = l.loc_id WHERE stuff_id = 3;

$query = 'SELECT * FROM users WHERE user_id = '. $var_value;
		
$result = mysqli_query($dbc, $query);
 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
#mysqli_real_escape_string(connection,escapestring);
// echo  $row['picture'];
 $super_admin = ($row['superAdmin']); 
 //echo($super_admin);

?>
<form method = "post" name = "updateAdmin">
<!-- Display body section. -->
<h1>Admin Info:</h1>
	<p>Admin ID: 			<input type = "text" id = "user_id" name = "user_id" value = "<?php 
		echo($row['user_id']); ?>"style =" width: 200px; " readonly />
    <p>First Name: 		<input type="text" id= "first_name" value = "<?php 
		echo($row['first_name']);?>" style ="width = 200px;" readonly>
	<p>Last Name:      	<input type = "text" id = "last_name" value = "<?php 
		echo($row['last_name']); ?>" style =" width: 200px; " readonly />	
    <p>Email: 		<input type = "text" id = "email" value = "<?php 
		echo($row['email']); ?>" style =" width: 200px; " readonly />
	<p>Registration Date:		<input type = "text" id = "reg_Date" value = "<?php 
		echo($row['reg_date']); ?>"style =" width: 200px; " readonly />
	<p>Status: <select name = "superAdmin" id = "superAdmin" readonly >superAdmin?</option>
					<option value =  "True"  <?php if($super_admin == 1){ echo('selected = "selected"');}?> >True</option>
					<option value =  "False" <?php if($super_admin == 0){ echo('selected = "selected"');}?>  > False </option>
				</select>	
<input type="submit" value="Delete Admin" name = "delete" class="centerButton"/></form>

<?php 
if(isset($_POST['delete'])){
	  $user_id = $_POST['user_id'];
	  $first_name = $_POST['first_name'];
	  $last_name = $_POST['last_name'];
	  $email = $_POST['email'];
	  $reg_date = $_POST['reg_date'];
	  $superAdmin = $_POST['superAdmin'];
	 
	 #echo('hi'.'.,.'.$stuff_id.'.,.'. $owner_finder.'.,.'. $picture.'.,.'. $phone.'.,.'. $email.'.,.'.  $itemname.'.,.'. $brand.'.,.'. $color.'.,.'. $building.'.,.'. $room.'.,.'. $date.'.,.'. $description.'.,.'. $status);
	  #update_records($dbc,$stuff_id, $owner_finder, $picture, $phone, $email,  $itemname, $brand, $color, $building, $room, $date, $description, $status);
		$updatequery = 'DELETE FROM users  WHERE user_id = '. $user_id;
		echo($updatequery);
		$updateResults = mysqli_query($dbc,$updatequery);
		//echo($updatequery);
		
		#updateLoad($stuff_id);
		$page = 'deleteAdminConfirmation.php';
		# Begin URL with protocol, domain, and current directory.
		$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;
	
		# Remove trailing slashes then append page name to URL.
		$url = rtrim( $url, '/\\' ) ;
		$url .= '/' . $page ;

		# Execute redirect then quit. 
		header( "Location: $url" ) ; 

		exit() ;

 }

?> <form action="login.php"><input class="centerButton" name="logout"  type="submit" value="Logout" style="font-size:13px;"/></form>

<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
</div>