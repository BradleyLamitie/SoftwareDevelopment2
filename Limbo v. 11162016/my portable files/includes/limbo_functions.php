<?php

#session_start();
#$status = $_SESSION['status'];
$last_page = $_SESSION['last_page'];



$debug = true;
#-------------------------------------------------------------------------
	
# Checks that any number input (except reward) is not empty, is numerical, truncates any decimals, and is > 0
function valid_number($location_id) 
{ 
  $number = trim($location_id); 
  $number = intval($location_id); 
  if(empty($location_id)) // || !is_numeric($number) || ($number <= 0))
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
#Checks that required date entries are not empty, and is in the correct format
function valid_date($lf_date)
{
	$lf_date = trim($lf_date);
	if (empty($lf_date))
		return false;
	else
		return true;	
}
#-------------------------------------------------------------------------
# Shows the records on lost or found page
function show_records($dbc) 
{
	## Create a query to get the name, brand, color, location_id and date from the table
$query = 'SELECT name, brand, color, location_id, lf_date FROM stuff';

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if($results)
{
	while ($row = mysqli_fetch_array ( $results, MYSQLI_ASSOC ) )
	{
		
?>

		<!-- Display page heading. -->
		<h1><p>Found Page</h1></p>

		<!-- Create buttons and their actions -->
		<h4>Use the buttons to the left.</h4>

		<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
		<form action="/lost.php"> 			<input type="submit" value="Lost Something" /></form>
		<form action="contactAdmin.php"> 	<input type="submit" value="Contact an Admin" /></form>

		<form action="found.php  method="post">

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
			<p style = "margin-left:  40 px"> i.e. watch, computer, hat, notebook</p>
	
			<p><div>
				<label for="brand">Brand :</label>
				<input type="text" id="brand" name = "brand" 
				value = "<?php if (isset($brand)) echo $brand; ?>"/>
			</div></p>
			<p style = "margin-left:  40 px"> i.e. Timex, HP, Reebok, FiveStar</p>
	
			<p><div>
				<label for="color">Color :</label>
				<input type="text" id="color" name = "color" 
				value = "<?php if (isset($color)) echo $color; ?>"/>		 
			</div></p>
			<p style = "margin-left:  40 px"> i.e. silver, black, red, blue</p>
	
			<p><div>
				<label for="lf_date">Found Date :</label>
				<input type="text" id="lf_date" name = "lf_date" />
			</div></p>
			<p style = "margin-left:  40 px"> i.e YYYY-MM-DD</p>
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
	}
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

function show_link_records($dbc) 
{
	# Create a query to get the date lost or found, status, name from the stuff table
	$query = 'SELECT lf_date, status, name FROM stuff ';

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;

	# Show results
	if( $results )
	{
  
		# But...wait until we know the query succeeded before
		# starting the table.

			
			#echo '<TABLE border = "1", style = "font-family; courier;">';
			echo '<TR>';
			echo '<TH>Date</TH>';
			echo '<TH>Status</TH>';
			echo '<TH>Item Name</TH>';
			echo '</TR>';
		
		# For each row result, generate a table row
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		{
			echo '<TR>' ;
			# echo '<TD>' . $row['lf_date'] . '</TD>' ;
			$alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			echo '<TD ALIGN=right>' . $alink . '</TD>';
	
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '</TR>' ;
			# $alink = '<A HREF=landing.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
			# echo '<TD ALIGN=right>' . $alink . '</TD>';
	
			echo '<TD>' . $row['name'] . '</TD>' ;
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
#Shows the record in stuff
function show_record($dbc, $id) 
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
function insert_record($dbc, $name, $color, $brand, $description, $location_id, $room, $lf_date, 
	$create_date, $update_date, $owner_finder, $phone, $email, $reward, $status) 
{
	$query = 'INSERT INTO presidents(name, color, brand, description, location_id, room, lf_date, 
		create_date, update_date, owner_finder, phone, email, reward, status) 
		VALUES (' . $name . ' , "' . $color . '" , "' . $brand . '" , "' . $description . '" ,
		"' . $location_id . '", "' . $room . '" , "' . $lf_date . '", "' . $create_date . '" ,
		"' . $update_date . '", "' . $owner_finder . '" , "' . $phone . '", "' . $email . '" ,
		"' . $reward . '" , "' . $status . '" )' ;
	show_query($query);

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

?>
