<?php # LOGIN HELPER FUNCTIONS.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - login_tools.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Function to load specified or default URL.
function update_records($dbc,$stuff_id, $owner_finder, $picture, $phone, $email,  $itemname, $brand, $color, $building, $room, $date, $description, $status) {
  $updatequery = 'UPDATE stuff SET owner_finder ='. $owner_finder . ' , phone= '. $phone . ', email='. $email . ' , picture = '. $picture . ', name = '. $itemname . ', brand = '. $brand . ', color = '. $owner_finder . ', loc_name = '. $building . ', room = '. $room . ', lf_date = '. $date . ', description = '. $description . ', status = '. $status . ') WHERE stuff_id = '. $stuff_id ;

  $updateResults = mysqli_query($dbc,$updatequery);
	return($updatequery);
  return( $updateResults) ;
  updateLoad($stuff_id);
}

function updateLoad(  $stuff_id )
{
  $page = 'adminql.php';
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page  . '?id=' . $stuff_id;

  # Execute redirect then quit. 
  header( "Location: $url" ) ; 
  exit() ;
}



function deleteAdmin($user_id){
	  $var_value = $_GET['AdminSearch'];
echo($var_value);

$query = 'DELETE FROM users  WHERE id = '. $user_id;
echo($query);

# echo($query);
# Execute the query
mysqli_query( $dbc , $query ) ;

}