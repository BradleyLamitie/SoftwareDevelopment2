
<?php session_start();
  require ( 'includes/limboconnect_db.php' ) ;

	?>
	<h2>Please enter your email and hit the 'Submit' button to move onto resetting your password.</h2> 
	
	<form method="post" action = "updatePassword.php">
	<p>Email: 		<input type = "text" id = "email" name="email" style =" width: 200px; "  />
	<input type="submit" value="enterAdmin" name = "enterAdmin"/>
	</form>
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>
