<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminPurgeConfirmation.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

session_start() ; 

# Set page title.
$page_title = 'Admin Purge Comfirmation' ;

require ( 'includes/limboconnect_db.php' ) ;

echo '<link rel="stylesheet" href="Limbo.css">';

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'includes/login_tools.php' ) ; load() ; }

?>
<!-- -------------------------------------------- -->
<!-- Display button section -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo"></div>

<form action="landing.php"> <input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
<form action="lost.php"> <input type="submit" value="Lost Something" class="sideButton" id="button2"/></form>
<form action="found.php"> <input type="submit" value="Found Something" class="sideButton" id="button3"/></form>
<form action="contactSuperAdmin.php"><input class="sideButton" id="button4" type="submit" 
	value="Contact Super Admin" style="font-size:13px;"/></form>
<form><input type="button" value="Back" onClick="history.go(-4);return true;" class="sideButton" id="button5"/></form>

<div id = "centerContent"> 
<!-- -------------------------------------------- -->
<?php

# Create a query to get the number, first name, and last name sorted by number in descending order
 $var_bool = true;
 $var_bool1 = true;

if(!empty($_GET['id']))
{
	$var_value = $_GET['id'];
}
else
{
	$var_bool = false;
	if(!empty($_GET['beforeDate']))
	{
		$var_value1 = $_GET['beforeDate'];
	}
	else
	{
		$var_bool1 = false;
	}
}

if($var_bool)
{
	$query = 'DELETE FROM stuff  WHERE stuff_id = ' . $var_value ;
}
else if($var_bool1)
{
	$query = 'DELETE FROM stuff  WHERE (lf_date <= "' . $var_value1 . ' "' . ' )AND( status = "claimed")';
}

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

if( $results )
{
	?>
	<h1> You have deleted the items successfully!</h1>
	<h3>Please press the back button below to return to the admin home page.</h3>

	<?php
}
else 
{
	# If we get here, something has gone wrong
	echo '<p> There is nothing there to delete. </p>';
	echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}
?>

<form action="login.php"><input type="submit" value="Logout"  class="centerButton" /></form>

</div>

<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
