<?php
 echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button2" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<form action = "superAdminHome.php"><input type="submit" value="Back"  class="sideButton" id="button3"/></form>

	<div id = "centerContent"> 
<h1> You have changed your password successfully!</h1>
<h3>Please press the back button below to return to the login page.</h3>
	<form action="login.php"><input type="submit" value="logout"  class="centerButton" /></form>

</div>

<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>