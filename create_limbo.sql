# This file creates the Limbo database.
# Authors:  Brad Lamitie and Kathy Coomes.

drop database if exists limbo_db;
create database limbo_db;
use limbo_db;

#creates table called stuff if it doesn't already exist
CREATE TABLE IF NOT EXISTS stuff
(
id INT,
descr TEXT
);
#shows us what the stuff Table contains
Explain stuff;
#Makes changes to stuff table
ALTER TABLE stuff
#Changes id to the Primary Key
ADD PRIMARY KEY(id),
#Changes name of column from descr to description
CHANGE descr description TEXT,
#Adds 3 more columns
ADD COLUMN first_name TEXT,
ADD COLUMN last_name TEXT,
ADD COLUMN email TEXT;

Explain stuff;