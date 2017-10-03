<?php
$debug = true;

# Shows the records 
function show_records($dbc) {
	## Create a query to get the number, first name, and last name sorted by number in descending order
$query = 'SELECT number,fname,lname FROM presidents ORDER BY number DESC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<H1>Dead Presidents</H1>' ;
  echo '<TABLE border = "1", style = "font-family: courier;">';
  echo '<TR>';
  echo '<TH>Number</TH>';
  echo '<TH>First Name</TH>';
  echo '<TH>Last Name</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . $row['number'] . '</TD>' ;
	echo '<TD>' . $row['fname'] . '</TD>' ;
    echo '<TD>' . $row['lname'] . '</TD>' ;
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

# Shows the records in prints
function show_link_records($dbc) {
	## Create a query to get the id, and last name sorted by id in descending order
$query = 'SELECT id, lname FROM presidents ORDER BY id DESC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<H1>Dead Presidents</H1>' ;
  echo '<TABLE border = "1", style = "font-family: courier;">';
  echo '<TR>';
  echo '<TH>Id</TH>';
  echo '<TH>Last Name</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
   # echo '<TD>' . $row['id'] . '</TD>' ;
	$alink = '<A HREF=linkypresidents.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
    echo '<TD ALIGN=right>' . $alink . '</TD>';
	echo '<TD>' . $row['lname'] . '</TD>' ;
    echo '</TR>' ;
	
	# $alink = '<A HREF=linkypresidents.php?id=' . $row['id'] . '>' . $row['id'] . '</A>';
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

#Shows the record in linkypresidents
function show_record($dbc, $id) {
	## Create a query to get the number, first name, and last name sorted by number in descending order
$query = 'SELECT number, lname, fname FROM presidents WHERE id = ' . $id  ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<H1>Dead Presidents</H1>' ;
  echo '<TABLE border = "1", style = "font-family: courier;">';
  echo '<TR>';
  echo '<TH>Number</TH>';
  echo '<TH>Last Name</TH>';
  echo '<TH>First Name</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . $row['number'] . '</TD>' ;	
	echo '<TD>' . $row['lname'] . '</TD>' ;
	echo '<TD>' . $row['fname'] . '</TD>' ;
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

# Inserts a record into the prints table
function insert_record($dbc, $number, $fname, $lname) {
  $query = 'INSERT INTO presidents(number, fname, lname) VALUES (' . $number . ' , "' . $fname . '" , "' . $lname . '" )' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

# Checks that number input is not empty, is numerical, truncates any decimals, and is > 0
function valid_number($number) 
{
  $number = trim($number); 
  $number = intval($number); 
  if(empty($number)) // || !is_numeric($number) || ($number <= 0))
	return false;
  else
    return true;
} 

# Checks that first and last names are not empty
function valid_email($name) 
{
	$name = trim($name);
	if(empty($name))
		echo 'please input an email';
	return false; 
	else
		return true;
}


?>