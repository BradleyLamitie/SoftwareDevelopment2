
<?php # DISPLAY COMPLETE LOGIN PAGE.
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - contactSuperadmin.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis
# Set page title and display header section.
$page_title = 'Contact Admin' ;

include ( 'includes/header.html' ) ;
# Open database connection.
  require ( 'includes/limboconnect_db.php' ) ;
  
?>

<p>Contact Admin</p>
<p>Admin email address:<p>
<input type = "text" value = "contactsuperlimbo@gmail.com" size = "40"readonly/>
<form action="landing.php"><input type="submit" value="Limbo Home" /></form>
<form action="lost.php"><input type="submit" value="Lost Something" /></form>
<form action="found.php"><input type="submit" value="Found Something" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
