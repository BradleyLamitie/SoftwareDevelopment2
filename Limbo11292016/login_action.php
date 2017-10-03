<?php # PROCESS LOGIN ATTEMPT.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - login_action.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Open database connection.
  require ( 'includes/limboconnect_db.php' ) ;

  # Get connection, load, and validate functions.
  require ( 'includes/login_tools.php' ) ;

  # Check login.
  list ( $check, $data ) = validate ( $dbc, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;

  # On success set session data and display logged in page.
  if ( $check )  
  {
    # Access session.
    session_start();
    $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
    $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
    $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
	if($data['superAdmin']){
		load('superAdminHome.php');
	}else{
    load ( 'adminhome.php' ) ;
	}
  }
  # Or on failure set errors.
  else { $errors = $data; } 

  # Close database connection.
  mysqli_close( $dbc ) ; 
}

# Continue to display login page on failure.
include ( 'login.php' ) ;

?>