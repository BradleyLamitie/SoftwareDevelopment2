
<?php # DISPLAY COMPLETE LOGIN PAGE.

# Set page title and display header section.
$page_title = 'Contact Admin' ;

include ( 'includes/header.html' ) ;
# Open database connection.
  require ( 'includes/limboconnect_db.php' ) ;
  
?>

<p>Contact Admin</p>
<p>Admin email address:<p>
<input type = "text" value = "ContactLimbo2@gmail.com" readonly/>
<form action="landing.php"><input type="submit" value="Limbo Home" /></form>
<form action="lost.php"><input type="submit" value="Lost Something" /></form>
<form action="found.php"><input type="submit" value="Found Something" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
