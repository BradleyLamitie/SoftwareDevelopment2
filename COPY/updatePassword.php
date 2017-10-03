 
<?php session_start();
  require ( 'includes/limboconnect_db.php' ) ;
   $emailTemp = $_POST['email'];
  if(isset($emailTemp)){
	$var_value = $_SESSION[ 'user_id' ];
	$query = 'SELECT * FROM users  WHERE user_id= ' . $var_value . ' ';
	//echo($query);

  }else{
	$var_value = $_SESSION[ 'user_id' ];
	$query = 'SELECT * FROM users  WHERE email= "' . $var_value . '" ';
	//echo($query);

  }


# echo($query);
# Execute the query
$result = mysqli_query( $dbc , $query ) ;

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  //echo($row['securityQ']);
  if($row['securityQ'] == 1){ $question =("What is your mother's maiden name?");
	}else if($row['securityQ'] == 2){ $question =("What was the name of your first pet?");
	} else if($row['securityQ'] == 3){ $question =('What is the name of your favorite book?');
	}  else if($row['securityQ'] == 4){ $question =('What was the name of the highschool you graduated from?');
	} else if($row['securityQ'] == 5){ $question =('Who was your favorite childhood friend?');}
	
	//echo($question);
	?>
	<h2>Please answer your security question and enter your new password. When you are finished please
	click the 'Change Password' button</h2> 
	<form method="post" action = "updatePassword.php">
	<p>Security Question: <input type="text" name = "securityq" id = "securityq" value = <?php echo('"'.$question.'"') ?> style ="width: 200px;" >
						
	<p>Answer to security question: <input type="password" id= "securitya" name="securitya"  style ="width : 200px;">
	<p>New Password: <input type="password" id= "newPass" name="newPass"  style ="width : 200px;">
	<p>Confirm New Password: <input type="password" id= "newPass1" name="newPass1"  style ="width : 200px;">
		
	<input type="submit" value="Change Password" name = "changePassword"/>
	</form>
<?php
if(isset($_POST['changePassword'])){
	if($_POST['securitya']===$row['securityA']){
		if($_POST['newPass']===$_POST['newPass1']){
			$updatequery = 'UPDATE users SET pass = "'.$_POST['newPass'].'" WHERE user_id = '. $row['user_id'];
			//echo($updatequery);
			$updateResults = mysqli_query($dbc,$updatequery);
		}else{
			echo("ERROR!!! The passwords do not match!");
		}
	}else{
		echo("ERROR!!! Incorrect answer to security question!");
	}
}
?>
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>
