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

echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="lost.php">         <input type="submit" value="Lost Something" class="sideButton" id="button2"/></form>
    <form action="found.php"> 	        <input type="submit" value="Found Something" class="sideButton" id="button3"/></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button4" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;" class="sideButton" id="button5"/></form>

	<div id = "centerContent"> 
<h3>From here you can search for an admin by their email address.</h3> 
<form action="deleteAdminSearch.php"> 			<input type="text" name= "AdminSearch" value="Admin email" /><input type="submit" value="Admin E-mail Search" class="centerButton" style="font-size:12px;"/></form>


 <form action="login.php"><input class="centerButton" name="logout"  type="submit" value="Logout" style="font-size:13px;"/></form>

<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
</div>