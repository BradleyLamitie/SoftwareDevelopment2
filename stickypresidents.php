<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Validate from input.)
  5) Update MySQL with form input.
  
By Ron Coleman (some changes made by Bradley Lamitie and Kathy Coomes)
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

# Validate form submitted
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') 
{
	  $errors = array();
      $number = $_POST['number'] ;
      $fname = $_POST['fname'] ;
	  $lname = $_POST ['lname'] ;
	
  # Calls function from helpers.php to validate number or adds number to error array
  if (!valid_number($number))
	  $errors[] = 'number';
	
  # Calls function from helpers.php to validate fname or adds first name to error array
  if (!valid_name($fname))
	  $errors[] = 'first name';

  # Calls function from helpers.php to validate lname or adds last name to error array
  if (!valid_name($lname))
	  $errors[] = 'last name';

  # Displays error message or posts to the database
  if( !empty($errors))
  {
	  echo 'Error! Please enter your ';
  	  foreach($errors as $msg){ echo " - $msg "; }
  }
  else
  { 
	  $result = insert_record($dbc, $number, $fname, $lname) ;
  	  echo "Success! Your information has been posted!";
  }

}

# Show the records
show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="stickypresidents.php" method="POST">
<table>
<tr>
<td>Number:</td><td><input type="text" name="number" value = "<?php if (isset($number)) echo $number; ?>"></td>
</tr>
<tr>
<td>First Name:</td><td><input type="text" name="fname" value = "<?php if (isset($fname)) echo $fname; ?>"></td>
</tr>
<tr>
<td>Last Name:</td><td><input type="text" name="lname" value = "<?php if (isset($lname)) echo $lname; ?>"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>