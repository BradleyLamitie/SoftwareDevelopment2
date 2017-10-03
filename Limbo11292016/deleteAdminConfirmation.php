<?php
echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
     <form action="contactSuperAdmin.php"><input class="sideButton" id="button4" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>

	<div id = "centerContent"> 
	<h2>You have successfully deleted an admin!</h2>
	<h3>You can select the button below to return to the admin home page</h3>
<form action="superAdminHome.php" ><input type="submit" value="Back to Admin Home" class="centerButton" style="font-size:13px"/></form>
<?php
# insert_record($dbc, $idnum, $itemname);


  ?>


</div>