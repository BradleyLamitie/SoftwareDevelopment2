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
$page_title = 'Admin Home' ;
include ( 'includes/header.html' ) ;
echo '<link rel="stylesheet" href="adminSearchStyle.css">';
  require ( 'includes/limboconnect_db.php' ) ;


// function show_records($dbc) {
	## Create a query to get the number, first name, and last name sorted by number in descending order
 
 
  $var_value = $_GET['AdminSearch'];
echo($var_value);

$query = 'SELECT * FROM users  WHERE email LIKE "%' . $var_value . '%" ';
echo($query);

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
// }
# Display footer section.?>
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>
<?php
include ( 'includes/footer.html' ) ;
?>
