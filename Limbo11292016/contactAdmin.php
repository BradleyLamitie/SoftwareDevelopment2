<?php 

# Who:   Bradley Lamitie and Kathy Coomes
# What:  Limbo Lost & Found database - found.php
# When:  Fall 2016 
# Where: Marist College
# How:   Created using information and coding taught in CMPT 221 by Professor DeCusatis

# DISPLAY COMPLETE LOGIN PAGE.

# Set page title and display header section.
$page_title = 'Contact Admin' ;

echo '<link rel="stylesheet" href="Limbo.css">';

# Open database connection.
require ( 'includes/limboconnect_db.php' ) ;
  
?>
<div id="leftrectangle"></div>
<div id = "rightrectangle"><img src = "includes/logo.png" id="logo" style="position: absolute; top:300px; height: 125px; right:27px;">
</div>
<div id = "centerContent">
<p><H1>Contact an Administrator</H1></p>

<p>Administrator email address:<p>
<input type = "text" value = "ContactLimbo2@gmail.com" readonly/>
</div>

<form action="landing.php"><input type="submit" class="sideButton" id="button1" value="Limbo Home" /></form>
<form action="lost.php"><input type="submit" class="sideButton" id="button2" value="Lost Something" /></form>
<form action="found.php"><input type="submit" class="sideButton" id="button3" value="Found Something" /></form>
<form ><input type="button" value="Back" class="sideButton" id="button4" onClick= "history.go(-1);return true;"/></form>

