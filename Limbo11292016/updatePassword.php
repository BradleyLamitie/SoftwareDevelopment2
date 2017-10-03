 
<?php 
session_start();
  require ( 'includes/limboconnect_db.php' ) ;
  echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
	<form><input type="button" value="Back" onClick="history.go(-1);return true;" class="sideButton" id="button3" /></form>
<div id = "centerContent"> 
<?php
  if(isset($_SESSION[ 'user_id' ])){
	$var_value = $_SESSION[ 'user_id' ];
	$f_name=$_SESSION[ 'fname' ];
	$l_name= $_SESSION[ 'lname' ];
	$query = 'SELECT * FROM users  WHERE user_id= ' . $var_value . ' ';
	//echo($query);


  }else{
	$var_value = $_SESSION[ 'email' ];
	$query = 'SELECT * FROM users  WHERE email= "' . $var_value . '" ';
	//echo($query);
	Session_destroy();
	session_start();
	$_SESSION['email'] = $var_value;
  }

# Execute the query
$result = mysqli_query( $dbc , $query ) ;

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  //echo($row['securityQ']);
if($row){
  if($row['securityQ'] == 1){ $question =("What is your mother's maiden name?");
	}else if($row['securityQ'] == 2){ $question =("What was the name of your first pet?");
	} else if($row['securityQ'] == 3){ $question =('What is the name of your favorite book?');
	}  else if($row['securityQ'] == 4){ $question =('What was the name of the highschool you graduated from?');
	} else if($row['securityQ'] == 5){ $question =('Who was your favorite childhood friend?');}
	
	//echo($question);
	?>
	<h3>Please answer your security question and enter your new password. When you are finished please
	click the 'Change Password' button</h3> 
	<form method="post" action = "updatePassword.php">
	<p>Security Question: <input type="text" name = "securityq" id = "securityq" value = <?php echo('"'.$question.'"') ?> style ="width: 400px;" >
						
	<p>Answer to security question: <input type="password" id= "securitya" name="securitya"  style ="width : 200px;">
	<p>New Password: <input type="password" id= "newPass" name="newPass"  style ="width : 200px;">
	<p>Confirm New Password: <input type="password" id= "newPass1" name="newPass1"  style ="width : 200px;">
		
	<input type="submit" value="Change Password" name = "changePassword" class="centerButton"/>
	</form>
<?php
if(isset($_POST['changePassword'])){
	if($_POST['securitya']===$row['securityA']){
		if($_POST['newPass']===$_POST['newPass1']){
			$updatequery = 'UPDATE users SET pass = "'.$_POST['newPass'].'" WHERE user_id = '. $row['user_id'];
			//echo($updatequery);
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
		}else{
			echo("ERROR!!! The passwords do not match!");
		}
	}else{
		echo("ERROR!!! Incorrect answer to security question!");
	}

	}
}else{
	echo('Sorry! There are no administrators that match that e-mail. Press the back button to try another email.');
}
?>
</div>