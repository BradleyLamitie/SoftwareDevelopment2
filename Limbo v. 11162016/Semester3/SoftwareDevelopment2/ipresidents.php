<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Ron Coleman
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $number = $_POST['number'] ;

    $fname = $_POST['fname'] ;
	
	$lname = $_POST ['lname'] ;

    if(!empty($number) && !empty($fname) && !empty($lname)) {
      $result = insert_record($dbc, $number, $fname, $lname) ;      
    }
    else
      echo '<p style="color:red">Please input a president number, first name and last name!</p>' ;
}

echo
# Show the records
show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="ipresidents.php" method="POST">
<table>
<tr>
<td>Number:</td><td><input type="text" name="number"></td>
</tr>
<tr>
<td>First Name:</td><td><input type="text" name="fname"></td>
</tr>
<tr>
<td>Last Name:</td><td><input type="text" name="lname"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>