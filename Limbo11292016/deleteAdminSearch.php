<?php # DISPLAY COMPLETE LOGGED IN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminSearch.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Access session.
session_start() ; 

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Admin Home' ;echo '<link rel="stylesheet" href="adminSearchStyle.css">';
  require ( 'includes/limboconnect_db.php' ) ;


// function show_records($dbc) {
	## Create a query to get the number, first name, and last name sorted by number in descending order
 
 
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
	<h3>From here you can select an admin to see more information and delete the admin.</h3>
	<h3>If you do not see the admin's email you are looking for, you can use the back button to run a new search.</h3>

	<?php
  $var_value = $_GET['AdminSearch'];


$query = 'SELECT * FROM users  WHERE email LIKE "%' . $var_value . '%" ';


# echo($query);
# Execute the query
$results = mysqli_query( $dbc , $query ) ;

if( $results )
{
 echo '<H1>Admins</H1>' ;
  echo '<TABLE border = "1", style = "font-family: courier;">';
  echo '<TR>';
  echo '<TH>FirstName</TH>';
  //echo '<TH>Status</TH>';
  echo '<TH>LastName</TH>';
  echo '<TH>Email</TH>';
  echo '</TR>';

while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . $row['first_name'] . '</TD>' ;
	echo '<TD>' . $row['last_name'] . '</TD>' ;
	$var_URL = "adminInfo.php?=" . $row['user_id'];
	//echo ($var_URL);
    echo '<TD>
			<form method = "get" action="adminInfo.php">
				<input type="hidden" name="id" value=' . $row['user_id'] . '>
				<input type="submit" class="linkButton"  value = ' . $row['email'] . ' >  
			</form>
		</TD>' ;
    echo '</TR>' ;
  }
  # End the table
  echo '</TABLE>';

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
?>
 <form action="login.php"><input class="centerButton" name="logout"  type="submit" value="Logout" style="font-size:13px;"/></form>

<?php
if(isset($_POST['logout'])){
	session_destroy();
}
?>
</div>