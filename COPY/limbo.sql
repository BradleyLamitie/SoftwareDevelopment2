# Create and populate the limbo database
# Authors: Bradley Lamitie and Kathy Coomes
# Version 3 for Assignment 4

# Creates limbo_db if it does not already exist
CREATE DATABASE IF NOT EXISTS limbo_db;

# States the limbo_db is to be used
Use limbo_db;

# Deletes the users table if it already exists
 DROP table IF EXISTS users;

# Creates the users table and its columns with their data types
CREATE TABLE IF NOT EXISTS users
(
	user_id      INT            AUTO_INCREMENT PRIMARY KEY,
	first_name   TEXT,
	last_name    TEXT,
	email        TEXT,
	pass         TEXT,
	reg_date     DATETIME,
	superAdmin   BOOLEAN,
	securityQ    INT,
	securityA    TEXT
 );

# Populates the data into each column of the table 
INSERT INTO users (first_name, last_name, email, pass, reg_date, superAdmin,securityQ,securityA)
	VALUES ( "John", "Doe", "admin", "gaze11e", '2016-09-21 04:15:59',FALSE,1,"Fawn"),
	( "Bradley", "Lamitie", "Bradley.Lamitie1@marist.edu", "password", Now(),TRUE,2,"Frogger"),
	( "Kathy", "Coomes", "Kathy.Coomes@marist.edu", "database",Now(),TRUE,3,"Alice in Wonderland");

# Deletes stuff table if it already exists
DROP TABLE IF EXISTS stuff;

# Creates the stuff table and its columns with their data types and options	
CREATE TABLE IF NOT EXISTS stuff
(
	stuff_id     INT    				AUTO_INCREMENT PRIMARY KEY,
	name	     TEXT                   NOT NULL,
	color	     TEXT					NOT NULL,
	brand	     TEXT					NOT NULL,
	description  TEXT					NOT NULL,
	location_id  INT      				NOT NULL,
	room         TEXT,
	lf_date		 DATE					NOT NULL,
	create_date  DATE 					NOT NULL,
	update_date  DATE 					NOT NULL,
	owner_finder TEXT,
	phone  		 TEXT,
	email  		 TEXT,
	reward	     DECIMAL(15,2),
	status       SET ('found', 'lost', 'claimed')  		NOT NULL, 
	picture		 TEXT
);

#debugging
INSERT INTO stuff
	(name, color, brand, description, location_id, room, lf_date, create_date, 
		update_date, owner_finder, phone, email, status, picture)
	VALUES ("watch", "silver", "Timex", "ladies' twist band with black numbers and red minutes", 6, 212, 20161111, 20161111,
			20161111, "Kathy Coomes", "555-555-5555", "kathy.coomes@marist.edu", "found", ""),
			("skateboard", "blue and white", "unknown", "has my name written on it in red magic marker", 2, 345, 20161104, 20161104,
			20161105, "John Jackson", "555-555-5555", "john.jackson1@marist.edu", "lost", ""),
			("laptop", "black", "hp", "with mouse receiver in usb and cd player", 7, 2003, 20161031, 20161031, 
			20161031, "John Doe", "444-444-4444", "registrar@marist.edu", "found", ""),
			("controller", "black", "xbox", "wobbly analog stick, green cover", 22, 006, 20161031, 201610315, 20161105,
			"Bradley Lamitie", "845-248-8260", "Bradley.lamitie1@marist.edu", "lost", "controller.jpg"),
			("sweater", "red and white", "Reebok", "Marist pullover with fox", 31, 10, 20161101, 20161101, 20161102, 
			"Mary Marist", "888-888-8888", "mary.marist@marist.edu", "lost", "") ;

#Deletes the locations table if it already exists
 DROP table IF EXISTS locations;
 
#Creates the locations table and its columns with their data types and options 
CREATE TABLE IF NOT EXISTS locations
(
	loc_id				INT			AUTO_INCREMENT PRIMARY KEY,
	create_date  	DATETIME	NOT NULL,
	update_date 	DATETIME	NOT NULL,
	loc_name			TEXT		NOT NULL
);

# Populates the data into each column of the locations table
INSERT INTO locations
(create_date, update_date, loc_name)
	VALUES (Now(), Now(), "Byrne House" ),
		   (Now(), Now(), "Cannavino Library"),
		   (Now(), Now(), "Champagnat Hall" ),
	       (Now(), Now(), "Chapel"),
		   (Now(), Now(), "Cornell Boathouse"),
		   (Now(), Now(), "Donnelly Hall"),
		   (Now(), Now(), "Dyson Center"),
		   (Now(), Now(), "Fern Tor"),
		   (Now(), Now(), "Fontaine Hall"),
		   (Now(), Now(), "Foy Townhouses"),
		   (Now(), Now(), "Fulton Townhouses (Lower)"),
		   (Now(), Now(), "Fulton Townhouses (Upper)"),
		   (Now(), Now(), "Greystone Hall"),		   
           (Now(), Now(), "Hancock Center"),
		   (Now(), Now(), "Kieran Gatehouse"),
		   (Now(), Now(), "Kirk House"),
           (Now(), Now(), "Leo Hall"),
		   (Now(), Now(), "Longview Park"),
	       (Now(), Now(), "Lowell Thomas Center"),
		   (Now(), Now(), "Lower Townhouses"),
		   (Now(), Now(), "Marian Hall"),
           (Now(), Now(), "Marist Boathouse"),
		   (Now(), Now(), "McCann Center"),
		   (Now(), Now(), "Midrise Hall"),
           (Now(), Now(), "Murray Student Center"),
		   (Now(), Now(), "North Campus Housing"),
		   (Now(), Now(), "St. Ann's Hermitage"),
           (Now(), Now(), "St. Peter's"),
		   (Now(), Now(), "Science/AH Building"),
		   (Now(), Now(), "Sheahan Hall"),		   
           (Now(), Now(), "Steel Plant Studio/Gallery"),
		   (Now(), Now(), "West Cedar Townhouses (Lower)"),
	       (Now(), Now(), "West Cedar Townhouses (Upper)");


# Displays the stuff table format
# SELECT * FROM users;

# Displays all the users' table data
# EXPLAIN stuff;		

# Displays all the locations' table data 
# SELECT * FROM locations;		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   