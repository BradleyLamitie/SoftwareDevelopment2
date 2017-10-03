<?php # DISPLAY COMPLETE LOGIN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - login.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.
$page_title = 'Login' ;
include ( 'includes/header.html' ) ;

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
}
?>

<!-- Display body section. -->
<h1>Login</h1>
<form action="login_action.php" method="post">
<p>Email Address: <input type="text" name="email"> </p>
<p>Password: <input type="password" name="pass"></p>
<p><input type="submit" value="Login" ></p>
</form>
<form action="contactSuperAdmin.php"><input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"><input type="submit" value="Limbo Home" /></form>
<form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
