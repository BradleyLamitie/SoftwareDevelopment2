<?php 

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - landing.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

session_start();

# DISPLAY LANDING PAGE.

# Set page title.
$page_title = 'Landing Page';

# Open database connection.
require ('includes/limboconnect_db.php');

# Open functions file.
require ('includes/limbo_functions.php');

# style sheet
echo '<link rel="stylesheet" href="adminSearchStyle.css">';

?>

<!-- -------------------------------------------- -->
<!-- Display body section.  -->

<!-- Display page heading.  -->
<p><h1>Welcome to Limbo - Marist College's Lost & Found</h1></p>

<!-- Create buttons and their actions -->
<h4>Use the buttons below to report a lost or found item, contact an Administrator,
	or login if you are an Administrator. </h4> 

<form action="lost.php"> 		<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	    <input type="submit" value="Found Something" /></form>
<form action="contactAdmin.php"><input type="submit" value="Contact an Admin" /></form>
<form action="login.php"> 		<input type="submit" value="Admin Login" /></form>

<p><h4>From the dropdown box, choose the number of days to see reported and 
	click Submit.</p> 
<p><h4> If any information is revealed, click one of the Item Names to see more 
	information about it.</h4></p>
<!-- -------------------------------------------- -->

<?php

#get current date in a certain format
$current_date = date('Y-m-d');

#subtracting 1 from the current date
$less_date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));

$query =  "SELECT stuff_id, lf_date, status, name FROM stuff WHERE lf_date >= '$less_date'";
$results = mysqli_query($dbc, $query);

# Wait until we know the query succeeded before starting the table.
if ($results)
{
	
?> 

<!-- -------------------------------------------- -->	
<!-- Display dropdown box of number of days to be shown -->
	<form  action = "check_value.php" method ="POST" >
	<label for ="dropdown">Reported in the last</label>
		<select name = "days" >
			<option value = 1 > 1 day </option>
			<option value = 3 > 3 days </option>
			<option value = 7 > 7 days </option>
			<option value = 14 > 14 days </option>
		</select>
		<input name="submitbutton" type = "submit" value= "Submit"/>
	</form>							
<!-- -------------------------------------------- -->

<?php

	echo '<TABLE border = "1", style = "font-family; courier;">';
	echo '<TR>';
	echo '<TH>Date</TH>';
	echo '<TH>Status</TH>';
	echo '<TH>Item Name</TH>';
	echo '</TR>';

	# For each row result, generate a table row.
	while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
	{
		echo '<TR>';
		echo '<TD>' . $row['lf_date'] . '</TD>';
		echo '<TD>' . $row['status'] . '</TD>';
				
		echo '<TD><form method = "get" action = "ql.php"> 
			<input type = "hidden" name = "id" 
			value = ' . $row['stuff_id'] . '><input type = "submit" 
			class = "linkButton" value = ' . $row ['name'] . ' > 
			</form></TD>';
			
		echo '</TR>';
			}
	# End the table
	echo '</TABLE>';

# Free up the results in memory
 mysqli_free_result( $results ) ;		
}
else
{
	# If we get to this point, there must be an error.
	echo '<p>' . mysqli_error($dbc) . '</p>';
}

#Close the connection.
mysqli_close($dbc);
?>

