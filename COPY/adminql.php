
<?php 
# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - adminql.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis# DISPLAY COMPLETE LOGIN PAGE.
session_start();
# Set page title and display header section.
$page_title = 'quicklink' ;

include ( 'includes/header.html' ) ;
# Open database connection.
  require ( 'includes/limboconnect_db.php' ) ;
  #require('adminqlUpdate.php');
  //require ('includes/adminqlHelper');
  //Using GET 
  $var_value = $_GET['id'];
  // echo $var_value; SELECT picture,stuff_id, name, brand, color, loc_name, room,  lf_date, description, owner_finder, phone, email FROM stuff s INNER JOIN locations l ON s.stuff_id = l.loc_id WHERE stuff_id = 3;

  $query = 'SELECT location_id,picture,stuff_id, owner_finder, email, phone, name, loc_name, brand, color, room, loc_name,  lf_date, description, status FROM stuff s INNER JOIN locations l ON s.location_id = l.loc_id WHERE stuff_id = ' .  $var_value;
  
	    $result = mysqli_query($dbc, $query);
  
 # mysqli_real_escape_string(connection,escapestring);
  // echo  $row['picture'];
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
  if($row){
	 $var_value3 =  ($row["status"]);
	 $var_value4 =  ($row["location_id"]);
	 
?>	

<!-- Display body section. -->
<h1>Updatable Report</h1>
<h2>Edit any of the following data and click the 'update record' button to update the current record.</h2>
<form method = "post" enctype = "multipart/form-data" >
    
	
	
	<form action = "" method = "POST" enctype = "multipart/form-data">
	<p>Picture: 		<img name = "picturepic"  alt = "Picture of item" height="80" width="80" src = "<?php echo('includes/'.$row['picture']);?>>
       <?php $picture = $_POST['picture'];?>
	   <input type = "hidden" name = "picture" id = "picture" value = "<?php echo($row['picture']); ?>"  />
			<input type = "file" name = "picture"  />
				
			<?php $picture = time().$_FILES['picture']['name']; ?>
			<ul>
				<li>Sent file: <?php echo time().$_FILES['picture']['name'];  ?>
				<li>File size: <?php echo $_FILES['picture']['size'];  ?>
				<li>File type: <?php echo $_FILES['picture']['type'] ?>
			</ul>
			<?php echo $picture;?>
			
	
	
	
	
	
	
	<p>Reporter name: 	<input type = "text" name = "owner_finder" id = "owner_finder" value = "<?php echo($row['owner_finder']); ?>"  />
    <p>Reporter's phone number:<input type = "text" name = "phone" id = "phone" value = "<?php echo($row['phone']); ?>"   />
	<p>Reporter's email:<input type = "text" name = "email" id = "email"  value = "<?php echo($row['email']); ?>"   />
    <p>Item ID: 		<input type = "text" name = "idnum" id = "idnum" value = "<?php echo($row['stuff_id']); ?>" readonly  />
	<p>Item name:		<input type = "text" name = "itemname" id = "itemname" value = "<?php echo($row['name']); ?>"  />
	<p>Brand: 			<input type = "text" name = "brand" id = "brand" value = "<?php echo($row['brand']); ?>"  />
	<p>Color:           <input type = "text" name = "color" id = "color" value = "<?php echo($row['color']); ?>"  />
	<p>Marist Building: <select name = "locations" >locations </option>
			<option value =  0 <?php if($var_value4 == 0 ){ echo('selected = "selected"');}?>> Choose One </option>
			<option value =  1 <?php if($var_value4 == 1 ){ echo('selected = "selected"');}?>> Byrne House </option>
			<option value =  2 <?php if($var_value4 == 2 ){ echo('selected = "selected"');}?>> Cannavino Library </option>
			<option value =  3 <?php if($var_value4 == 3 ){ echo('selected = "selected"');}?>> Champagnat Hall </option>
			<option value =  4 <?php if($var_value4 == 4 ){ echo('selected = "selected"');}?>> Chapel </option>
			<option value =  5 <?php if($var_value4 == 5 ){ echo('selected = "selected"');}?>> Cornell Boathouse </option>
			<option value =  6 <?php if($var_value4 == 6 ){ echo('selected = "selected"');}?>> Donnelly Hall </option>
			<option value =  7 <?php if($var_value4 == 7 ){ echo('selected = "selected"');}?>> Dyson Center </option>
			<option value =  8 <?php if($var_value4 == 8 ){ echo('selected = "selected"');}?>> Fontaine Hall </option>
			<option value =  9 <?php if($var_value4 == 9 ){ echo('selected = "selected"');}?>> Foy Townhouses </option>
			<option value = 10 <?php if($var_value4 == 10){ echo('selected = "selected"');}?>> Fulton Townhouses (Lower) </option>
			<option value = 11 <?php if($var_value4 == 11){ echo('selected = "selected"');}?>> Fulton Townhouses (Upper) </option>
			<option value = 12 <?php if($var_value4 == 12){ echo('selected = "selected"');}?>> Greystone Hall </option>
			<option value = 13 <?php if($var_value4 == 13){ echo('selected = "selected"');}?>> Fern Tor </option>
			<option value = 14 <?php if($var_value4 == 14){ echo('selected = "selected"');}?>> Hancock Center </option>
			<option value = 15 <?php if($var_value4 == 15){ echo('selected = "selected"');}?>> Kieran Gatehouse </option>
			<option value = 16 <?php if($var_value4 == 16){ echo('selected = "selected"');}?>> Kirk House</option>
			<option value = 17 <?php if($var_value4 == 17){ echo('selected = "selected"');}?>> Leo Hall </option>
			<option value = 18 <?php if($var_value4 == 18){ echo('selected = "selected"');}?>> Longview Park </option>
			<option value = 19 <?php if($var_value4 == 19){ echo('selected = "selected"');}?>> Lowell Thomas Center </option>
			<option value = 20 <?php if($var_value4 == 20){ echo('selected = "selected"');}?>> Lower Townhouses </option>
			<option value = 21 <?php if($var_value4 == 21){ echo('selected = "selected"');}?>> Marian Hall </option>
			<option value = 22 <?php if($var_value4 == 22){ echo('selected = "selected"');}?>> Marist Boathouse </option>
			<option value = 23 <?php if($var_value4 == 23){ echo('selected = "selected"');}?>> McCann Center </option>
			<option value = 24 <?php if($var_value4 == 24){ echo('selected = "selected"');}?>> Midrise Hall </option>
			<option value = 25 <?php if($var_value4 == 25){ echo('selected = "selected"');}?>> Murray Student Center </option>
			<option value = 26 <?php if($var_value4 == 26){ echo('selected = "selected"');}?>> North Campus Housing </option>
			<option value = 27 <?php if($var_value4 == 27){ echo('selected = "selected"');}?>> St. Ann's Hermitage </option>
			<option value = 28 <?php if($var_value4 == 28){ echo('selected = "selected"');}?>> St. Peter's </option>
			<option value = 29 <?php if($var_value4 == 29){ echo('selected = "selected"');}?>> Science/Allied Health Building </option>
			<option value = 30 <?php if($var_value4 == 30){ echo('selected = "selected"');}?>> Sheahan Hall </option>
			<option value = 31 <?php if($var_value4 == 31){ echo('selected = "selected"');}?>> Steel Plant Studio/Gallery </option>
			<option value = 32 <?php if($var_value4 == 32){ echo('selected = "selected"');}?>> West Cedar Townhouses (Lower)</option>
			<option value = 33 <?php if($var_value4 == 33){ echo('selected = "selected"');}?>> West Cedar Townhouses (Upper)</option>
		</select>
	<p>Room: 			<input type = "text" name = "room" id = "room" value = "<?php echo($row['room']); ?>"  />
	<p>Date Reported: 	<input type = "date" name = "date" id = "date" value = "<?php echo($row['lf_date']); ?>"  />
	<p>Description: 	<input type = "text" name = "description" id = "description" value = "<?php echo($row['description']); ?>" style = "width: 300px;"  />
	<p>Status: <select name = "status" id = 'status' >locations </option>
			<option value =  "lost" <?php if($var_value3 === "lost"){ echo('selected = "selected"');}?>> lost </option>
			<option value =  "found"  <?php if($var_value3 === "found"){ echo('selected = "selected"');}?> > found </option>
			<option value =  "claimed"  <?php if($var_value3 === "claimed"){ echo('selected = "selected"');}?>> claimed </option>
		</select>		
	<p><input type="submit" value="Update record" name = "update" ></form>

	
	
<?php 
  }else{
	  echo 'No reports found!';
  }
  
  if(isset($_POST['update'])){
	  $stuff_id = $_POST['idnum'];
	  $owner_finder = $_POST['owner_finder'];
	  $phone = $_POST['phone'];
	  $email = $_POST['email'];
	  $itemname = $_POST['itemname'];
	  $brand = $_POST['brand'];
	  $color = $_POST['color'];
	  $building = $_POST['locations'];
	  $room = $_POST['room'];
	  $date = $_POST['date'];
	  $description = $_POST['description'];
	  $status = $_POST['status'];
	 
	 #echo('hi'.'.,.'.$stuff_id.'.,.'. $owner_finder.'.,.'. $picture.'.,.'. $phone.'.,.'. $email.'.,.'.  $itemname.'.,.'. $brand.'.,.'. $color.'.,.'. $building.'.,.'. $room.'.,.'. $date.'.,.'. $description.'.,.'. $status);
	  #update_records($dbc,$stuff_id, $owner_finder, $picture, $phone, $email,  $itemname, $brand, $color, $building, $room, $date, $description, $status);
		$updatequery = 'UPDATE stuff SET owner_finder ="'. $owner_finder . '" , phone= "'. $phone . '", email="'. $email . '" , picture = "'. $picture . '", name = "'. $itemname . '", brand = "'. $brand . '", color = "'. $owner_finder . '", location_id = '. $building . ', room = "'. $room . '", lf_date = "'. $date . '", description = "'. $description . '", status = "'. $status . '" WHERE stuff_id = '. $stuff_id ;

		$updateResults = mysqli_query($dbc,$updatequery);
		//echo($updatequery);
		
		#updateLoad($stuff_id);
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
	
   
?>
<form action="lost.php"> 			<input type="submit" value="Lost Something" /></form>
<form action="found.php"> 	        <input type="submit" value="Found Something" /></form>
<form action="contactSuperAdmin.php"> 	<input type="submit" value="Contact a Super Admin" /></form>
<form action="landing.php"> 		<input type="submit" value="Limbo Home" /></form>
<form ><input type="button" value="Back" onClick= "history.go(-1);return true;"/></form>
<?php
# insert_record($dbc, $idnum, $itemname);


  ?>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>

