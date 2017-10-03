<?php
 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - add_more.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.

# This page is used after quicklinks if there were no matches.
# User will enter the information that was not included on the quicklinks page.
# All information will be Inserted into the database from here, once it has been validated.
# Other functions used by this page, are in limbo_functions.php.

session_start();
$status = $_SESSION['status'];
$name = $_SESSION['name'];
$color = $_SESSION['color'];
$brand = $_SESSION['brand'];
$location_id = $_SESSION['location_id'];
$lf_date = $_SESSION['lf_date'];
$create_date = $_SESSION['lf_date'];
$update_date = $_SESSION['update_date'];
$picture = $_SESSION['picture'];


# DISPLAY ADD_MORE PAGE.
$page_title = 'add_more' ;

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;

# Call functions from another php file
require ('includes/limbo_functions.php');

#Call functions from another php file
require ('includes/possibles.php');

# Validate information submitted in the form by the user.

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST')
{	
	$errors = array();
	$room = $_POST['room'];
	$owner_finder = $_POST['owner_finder'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$description = $_POST['description'];
	$picture = $_POST['picture'];
		
	#Calls function from limbo_functions.php to validate room or adds room to error array
	if (!valid_word($room))
		$errors[] = 'room';
	
	#Calls function from limbo_functions.php to validate owner_finder or adds your name to error array
	if (!valid_word($owner_finder))
		$errors[] = 'your name';
	
	#Calls function from limbo_functions.php to validate phone or adds phone to error array
	if (!is_valid_phone($phone))
		$errors[] = 'phone';
	
	# Calls function from limbo_functions.php to validate email or adds email to error array.
	if (!valid_email($email))
		$errors[] = 'email';
	
	#Calls function from limbo_functions.php to validate description or adds description to error array.
	if (!valid_word($description))
		$errors[] = 'description';
	
	#Displays error message or posts to the database
	if ( !empty($errors))
	{
		echo '<p style="color:red;font-size:16px;">Error!  Please enter the following: ';
		foreach($errors as $msg) { echo " - $msg ";}
	}
	else		
	{
		insert_record($dbc, $name, $color, $brand, $description, $location_id, $room, $lf_date, 
			$create_date, $update_date, $owner_finder, $phone, $email, $status, $picture); 
	}
}

?>

<!-- Display body section. -->
<h2>Add More Information</h2>

<h4>If you have a picture of your item, you  may add it here.  
	Click the upload file button and once you receive a message.  Click the back button.<h4>

<!-- enctype="multipart/form-data" - Necessary for our to-be-created PHP file to function properly.  -->
<form enctype="multipart/form-data" action="uploader.php" method="POST">

<!--  Sets the maximum allowable file size, in bytes, that can be uploaded.
<input type="hidden" name="MAX_FILE_SIZE" value="100000" /> 

<!-- uploadedfile is how we will access the file in our PHP script -->
Choose a file to upload: <input name="uploadedfile" type="file" /> 

<input type="submit" value="Upload File" /> 

</form> 
		
<h4> Here is where you will need to enter more required information about the item you are reporting.</h4>
<h4> Once you click submit your information will be added to the database.  To make any changes you
	will need to contact an Administrator.</h4>

<form action="add_more.php"  method="post">

<!-- Get input from the user and it will be sticky. -->
<p><div>
	<label for="room">Room :</label>
	<input type="text" id="room" name = "room" 
	value = "<?php if (isset($room)) echo $room; ?>" />
</div></p>
	<p style="margin-left: 40px"> i.e. near 256B, in 256B, unknown</p>

<p><div>
	<label for="owner_finder">First and Last Name :</label>
	<input type="text" id="owner_finder" name = "owner_finder" 
	value = "<?php if (isset($owner_finder)) echo $owner_finder; ?>" />
</div></p>
	<p style="margin-left: 40px"> i.e. John Doe</p>

<p><div>
	<label for="phone">Phone :</label>
	<input type="text" id="phone" name = "phone" 
	value = "<?php if (isset($phone)) echo $phone; ?>" />
</div></p>
	<p style="margin-left: 40px"> i.e. 555-555-5555</p>

<p><div>
	<label for="email">Email :</label>
	<input type="text" id="email" name = "email" 
	value = "<?php if (isset($email)) echo $email; ?>" />
</div></p>
	<p style="margin-left: 40px"> i.e. mary.marist@marist.edu</p>
	
<p><div>
	<label for="description">Description :</label>
	<input type="text" id="description" name = "description" 
	value = "<?php if (isset($description)) echo $description; ?>" />
</div></p>
	<p style= "margin-left: 40px"> i.e. what ever you want up to 100 characters</p>	
	
<input name = "submitbutton" type = "submit" value = "Submit-add" />
</form>		
		
<h4>Use the buttons below to start over, contact an Administrator,
		or back up one page.</h4>		

<form action="landing.php">	    <input type="submit" value="Limbo Home" /></form>

<form action="contactAdmin.php"><input type="submit" value="Contact an Admin" /></form>

<form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form>



