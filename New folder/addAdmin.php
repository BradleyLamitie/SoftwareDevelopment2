<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - addAdmin.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

session_start() ; 

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'includes/login_tools.php' ) ; load() ; }
 
# checks to see if an admin is a superAdmin 
# If they are a superAdmin allow the connection_aborted
# otherwise, redirect them to the login page.
if(!$_SESSION['superAdmin']){require ( 'includes/login_tools.php' ) ; load() ; }


# Set page title.
$page_title = 'Add Admin' ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

# Call functions from another php file
require( 'includes/limbo_functions.php' );

# style sheet.
echo '<link rel="stylesheet" href="Limbo.css">';

?>
<!-- -------------------------------------------- -->
<!-- Display button section. -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo"></div>

<form action="landing.php"><input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    
<div id = "centerContent">
<!-- -------------------------------------------- --> 
<?php
# Checks if POST == add and if yes, grabs the information entered by the Super Admin for the new Admin.
if(isset($_POST['add'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$superAdmin = $_POST['superAdmin'];
	$pass = sha1($_POST['pass']);
	$securityq = $_POST['securityq'];
	$securitya = sha1($_POST['securitya']);
	$searchEmail = 'SELECT email FROM users WHERE email = "' . $email.'"';
		
	# Checks to see if the email already exists in the database.
	echo($searchEmail);
	$emailResults = mysqli_query($dbc,$searchEmail);
	$emailrow = mysqli_fetch_array($emailResults, MYSQLI_ASSOC);

	if($emailrow)
	{
		echo('Sorry, that email is already in use! Please enter another email.');
	}
	else
	{
		#echo('hi'.'.,.'.$stuff_id.'.,.'. $owner_finder.'.,.'. $picture.'.,.'. $phone.'.,.'. $email.'.,.'.  $itemname.'.,.'. $brand.'.,.'. $color.'.,.'. $building.'.,.'. $room.'.,.'. $date.'.,.'. $description.'.,.'. $status);
		#update_records($dbc,$stuff_id, $owner_finder, $picture, $phone, $email,  $itemname, $brand, $color, $building, $room, $date, $description, $status);
		
		$updatequery = 'INSERT INTO users (first_name,last_name,email,pass,reg_date,superAdmin,securityQ, securityA) 
			VALUES ("'. $first_name.'","'. $last_name .'","'. $email.'","'. $pass.'", Now(),'. $superAdmin. ','. $securityq . ',"'.$securitya . '")';
		
		echo($updatequery);
		
		$updateResults = mysqli_query($dbc,$updatequery);
		
		#echo($updatequery);
		#updateLoad($stuff_id);
		
		# Variable to be used below while trimming.
		$page = 'addAdminConfirmation.php';
		
		# Begin URL with protocol, domain, and current directory.
		$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;
	
		# Remove trailing slashes then append page name to URL.
		$url = rtrim( $url, '/\\' ) ;
		$url .= '/' . $page ;

		# Execute redirect then quit. 
		header( "Location: $url" ) ; 

		exit ;
	}
}
?>
<!-- -------------------------------------------- -->
<!-- Creates form to be filled in to add an admin. -->
<form method = "post">
<h1>Admin Info:</h1>
    <p>First Name: <input type="text" id= "first_name" name="first_name"  style ="width = 200px;">
	<p>Last Name: <input type = "text" id = "last_name" name="last_name"style =" width: 200px; "  />	
    <p>Email: <input type = "text" id = "email" name="email"style =" width: 200px; "  />
	<p>Password: <input type="password" id= "pass" name="pass"  style ="width = 200px;">
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
	
	<input type="submit" value="Add Admin" name = "add" class="centerButton"/>
</form>
<!-- -------------------------------------------- -->

<?php
# Create navigation link.
?>
<form action="superAdminHome.php" ><input type="submit" value="Back to Admin Home" class="centerButton" 
	style="font-size:13px;"/></form>
</div>