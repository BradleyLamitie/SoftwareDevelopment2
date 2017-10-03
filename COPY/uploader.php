<?php

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - uploader.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

session_start();
$status = $_SESSION['status'];
$_SESSION['picture']= 'picture';

// Where the file is going to be placed 
$target_path = "uploads/"; 

/* Add the original filename to our target path. Result is "uploads/filename.extension" */ 
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
$_FILES['uploadedfile']['tmp_name']; 

// A directory called "uploads", is where we are going to be saving files. 

// Call the move_uploaded_file function and let PHP do its magic. 

// The path of the temporary file 
 $target_path = "uploads/"; 

// The path where it is to be moved to
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
$picture = $target_path; 
echo $picture;

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
{ 
	// If upload is successful you will see "The file filename has been uploaded.
	
	echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
	?><form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form><?php
} 
else
{ 
	 //If the upload is not successful, you will see There was an error uploading the file, please try again!
	echo "There was an error uploading the file, please try again!"; 
	?><form><input type="button" value="Back" onClick="history.go(-1);return true;"/></form><?php
} 

?>

