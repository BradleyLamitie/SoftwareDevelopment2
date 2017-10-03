
<?php session_start();
  require ( 'includes/limboconnect_db.php' ) ;
  require ('includes/limbo_functions.php');
  $_SESSION['last_page'] = "landing";

  	# style sheet
echo '<link rel="stylesheet" href="Limbo.css">';
 
 ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<div id = "centerContent"> 
<h2>Please enter your email and hit the 'Submit' button to move onto resetting your password.</h2> 
	
	<form method="post" >
	<p>Email: 		<input type = "text" id = "email" name="email" style =" width: 200px; "  />
	<input type="submit" value="Submit Email" name = "enterAdmin" class="centerButton"/>
	
<?php
  if(isset($_POST['enterAdmin'])){
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST')
{	
	$errors = array();
	$email = $_POST['email'];
	
	$_SESSION['email']= $email;
	

	#Calls function from limbo_functions.php to validate name or adds name to error array.
	if (!valid_email($email)){
		$errors[] = 'email';
	
	}
	
	#Displays error message or posts to the database
	if ( !empty($errors))
	{
		echo '<p style="color:red;font-size:16px;">Error! Invalid Email!!!</p>';
		
	}else{
		echo('here');
		$page = 'updatePassword.php';
			# Begin URL with protocol, domain, and current directory.
			$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;
	
			# Remove trailing slashes then append page name to URL.
			$url = rtrim( $url, '/\\' ) ;
			$url .= '/' . $page ;
			
			# Execute redirect then quit. 
			header( "Location: $url" ) ; 

			exit() ;
	}	
	
}
  }

	?>
	
</div>