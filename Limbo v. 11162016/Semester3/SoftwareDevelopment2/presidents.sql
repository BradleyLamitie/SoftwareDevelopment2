# Presidents of the United States
# Authors:  Bradley Lamitie and Kathy Coomes

# Creates site_db database if it does not already exist
Create Database if not exists site_db;

# States that the site_db is to be used
USE site_db;

# Deletes the presidents table if it already exits
Drop table if exists presidents;

/* Creates the presidents table, its columns, and the data types and 
	the options chosen for each column */
Create table presidents
(
	id		INT			AUTO_INCREMENT	PRIMARY KEY,
	fname	TEXT		NOT NULL,
	lname	TEXT		NOT NULL,
	number	INT 		NOT NULL,
	dob		DATETIME	NOT NULL
);

# Populates the data into each column of the table 
INSERT INTO presidents
(fname, lname, number, dob)
	VALUES("George", "Washington",1,'1732-02-22 00:00:00'),
	("Zachary","Taylor",12,'1784-11-24 00:00:00'),
	("Ulysses","Grant",18,'1822-04-27 00:00:00'),
	("Theodore","Roosevelt",26,'1858-10-27 00:00:00'),
	("Jimmy","Carter",39,'1924-10-01 00:00:00');
	
# SHows the entire table
	SELECT * FROM presidents;
	
/* shows the columns lname, number, and dob from the presidents
   table while ordering data in ascending order by number*/	
	SELECT lname, number, dob FROM presidents
	ORDER BY number;
	
/* shows the columns lname, number, and dob from the presidents
   table while ordering data in ascending order by lname */		
	SELECT lname, number, dob FROM presidents
	ORDER BY lname;
	
/* shows the columns lname, number, and dob from the presidents
   table while ordering data in descending order by dob */		
	SELECT lname, number, dob FROM presidents
	ORDER BY dob DESC;