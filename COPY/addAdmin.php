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
$page_title = 'Delete Admin' ;
include ( 'includes/header.html' ) ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;


# Display body section.
?>
<form method = "post"  >
<h1>Admin Info:</h1>
    <p>First Name: 		<input type="text" id= "first_name" name="first_name"  style ="width = 200px;">
	<p>Last Name:      	<input type = "text" id = "last_name" name="last_name"style =" width: 200px; "  />	
    <p>Email: 		<input type = "text" id = "email" name="email"style =" width: 200px; "  />
	<p>Password: 		<input type="password" id= "pass" name="pass"  style ="width = 200px;">
	<p>Security Question: <select name = "securityq" id = "securityq" >Choose a security question.</option>
							<option value =  1 >What is your mother's maiden name?</option>
							<option value =  2   >What was the name of your first pet?</option>
							<option value =  3   >What is the name of your favorite book?</option>
							<option value =  4   >What was the name of the highschool you graduated from?</option>
							<option value =  5   >Who was your favorite childhood friend?</option>
						</select>
	<p>Answer to security question:<input type="password" id= "securitya" name="securitya"  style ="width = 200px;">
						
<p>Status: <select name = "superAdmin" id = "superAdmin" >superAdmin?</option>
			<option value =  "True" >True</option>
			<option value =  "False"   > False </option>
		</select>
	
		<input type="submit" value="Add Admin" name = "add"/>
		</form>
<h4>Use the buttons below to start over, contact an Administrator if you have found a match,
		or back up one page.</h4>		
		
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>

<?php
# Create navigation links.
if(isset($_POST['add'])){
	  $first_name = $_POST['first_name'];
	  $last_name = $_POST['last_name'];
	  $email = $_POST['email'];
	  $superAdmin = $_POST['superAdmin'];
	  $pass = $_POST['pass'];
	  $securityq = $_POST['securityq'];
	 $securitya = $_POST['securitya'];
	 #echo('hi'.'.,.'.$stuff_id.'.,.'. $owner_finder.'.,.'. $picture.'.,.'. $phone.'.,.'. $email.'.,.'.  $itemname.'.,.'. $brand.'.,.'. $color.'.,.'. $building.'.,.'. $room.'.,.'. $date.'.,.'. $description.'.,.'. $status);
	  #update_records($dbc,$stuff_id, $owner_finder, $picture, $phone, $email,  $itemname, $brand, $color, $building, $room, $date, $description, $status);
		$updatequery = 'INSERT INTO users (first_name,last_name,email,pass,reg_date,superAdmin,securityQ, securityA) VALUES ("'. $first_name.'","'. $last_name .'","'. $email.'","'. $pass.'", Now(),'. $superAdmin. ','. $securityq . ',"'.$securitya . '")';
		echo($updatequery);
		$updateResults = mysqli_query($dbc,$updatequery);
		//echo($updatequery);
		
		#updateLoad($stuff_id);
		$page = 'addAdminConfirmation.php';
		# Begin URL with protocol, domain, and current directory.
		$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;
	
		# Remove trailing slashes then append page name to URL.
		$url = rtrim( $url, '/\\' ) ;
		$url .= '/' . $page ;

		# Execute redirect then quit. 
		header( "Location: $url" ) ; 

		exit() ;

 }
echo '<p><a href="login.php" >Logout</a></p>';


# Display footer section.
include ( 'includes/footer.html' ) ;
?>