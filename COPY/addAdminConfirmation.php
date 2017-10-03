<?php
?>
<h1> Added the new admin successfully!</h1>
<h2>Go back to the Super Admin Home Page</h2>
<form action="superAdminHome.php"> 	<input type="submit" value="Super Admin Home" /></form>

<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>
<?php
# insert_record($dbc, $idnum, $itemname);


  ?>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
