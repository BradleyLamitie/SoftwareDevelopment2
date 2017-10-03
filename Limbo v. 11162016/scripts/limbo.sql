# Create and populate the limbo database
# Authors: Bradley Lamitie and Kathy Coomes
# Version 2

# Creates limbo_db if it does not already exist
CREATE DATABASE IF NOT EXISTS limbo_db;

# States the the limbo_db is to be used
Use limbo_db;

# Deletes the users table if it already exists
DROP table IF EXISTS users;

# Creates the users table and its columns with their data types
CREATE TABLE users
(
	user_id      INT,
	first_name   TEXT,
	last_name    TEXT,
	email        TEXT,
	pass         TEXT,
	reg_date     DATETIME
 );

# Populates the data into each column of the table 
INSERT INTO users
	VALUES (001, "John", "Doe", "John.Doe@marist.edu", "gaze11e", '2016-09-21 04:15:59');

# Deletes stuff table if it already exists
DROP TABLE IF EXISTS stuff;

# Creates the stuff table and its columns with their data types and options	
CREATE TABLE stuff
(
	id     		 INT      							AUTO_INCREMENT PRIMARY KEY,
	location_id  INT      							NOT NULL,
	description  TEXT     							NOT NULL,
	create_date  DATETIME 							NOT NULL,
	update_date  DATETIME 							NOT NULL,
	room         TEXT,
	owner        TEXT,
	finder       TEXT,
	status       SET ('found', 'lost', 'claimed')  	NOT NULL      
);

# Deletes the locations table if it already exists
DROP table IF EXISTS locations;
 
#Creates the locations table and its columns with their data types and options 
CREATE TABLE locations
(
	id				INT			AUTO_INCREMENT PRIMARY KEY,
	create_date  	DATETIME	NOT NULL,
	update_date 	DATETIME	NOT NULL,
	name			TEXT		NOT NULL
);

# Populates the data into each column of the locations table
INSERT INTO locations
(create_date, update_date, name)
	VALUES (Now(), Now(), "Byrne House" ),
		   (Now(), Now(), "Cannavino Library"),
		   (Now(), Now(), "Champagnat Hall" ),
	       (Now(), Now(), "Chapel"),
		   (Now(), Now(), "Cornell Boathouse"),
		   (Now(), Now(), "Donnelly Hall"),
		   (Now(), Now(), "Dyson Center"),
		   (Now(), Now(), "Fontaine Hall"),
		   (Now(), Now(), "Foy Townhouses"),
		   (Now(), Now(), "Fulton Townhouses (Lower)"),
		   (Now(), Now(), "Greystone Hall"),
		   (Now(), Now(), "Fern Tor"),
		   (Now(), Now(), "Fulton Townhouses (Upper)"),
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
           (Now(), Now(), "St, Peter's"),
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
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   