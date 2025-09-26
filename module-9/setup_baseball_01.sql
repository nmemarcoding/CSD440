-- Drop database if it exists (be careful, this will delete data!)
DROP DATABASE IF EXISTS baseball_01;

-- Create the database
CREATE DATABASE baseball_01;

-- Create the user (if it doesn't already exist)
CREATE USER IF NOT EXISTS 'student1'@'localhost' IDENTIFIED BY 'pass';

-- Grant privileges on the baseball_01 database to student1
GRANT ALL PRIVILEGES ON baseball_01.* TO 'student1'@'localhost';

-- Apply changes
FLUSH PRIVILEGES;
