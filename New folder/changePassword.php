
<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - landing.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

# This page changes a password.

session_start(); 
session_destroy(); 
session_start(); 
$_SESSION['last_page'] = "landing";

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

# Open functions file. 
require ('includes/limbo_functions.php');

# style sheet.
echo '<link rel="stylesheet" href="Limbo.css">';
 
?>
<!-- -------------------------------------------- -->
<!-- Display button section -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo"></div>

<form action="landing.php"><input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
<form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" 
	value="Contact Super Admin" style="font-size:13px;"/></form>
	<form action="login.php" ><input type="submit" value="Back to Login" class="sideButton" id="button3"style="font-size:13px;"/></form>

	
<div id = "centerContent">
<!-- -------------------------------------------- -->
 
 <br><br>
 <h1>Change Password</h1>
<h2>Please enter your email and hit the 'Submit' button to move onto resetting your password.</h2> 
<form method="post" >
	<p>Email: <input type = "text" id = "email" name="email" style =" width: 200px; "  />
	<input type="submit" value="Submit Email" name = "enterAdmin" class="centerButton"/>
	
<?php
#<!-- -------------------------------------------- -->
# If enter Admin button pressed...
if(isset($_POST['enterAdmin']))
{
	# If method is post...
	if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST')
	{	
		# Sets up an array for any errors in the information added.
		$errors = array();
	
		$email = $_POST['email'];
	
		$_SESSION['email']= $email;	

		#Calls function from limbo_functions.php to validate name or adds name to error array.
		if (!valid_email($email))
		{
			$errors[] = 'email';	
		}
	
		#Displays error message or posts to the database.
		if ( !empty($errors))
		{
			echo '<p style="color:red;font-size:16px;">Error! Invalid Email!!!</p>';
		}
		else
		{
			$query = 'Select email FROM users WHERE email= "' . $_POST['email'] . '"';
			$emailResults = mysqli_query($dbc,$query);
			$emailrow = mysqli_fetch_array($emailResults, MYSQLI_ASSOC);

			if(!$emailrow)
			{
				echo("Sorry, that email doesn't match any users! Please enter another email.");
			}
			else
			{
				echo('here');
				$page = 'updatePassword.php';
			
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
	}
 }

?>
	
</div>