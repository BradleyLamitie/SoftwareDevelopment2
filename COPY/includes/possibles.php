<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - possibles.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

# This page follows ql.php if there were no matches displayed.  The user will enter more
# information about the item being reported.

#$status = $_SESSION['status'];

# DISPLAY POSSIBLES PAGE.

# Set page title and display header section.
$page_title = 'Possibles';

# Open database connection.
require ('includes/limboconnect_db.php');

# Call functions from another php file
#require ('includes/limbo_functions.php');

# style sheet
echo '<link rel="stylesheet" href="adminSearchStyle.css">';

#Search the stuff database to see if there are any matches to user entered lost or found information
function possible_matches($dbc, $status, $name, $brand, $color, $lf_date, $location_id)

{
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
			echo '<TD>' . $row['name'] . '</TD>' ;
			
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
		<form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form>


		<h4> If you have not found a match, click Continue for the next step in reporting your item.</h4>

	<form action = "add_more.php"> <input type="submit" 
		value="Continue"/> </form> 
		
<?php

	}
	else
	{
		# If we get here, something has gone wrong
		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
}

?>