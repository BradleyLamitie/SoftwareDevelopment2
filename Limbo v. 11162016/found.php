<?php
 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - found.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

session_start();
$_SESSION['status'] = "found";

# DISPLAY FOUND PAGE.

# Set page title and display header section.
$page_title = 'Found Page';

# Open database connection.
require ('includes/limboconnect_db.php');

# Call functions from another php file
require ('includes/limbo_functions.php');

# Validate information submitted in the form by the user.

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST')
{	
	$errors = array();
	$status = $_POST['status'];
	$name = $_POST['name'];
	$brand = $_POST['brand'];
	$color = $_POST['color'];
	$lf_date = $_POST['lf_date'];
	$location_id = "$_POST[locations]";  #grabs the drop down box value
			
	#Calls function from limbo_functions.php to validate name or adds name to error array
	if (!valid_word($name))
		$errors[] = 'name';
	
	#Calls function from limbo_functions.php to validate brand or adds brand to error array
	if (!valid_word($brand))
		$errors[] = 'brand';
	
	#Calls function from limbo_functions.php to validate color or adds color to error array
	if (!valid_word($color))
		$errors[] = 'color';
	
	# Calls function from limbo_functions.php to validate number or adds number to error array.
	if (!valid_number($location_id))
		$errors[] = 'location_id';
	
	#Calls function from limbo_functions.php to validate date lost/found or adds date to error array.
	if (!is_Valid_Date($lf_date))
		$errors[] = 'date';
	
	#Displays error message or posts to the database
	if ( !empty($errors))
	{
		echo '<p style="color:red;font-size:16px;">Error!  Please enter the following: ';
		foreach($errors as $msg) { echo " - $msg ";}
	}
	else		
	{
		#Search the database to see if there are any matches to user entered information
		possible_matches($dbc, $status, $name, $brand, $color, $lf_date, $location_id);
		exit();
	}
}

?>

<!-- ------------------------------------------------------- -->
<!-- Display page heading. -->
	<p><h1>Found Page</h1></p>

	<!-- Create buttons and their actions -->
	<h4>Use the buttons below to start over, enter a lost item, contact an Administrator,
		login if you are an Administrator, or back up one page.</h4>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" /></form>
	<form action="lost.php"> 		<input type="submit" value="Lost Something" /></form>
	<form action="contactAdmin.php"> <input type="submit" value="Contact an Admin" /></form>
	<form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form>
		
	<form action="found.php"  method="post">
		
		<p><div>
			<label for="status">Status :</label>
			<input type = "text" id="status" name = "status" value = "found" />
		</div></p>	
			
		<h4>Please enter the following required information about the found item: <h4>  	

		<!-- Get input from the user and it will be sticky-->
		<p><div>
			<label for="name">Item Name :</label>
			<input type="text" id="name" name = "name" 
			value = "<?php if (isset($name)) echo $name; ?>" />
		</div></p>
		<p style ="margin-left:  40 px"> i.e. watch, computer, hat, notebook</p>
	
		<p><div>
			<label for="brand">Brand :</label>
			<input type="text" id="brand" name = "brand" 
			value = "<?php if (isset($brand)) echo $brand; ?>"/>
		</div></p>
		<p style ="margin-left:  40 px"> i.e. Timex, HP, Reebok, unknown</p>
	
		<p><div>
			<label for="color">Color :</label>
			<input type="text" id="color" name = "color" 
			value = "<?php if (isset($color)) echo $color; ?>"/>		 
		</div></p>
		<p style ="margin-left:  40 px"> i.e. silver, black, red, blue</p>
	
		<p><div>
			<label for="lf_date">Found Date :</label>
			<input type="text" id="lf_date" name = "lf_date" />
		</div></p>
		<p style ="margin-left:  40 px"> i.e YYYY-MM-DD</p>

		<p><h4> Choose the place nearest to where you found the item, and then click Submit</h4></p>
		
		<!-- Display dropdown box of Marist locations to choose from -->
		<select name = "locations" >locations </option>
			<option value =  0 > Choose One </option>
			<option value =  1 > Byrne House </option>
			<option value =  2 > Cannavino Library </option>
			<option value =  3 > Champagnat Hall </option>
			<option value =  4 > Chapel </option>
			<option value =  5 > Cornell Boathouse </option>
			<option value =  6 > Donnelly Hall </option>
			<option value =  7 > Dyson Center </option>
			<option value =  8 > Fontaine Hall </option>
			<option value =  9 > Foy Townhouses </option>
			<option value = 10 > Fulton Townhouses (Lower) </option>
			<option value = 11 > Fulton Townhouses (Upper) </option>
			<option value = 12 > Greystone Hall </option>
			<option value = 13 > Fern Tor </option>
			<option value = 14 > Hancock Center </option>
			<option value = 15 > Kieran Gatehouse </option>
			<option value = 16 > Kirk House</option>
			<option value = 17 > Leo Hall </option>
			<option value = 18 > Longview Park </option>
			<option value = 19 > Lowell Thomas Center </option>
			<option value = 20 > Lower Townhouses </option>
			<option value = 21 > Marian Hall </option>
			<option value = 22 > Marist Boathouse </option>
			<option value = 23 > McCann Center </option>
			<option value = 24 > Midrise Hall </option>
			<option value = 25 > Murray Student Center </option>
			<option value = 26 > North Campus Housing </option>
			<option value = 27 > St. Ann's Hermitage </option>
			<option value = 28 > St. Peter's </option>
			<option value = 29 > Science/Allied Health Building </option>
			<option value = 30 > Sheahan Hall </option>
			<option value = 31 > Steel Plant Studio/Gallery </option>
			<option value = 32 > West Cedar Townhouses (Lower)</option>
			<option value = 33 > West Cedar Townhouses (Upper)</option>
		</select>
			<input name = "submitbutton" type = "submit" value = "Submit-found" />
	</form>		

<!-- ------------------------------------------------------- -->

<?php

#Close the connections.
mysqli_close($dbc);

?>	









