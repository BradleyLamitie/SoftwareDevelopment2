<?php # DISPLAY COMPLETE LOGGED IN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminSearch.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Access session.
session_start() ; 

# Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Admin Home' ;
echo '<link rel="stylesheet" href="adminSearchStyle.css">';
  require ( 'includes/limboconnect_db.php' ) ;


 echo '<link rel="stylesheet" href="Limbo.css">';

   ?>
 <div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo">
</div>

	<form action="landing.php"> 	<input type="submit" value="Limbo Home" class="sideButton" id="button1" /></form>
    <form action="lost.php">         <input type="submit" value="Lost Something" class="sideButton" id="button2"/></form>
    <form action="found.php"> 	        <input type="submit" value="Found Something" class="sideButton" id="button3"/></form>
    <form action="contactSuperAdmin.php"><input class="sideButton" id="button4" type="submit" value="Contact Super Admin" style="font-size:13px;"/></form>
<form><input type="button" value="Back" onClick="history.go(-4);return true;" class="sideButton" id="button5"/></form>

	<div id = "centerContent"> 
	<?php
// function show_records($dbc) {
	## Create a query to get the number, first name, and last name sorted by number in descending order
 $var_bool = true;
 $var_bool1 = true;
 $var_bool2 = true;
 $var_bool3 = true;
 if(!empty($_GET['beforeDate'])){
  $var_value = $_GET['beforeDate'];
}else{
	$var_bool = false;
}
if(!empty($_GET['betweenDate1'])){
  $var_value1 = $_GET['betweenDate1'];
}else{
	$var_bool1 = false;
}
if(!empty($_GET['betweenDate2'])){
  $var_value2 = $_GET['betweenDate2'];
}else{
	$var_bool2 = false;
}
if(!empty($_GET['afterDate'])){
  $var_value3 = $_GET['afterDate'];
}else{
	$var_bool3 = false;
}

if($var_bool){
	$query = 'SELECT status,lf_date, stuff_id, name FROM stuff  WHERE lf_date < "' . $var_value . ' "';
}else if($var_bool1|| $var_bool2){
	$query = 'SELECT status,lf_date, stuff_id, name FROM stuff WHERE lf_date > "' . $var_value1 . ' " AND lf_date < "' . $var_value2 . ' " ';
}else if($var_bool3){
	$query = 'SELECT status,lf_date, stuff_id, name FROM stuff  WHERE lf_date > "' . $var_value3 . '"';
}

# echo($query);
# Execute the query
$results = mysqli_query( $dbc , $query ) ;

if( $results )
{
 echo '<H1>Items</H1>' ;
  echo '<TABLE border = "1", style = "font-family: courier;">';
  echo '<TR>';
  echo '<TH>Date</TH>';
  echo '<TH>Status</TH>';
  echo '<TH>Name</TH>';
  echo '</TR>';

while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {

    echo '<TR>' ;
    echo '<TD>' . $row['lf_date'] . '</TD>' ;
	echo '<TD>' . $row['status'] . '</TD>' ;
	$var_URL = "adminql.php?=" . $row['stuff_id'];
	//echo ($var_URL);
    echo '<TD>
			<form method = "get" action="adminql.php">
				<input type="hidden" name="id" value=' . $row['stuff_id'] . '>
				<input type="submit" class="linkButton"  value = ' . $row['name'] . ' >  
			</form>
		</TD>' ;
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
// }
# Display footer section.?>

