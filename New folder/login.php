<?php # DISPLAY COMPLETE LOGIN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - login.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.
session_start();

$page_title = 'Login' ;

require( 'includes/limbo_functions.php' );

echo '<link rel="stylesheet" href="Limbo.css">';


#logs out a user when redirected to this page.
logout();

?>




<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo" style="position: absolute; top:300px; height: 125px; right:27px;">
</div>
<form action="landing.php"><input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
<form action="contactSuperAdmin.php"><input type="submit" value="Contact a Super Admin" class="sideButton" id="button2" style="text-align:left; font-size:12px"/></form>
<form><input type="button" value="Back" onClick="history.go(-1);return true;" class="sideButton" id="button3"/></form>

<div id = "centerContent">
<?php
# Display any error messages if present.
//echo($_SESSION['user_id']);

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
<p><input type="submit" class="centerButton" value="Login" ></p>
</form>

<form  method="POST" action ="changePassword.php">
        <button  type="submit" class="centerButton" style="font-size:10pt;" >Forgot Password?</button>
</form>
</div>