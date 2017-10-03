<?php 

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - landing.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

session_start();

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

# Call functions from another php file
require( 'includes/limbo_functions.php' );

# style sheet.
echo '<link rel="stylesheet" href="Limbo.css">';

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

?>
<!-- -------------------------------------------- -->
<!-- Display button section -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo"></div>
<?php
# If Super Admin...
if(isset($_SESSION['superAdmin']))
{
	?>
	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
	<form action="superAdminHome.php"> 	<input type="submit" value="Back to SuperAdmin Home" 
		class="sideButton" id="button2" style="font-size:11px; text-align:left;"/></form>
	<form action="login.php" method="post"><input type="submit" value="Logout" class="sideButton" id="button3" /></form>

	<?php
}
# If admin...
else
{
	?>
	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
	<form action ="adminHome.php"><input type="submit" value="Back to Admin Home"  class="sideButton" id="button3" /></form>
	<form action="login.php" method="post"><input type="submit" value="Logout" class="sideButton" id="button4" /></form>

	<?php
}	
?>

<div id = "centerContent"> 
<!-- -------------------------------------------- -->

<?php
# If an admin comes here from their homepage their user_id is set
if(isset($_SESSION[ 'user_id' ]))
{
	$var_value = $_SESSION[ 'user_id' ];
		$query = 'SELECT * FROM users  WHERE user_id= ' . $var_value . ' ';
	
}
#If they come from the login page it uses the email search result.
else
{
	$var_value = $_SESSION[ 'email' ];
	$query = 'SELECT * FROM users  WHERE email= "' . $var_value . '" ';
	Session_destroy();
	session_start();
	$_SESSION['email'] = $var_value;
}

# Execute the query
$result = mysqli_query( $dbc , $query ) ;

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if($row)
{
  if($row['securityQ'] == 1)
  { 
		$question =("What is your mother's maiden name?");
  }
  else if($row['securityQ'] == 2)
  {
	  $question =("What was the name of your first pet?");
  }
  else if($row['securityQ'] == 3)
  {
	  $question =('What is the name of your favorite book?');
  }
  else if($row['securityQ'] == 4)
  { 
      $question =('What was the name of the highschool you graduated from?');
  } 
  else if($row['securityQ'] == 5)
  {
	  $question =('Who was your favorite childhood friend?');
  }
	
	?>
	<br> <br>
	<h1>Change Password<h1>
	<h3>Please answer your security question and enter your new password. 
	<p>When you are finished, please click the 'Change Password' button</p></h3> 
	
	<form method="post" action = "updatePassword.php">
		<p>Security Question: <input type="text" name = "securityq" id = "securityq" value = 
			<?php echo('"'.$question.'"') ?> style ="width: 400px;" readonly>
		<p>Answer to security question: <input type="password" id= "securitya" name="securitya"  style ="width : 200px;">
		<p>New Password: <input type="password" id= "newPass" name="newPass"  style ="width : 200px;">
		<p>Confirm New Password: <input type="password" id= "newPass1" name="newPass1"  style ="width : 200px;">
		
		<input type="submit" value="Change Password" name = "changePassword" class="centerButton"/>
	</form>
<?php
# Changes the password
	if(isset($_POST['changePassword']))
	{	
		# Checks to make sure the security answer is correct
		if(sha1($_POST['securitya'])===($row['securityA']))
		{
			# Checks to make sure the passwords match
			if($_POST['newPass']===$_POST['newPass1'])
			{
				$updatequery = 'UPDATE users SET pass = "'.sha1($_POST['newPass']).'" WHERE user_id = '. $row['user_id'];
				#echo($updatequery);
				$updateResults = mysqli_query($dbc,$updatequery);
			
				#updateLoad($stuff_id);
				$page = 'updatePasswordConfirmation.php';
				# Begin URL with protocol, domain, and current directory.
				$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;
	
				# Remove trailing slashes then append page name to URL.
				$url = rtrim( $url, '/\\' ) ;
				$url .= '/' . $page ;

				# Execute redirect then quit. 
				header( "Location: $url" ) ; 

				exit() ;
			}
			else
			{
				echo("ERROR!!! The passwords do not match!");
			}
		}
		else
		{
			echo("ERROR!!! Incorrect answer to security question!");
		}
	}
}
else
{
	echo('Sorry! There are no administrators that match that e-mail. Press the back button to try another email.');
}
?>

</div>