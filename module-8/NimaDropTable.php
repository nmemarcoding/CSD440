<?php
/*
Name: Nima Memarzadeh
File: NimaDropTable.php
Date: 2025-08-28
Description:
  Drops the `FavoriteMovies_8` table from the `baseball_01` database
  if it exists. Useful to reset schema before recreating or repopulating.
*/
$conn = new mysqli("localhost", "student1", "pass", "baseball_01");

if ($conn->connect_error) {
  die("ERROR: Unable to connect: " . $conn->connect_error);
}

$sql = "DROP TABLE IF EXISTS FavoriteMovies_8";

if ($conn->query($sql) === TRUE) {
  echo "Table FavoriteMovies_8 dropped (if it existed).";
} else {
  echo "Error dropping table: " . $conn->error;
}

$conn->close();
?>
