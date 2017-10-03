<?php 

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - landing.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

# This page uses check_value.php to get the current date, subtract the drop down 
# value chosen by the user, and display in a table any items in the database that match.

session_start();
$_SESSION['last_page'] = "landing";

# DISPLAY LANDING PAGE.

# Set page title.
$page_title = 'Landing Page';

# Open database connection.
require ('includes/limboconnect_db.php');

# Open functions file.
require ('includes/limbo_functions.php');

# style sheet
echo '<link rel="stylesheet" href="Limbo.css">';

?>
<!-- -------------------------------------------- -->
<!-- Display button section -->
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">

</div>
<form action="lost.php"><input class="sideButton" id="button1" type="submit" value="Lost Something?" /></form>
<form action="found.php"><input class="sideButton" id="button2" type="submit" value="Found Something?"
style= "text-align:left;" /></form>
<form action="contactAdmin.php"><input class="sideButton" id="button3" type="submit" value="Contact Admin" /></form>
<form action="login.php"><input class="sideBUtton" id="button4" type="submit" value="Admin Login" /></form>
<div id = "centerContent">
<!-- -------------------------------------------- -->
<!-- Display body section.  -->

<!-- Display page heading.  -->
<p ><h1 id="indent">Welcome to Limbo! Marist College's Lost & Found</h1></p>

<h3><p> Use only the buttons within Limbo!  Otherwise, you may get kicked out of the program.</p></h3>
<h3><p> ***Note:  Results, confirmations, or error messages appear at the top of each page.***</p></h3>

<!-- Button instructions -->
<h4>You can use the 4 buttons on the left to report a lost or found item, contact an Administrator, or login
	if you are an Administrator.  <p>You can also check for a possible match using the drop down box below.</p></h4> 



<p><h4>From the dropdown box, choose the number of days to see reported and 
	click Submit.</p> 
<p><h4> If any information is revealed that could be a match, click one of the Item Names to see more 
	information about it.</h4></p>
<!-- -------------------------------------------- -->

<?php
if(isset($_POST['submitbutton']))
{
	if(isset($_POST['days']))
	{
		$value = $_POST['days'];
	}
	else
	{
		$value = 1;
	}
	
#get current date in a certain format
$current_date = date('Y-m-d');
	
if ($value == 1) 
{	
	# subtracting 1 day from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
}
else if ($value == 3)
{
	# subtracting 3 days from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-3, date("Y")));
}
else if ($value == 7)
{
	# subtracting 7 days from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
}
else if ($value == 14)
{
	# subtracting 14 days from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-14, date("Y")));
}
else if ($value == 30)
{
	# subtracting approximately 30 days from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));
}
else if ($value == 90)
{
	# subtracting approximately 90 days from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y")));
}
else if ($value == 180)
{
	# subtracting approximately 180 days from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m")-6, date("d"), date("Y")));
}
else if ($value >= 365)
{
	# subtracting 1 year from the current date
	$less_date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d"), date("Y")-1));
}	
else
{
	echo "System error.";
}
	
$query =  "SELECT stuff_id, lf_date, status, name FROM stuff WHERE lf_date >= '$less_date'";
$results = mysqli_query($dbc, $query);
	
# Wait until we know the query succeeded before starting the table.
if ($results)
{
	
?> 

<!-- -------------------------------------------- -->	
<!-- Display dropdown box of number of days to be shown -->
	<form  method ="POST" >
	<label id = "label" for ="days">Reported in the last</label>
		<select name = "days" id="soflow">
			<option value = 1 
				<?php if ($value == 1){echo('selected = "selected"');} ?>
					> 1 day </option>
			<option value = 3 
				<?php if ($value == 3){echo('selected = "selected"');} ?>
					> 3 days </option>
			<option value = 7 
				<?php if ($value == 7){echo('selected = "selected"');} ?>
					> 7 days </option>
			<option value = 14 
				<?php if ($value == 14){echo('selected = "selected"');} ?>
					> 14 days </option>
			<option value = 30 
				<?php if ($value == 30){echo('selected = "selected"');} ?>
					> 30 days </option>
			<option value = 90 
				<?php if ($value == 90){echo('selected = "selected"');} ?>
					> 90 days </option>
			<option value = 180 
				<?php if ($value == 180){echo('selected = "selected"');} ?>
					> 180 days </option>
			<option value = 365 
				<?php if ($value == 365){echo('selected = "selected"');} ?>
					> 365 days </option>
		</select>
		<input class = "centerButton" name="submitbutton" type = "submit" value= "Submit"/>
	</form>							
<!-- -------------------------------------------- -->

<?php
	echo '<TABLE border = "1", id="table">';
	echo '<TR>';
	echo '<TH>Date Reported</TH>';
	echo '<TH>Status</TH>';
	echo '<TH>Item Name</TH>';
	echo '</TR>';

	# For each row result, generate a table row.
	while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
	{
		echo '<TR>';
		echo '<TD>' . $row['lf_date'] . '</TD>';
		echo '<TD>' . $row['status'] . '</TD>';
				
		echo '<TD><form method = "get" action = "ql.php"> <input type = "hidden" 
			name = "id" value = ' . $row['stuff_id'] . '></div><input type = "submit" 
			class = "linkButton" value = ' . $row ['name'] . ' >  <div id = "centerContent">
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
	
}else
{
if(isset($_POST['days']))
{
$value = $_POST['days'];
}
else
{
	$value = 1;
}

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
	<form  action = "" method ="POST" >
	<label for ="days">Reported in the last</label>
		<select name = "days" id="soflow"  >
			<option value = 1 > 1 day </option>
			<option value = 3 > 3 days </option>
			<option value = 7 > 7 days </option>
			<option value = 14 > 14 days </option>
			<option value = 30 > 30 days </option>
			<option value = 90 > 90 days </option>
			<option value = 180 > 180 days </option>
			<option value = 365 > 365 days </option>			
		</select>
		<input class = "centerButton" name="submitbutton" type = "submit" value= "Submit"/>
	</form>							
<!-- -------------------------------------------- -->

<?php

	echo '<TABLE border = "1", id="table">';
	echo '<TR>';
	echo '<TH>Date Reported</TH>';
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
			value = ' . $row['stuff_id'] . '></div><input type = "submit" 
			class = "linkButton" value = ' . $row ['name'] . ' >
			<div id = "centerContent">
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
}
#Close the connection.
mysqli_close($dbc);
?>

</div>