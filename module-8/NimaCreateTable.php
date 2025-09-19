<?php
/*
Name: Nima Memarzadeh
File: NimaCreateTable.php
Date: 2025-09-19
Description:
  Creates the `FavoriteMovies_8` table in the `baseball_01` database
  with columns for MovieID, Title, Genre, ReleaseYear, Rating, and WatchDate.
*/
$conn = new mysqli("localhost", "student1", "pass", "baseball_01");

if ($conn->connect_error) {
  die("ERROR: Unable to connect: " . $conn->connect_error);
}

// Check if table exists
$tableExists = false;
$checkSql = "SHOW TABLES LIKE 'FavoriteMovies_8'";
$result = $conn->query($checkSql);
if ($result && $result->num_rows > 0) {
  $tableExists = true;
}

if ($tableExists) {
  echo "Table FavoriteMovies_8 already exists.";
} else {
  $sql = "CREATE TABLE FavoriteMovies_8 (
    MovieID INT NOT NULL PRIMARY KEY,
    Title VARCHAR(50) NOT NULL,
    Genre VARCHAR(30),
    ReleaseYear INT,
    Rating DECIMAL(2,1),
    WatchDate DATE
  )";
  if ($conn->query($sql) === TRUE) {
    echo "Table FavoriteMovies_8 created.";
  } else {
    echo "Error creating table: " . $conn->error;
  }
}

$conn->close();
?>
