<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - limbo_functions.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

# Contains most of the functions used in this program.

#session_start();

# Open database connection.
require ('includes/limboconnect_db.php');

$debug = true;
#-------------------------------------------------------------------------
# Checks that any number input is numerical, truncates any decimals, and is > 0.
function valid_number($number)
{
	$number = trim($number);
	$number = intval($number);
	if(empty($number) OR ($number <= 0) OR !is_numeric($number))
		return false;
	else	
		return true;
}
#-------------------------------------------------------------------------
# Checks that required text entries are not empty
function valid_word($word) 
{
	$word = trim($word);
	if(empty($word)) 
		return false;
	else
		return true;
}	
#-------------------------------------------------------------------------
# Checks that required date entries are not empty, and are in the correct format
function is_valid_Date($lf_date, $format='Y-m-d')
{
	return $lf_date == date($format, strtotime($lf_date));	
}
#-------------------------------------------------------------------------
# Checks that required location has been chosen.
function valid_location($location_id)
{
	if($location_id == 0)
		return false;
	else
		return true;
}
#-------------------------------------------------------------------------
# Checks that required email is in the correct format
function valid_email($email)
{
	$email = trim($email);
	if((empty($email)) OR (!filter_var($email, FILTER_VALIDATE_EMAIL)))
		return false;
	else 
		return true;
}
#-------------------------------------------------------------------------
#Checks that required phone entried are not empty, and are in the correct format
function is_valid_phone($phone)
{
	if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",$phone))
	{
		return true;
	}
	else
	{
		return false;
	}
}
#-------------------------------------------------------------------------
# Shows the records on lost or found page
function show_record($dbc) 
{
	## Create a query to get the name, brand, color, location_id and date from the table
	$query = 'SELECT name, brand, color, location_id, lf_date FROM stuff';

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;

	# Show results
	if($results)
	{			
		?>	

		<!-- Display page heading. -->
		<h1><p>Found Page</h1></p>

		<!-- Create buttons and their actions -->
		<h4>Use the buttons to the left.</h4>

		<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
		<form action="/lost.php"> 			<input type="submit" value="Lost Something" /></form>
		<form action="contactAdmin.php"> 	<input type="submit" value="Contact an Admin" /></form>
		<form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form>
		<form action="found.php"  method="post">

			<p><div>
				<label for="status">Status :</label>
				<input type = "text" id="status" name = "status"
				value = "found" />
			</div></p>	
	
			<h4>Please enter the following required information about the found item: <h4>  
	
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
			<p style ="margin-left:  40 px"> i.e. Timex, HP, Reebok, FiveStar</p>
	
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
		</form>

		<p><h4> Choose the place nearest to where you found the item, and then click Submit</h4></p>	
		<!-- Display dropdown box of Marist locations to choose from -->
		<form action = "check_location.php"	 method = "POST">
			<select name = "locations" >
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
			<input name = "submitbutton" type = "submit" value = "Submit-func"/>
		</form>  

<?php
	
	# End the table
	#echo '</TABLE>';
	
		#Free up the results in memory_get_peak_usage
		mysqli_free_result($results);
	}
	else
	{
		# If we get here, something has gone wrong
		echo '<p>' . mysqli_error($dbc ) . '</p>' ;	
	}
}
# ------------------------------------------------------------------------
# Shows the linked records on the landing page

function show_link_records($dbc, $id) 
{
	# Create a query to get the date lost or found, status, name from the stuff table
	$query = "SELECT name, color, brand, location_id, room, lf_date, status, description FROM stuff 
		WHERE ((status != '$status') && ((name == '$name') or (brand == '$brand') or 
		(color == '$color') or (location_id == '$location_id')))";
	
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;

	# Show results
	if( $results )
	{  
		# But...wait until we know the query succeeded before starting the table.
			
			echo '<H2> Possible Matches </H2>';
			echo '<TABLE border = "1", style = "font-family; courier;">';
			echo '<TR>';
			echo '<TH>Item Name</TH>';
			echo '<TH>Color</TH>';
			echo '<TH>Brand</TH>';
			echo '<TH>Location</TH>';
			echo '<TH>Room</TH>';
			echo '<TH>Date Lost</TH>';
			echo '<TH>Status</TH>';
			echo '<TH>Description</TH>';
			echo '</TR>';
		
		# For each row result, generate a table row
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		{
			echo '<TR>' ;
			# echo '<TD>' . $row['name'] . '</TD>' ;
			$alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			echo '<TD ALIGN=right>' . $alink . '</TD>';
	
			echo '<TD>' . $row['color'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
			
			echo '<TD>' . $row['brand'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
	
			echo '<TD>' . $row['location_id'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
			
			echo '<TD>' . $row['room'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
	
			echo '<TD>' . $row['lf_date'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
			
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
	
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';			
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
}
# ------------------------------------------------------------------------
#Shows the records in stuff
function show_records($dbc, $id) 
{
	## Create a query to get the date, status, and name from stuff table
	$query = 'SELECT lf_date, status, name FROM stuff WHERE id = ' . $id  ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;

	# Show results
	if( $results )
	{
		# But...wait until we know the query succeeded before
		# starting the table.
		
		echo '<TABLE border = "1", style = "font-family: courier;">';
		echo '<TR>';
		echo '<TH>Date</TH>';
		echo '<TH>Status</TH>';
		echo '<TH>Item Name</TH>';
		echo '</TR>';

		# For each row result, generate a table row
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		{
			echo '<TR>' ;
			echo '<TD>' . $row['lf_date'] . '</TD>' ;	
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['name'] . '</TD>' ;
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
}
# ------------------------------------------------------------------------
# Inserts a record into the stuff table
function insert_record($dbc, $name, $color, $brand, $description, $location_id, $room,
	$lf_date, $create_date, $update_date, $owner_finder, $phone, $email, $status, $picture) 
{
	$query = 'INSERT INTO stuff(name, color, brand, description, location_id, room, lf_date, 
		create_date, update_date, owner_finder, phone, email, status, picture) 
		VALUES ("' . $name . '" , "' . $color . '" , "' . $brand . '" , "' . $description . '" ,
		"' . $location_id . '", "' . $room . '" , "' . $lf_date . '", "' . $create_date . '" ,
		"' . $update_date . '", "' . $owner_finder . '" , "' . $phone . '", "' . $email . '" ,
		"' . $status . '" , "' . $picture . '" )' ;
	
	$results = mysqli_query($dbc,$query) ;
	check_results($results) ;

	return $results ;
}
# ------------------------------------------------------------------------
# Shows the query as a debugging aid
function show_query($query) 
{
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}
# ------------------------------------------------------------------------
# Checks the query results as a debugging aid
function check_results($results) 
{
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}
# ------------------------------------------------------------------------
# This function follows lost.php or found.php.  It searches for possible matches for the information
# the user has entered on one of those pages.
function possible_matches($dbc, $status, $name, $brand, $color, $lf_date, $location_id)
{	
	# DISPLAY POSSIBLES PAGE.

	# Set page title.
	$page_title = 'Possibles';

	# style sheet
	echo '<link rel="stylesheet" href="Limbo.css">';

	if ($status == "found")
	{
		$this_status = "lost";
	}
	else if ($status == "lost")
	{
		$this_status = "found";
	}
	
	$query = "SELECT stuff.stuff_id, stuff.status, stuff.name, stuff.brand, stuff.color, stuff.lf_date, 
				stuff.location_id, locations.loc_id, locations.loc_name FROM stuff, locations
		WHERE (stuff.location_id = locations.loc_id AND stuff.status = '$this_status' AND name = '$name') OR
			  (stuff.location_id = locations.loc_id AND stuff.status = '$this_status' AND brand = '$brand') OR
			  (stuff.location_id = locations.loc_id AND stuff.status = '$this_status' AND stuff.description LIKE '%$name%') OR 
			  (stuff.location_id = locations.loc_id AND stuff.status = '$this_status' AND stuff.description LIKE '%$brand%')
		ORDER BY lf_date DESC";
		
	$results = mysqli_query($dbc, $query);
	
	# Show results
	if( $results )
	{
		# Wait until we know the query succeeded before starting the table.
		echo '<h1>Possible Matches</h1>';
		echo '<h4>If you see something that may be a match, click on it\'s hyperlink.<h4>';
		echo '<TABLE border = "1", style = "font-family: courier;">';
		echo '<TR>';
		echo '<TH>Status</TH>';
		echo '<TH>Brand</TH>';
		echo '<TH>Color</TH>';
		if ($status == "found")
		{
			echo '<TH>Lost Date</TH>';
		}
		else if ($status == "lost")
		{
			echo '<TH>Found Date</TH>';
		}
		echo '<TH>Location Name</TH>';
		echo '<TH>Item Name</TH>';
		echo '</TR>';

		# For each row result, generate a table row
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		{
			echo '<TR>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;	
			echo '<TD>' . $row['brand'] . '</TD>' ;
			echo '<TD>' . $row['color'] . '</TD>' ;	
			echo '<TD>' . $row['lf_date'] . '</TD>' ;
			echo '<TD>' . $row['loc_name'] . '</TD>' ;
						
			echo '<TD><form action = "ql.php" method = "get" ><input type = "hidden" 
					name = "id" value = ' . $row['stuff_id'] . '><input type = "submit"
					class = "linkButton" value = ' . $row ['name'] . ' > </form></TD>'; 
			echo '<TR>' ;		
		}
		# End the table
		echo '</TABLE>';

		# Free up the results in memory
		mysqli_free_result( $results ) ;
		
		?>	
		<h4>Click the Back button to go back 1 page.</h4>
		<?php
		
		$last_page = $_SESSION['last_page'];
		if ($last_page == "lost")
		{
			?>
			<form action = "lost.php" > <input type="submit" value="Back"/> </form>
			<?php
		}
		else if ($last_page == "found")
		{
			?>
			<form action = "found.php"> <input type="submit" value="Back"/> </form>
			<?php
		}
		else if ($last_page =="landing")
		{
			?>
			<form action = "landing.php"> <input type="submit" value="Back"/> </form>
			<?php
		}
		?>
	
		<!-- <form action = "found.php"> <input type="submit" value="Back"/> </form> -->

		<h4> If you have not found a match and wish to continue reporting your item, click Continue for the next step.</h4>

		<form action = "add_more.php"> <input type="submit" value="Continue"/> </form> 	
<?php
	}
	else
	{
		# If we get here, something has gone wrong
		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
}
?>
<!-- -------------------------------------------- -->
<?php
# This function follows add_more.php.  It will give a confirmation when a record is added to the database.
function addRecordConfirmation($msg, $pic)
{
	#Display Add Record Confirmation Page
	
	# Set page title.
	$page_title = 'Add Record Confirmation';
	
	echo '<h1>Add Record Confirmation</h1>';
	
	if($msg == "yespic")
		echo '<p><h3>The picture and information on your item has been uploaded.   
			Please click one of the buttons on the left.	<h3></p>';
	else
		echo '<p><h3>Your item was added without a picture.  Please click one of the buttons on the left.<h3></p>'; 
}
# ----------------------------------------------------------------------------------------------------------------
# Logs a user out
function logout() 
{
	echo('HEY I WORK!');
	unset($_SESSION['user_id']);
	unset($_SESSION['first_name']);
	unset($_SESSION['last_name']);
	unset($_SESSION['email']);

}
# ------------------------------------------------------------------------

?>
<!-- -------------------------------------------- -->





	
	





