<?php
/*
Name: Nima Memarzadeh
File: NimaPopulateTable.php
Date: 2025-09-19
Description:
  Inserts sample movie records into the `FavoriteMovies_8` table in the
  `baseball_01` database. Adds several rows with MovieID, Title, Genre,
  ReleaseYear, Rating, and WatchDate values.
*/

$conn = new mysqli("localhost", "student1", "pass", "baseball_01");

if ($conn->connect_error) {
  die("ERROR: Unable to connect: " . $conn->connect_error);
}

try {
  $conn->query("INSERT INTO FavoriteMovies_8 VALUES (1, 'The Matrix', 'Sci-Fi', 1999, 8.7, '2010-07-15')");
  $conn->query("INSERT INTO FavoriteMovies_8 VALUES (2, 'Gladiator', 'Historical Drama', 2000, 8.5, '2012-03-21')");
  $conn->query("INSERT INTO FavoriteMovies_8 VALUES (3, 'Spirited Away', 'Animation', 2001, 8.6, '2016-11-05')");
  $conn->query("INSERT INTO FavoriteMovies_8 VALUES (4, 'Arrival', 'Sci-Fi', 2016, 7.9, '2017-08-12')");
  $conn->query("INSERT INTO FavoriteMovies_8 VALUES (5, 'Dune', 'Adventure', 2021, 8.3, '2022-11-02')");

  echo "Records inserted into FavoriteMovies_8.";
} catch (mysqli_sql_exception $e) {
  if ($e->getCode() == 1146) { // Table not found
    echo "ERROR: Table 'FavoriteMovies_8' does not exist.";
  } else {
    echo "SQL ERROR: " . $e->getMessage();
  }
}

$conn->close();
?>
