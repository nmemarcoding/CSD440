<?php
/*
Name: Nima Memarzadeh
File: NimaForm.php
Date: 2025-09-22
Description:
  Form page for Module 9 assignment.
  Allows user to add a new record into the FavoriteMovies_8 table.
  Includes input validation and error handling before inserting.
*/
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN'
  'http://www.w3.org/TR/1999/REC-html-19991224/strict.dtd'>

<html>
  <head>
    <title> Nima - Add Favorite Movie </title>
  </head>

  <body bgcolor='#e6e6fa'>
    <center>
      <h2>Add a New Movie</h2>
      <br />

      <form action='NimaForm.php' method='post'>
        <p>Movie ID: <input type='number' name='MovieID' required /></p>
        <p>Title: <input type='text' name='Title' required /></p>
        <p>Genre: <input type='text' name='Genre' /></p>
        <p>Release Year: <input type='number' name='ReleaseYear' /></p>
        <p>Rating: <input type='text' name='Rating' placeholder='e.g. 8.5' /></p>
        <p>Watch Date: <input type='date' name='WatchDate' /></p>
        <p><input type='submit' value='Add Movie' /></p>
      </form>

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $conn = new mysqli("localhost", "student1", "pass", "baseball_01");

          if ($conn->connect_error) {
            die("ERROR: Unable to connect: " . $conn->connect_error);
          }

          // Collect form input
          $MovieID = trim($_POST['MovieID']);
          $Title = trim($_POST['Title']);
          $Genre = trim($_POST['Genre']);
          $ReleaseYear = trim($_POST['ReleaseYear']);
          $Rating = trim($_POST['Rating']);
          $WatchDate = trim($_POST['WatchDate']);

          $errors = [];

          // Validate inputs
          if ($MovieID === "" || !is_numeric($MovieID)) {
            $errors[] = "Movie ID must be a number.";
          }

          if ($Title === "") {
            $errors[] = "Title is required.";
          }

          if ($ReleaseYear !== "" && (!is_numeric($ReleaseYear) || $ReleaseYear < 1888 || $ReleaseYear > date("Y")+1)) {
            $errors[] = "Release Year must be a valid year.";
          }

          if ($Rating !== "" && (!is_numeric($Rating) || $Rating < 0 || $Rating > 10)) {
            $errors[] = "Rating must be a number between 0 and 10.";
          }

          // Check if MovieID already exists
          $checkSql = "SELECT * FROM FavoriteMovies_8 WHERE MovieID = '" . $conn->real_escape_string($MovieID) . "'";
          $checkRs = $conn->query($checkSql);
          if ($checkRs && $checkRs->num_rows > 0) {
            $errors[] = "Movie ID already exists. Please use another.";
          }

          if (count($errors) > 0) {
            echo "<p style='color:red;'><b>Input Errors:</b><br />";
            foreach ($errors as $err) {
              echo $err . "<br />";
            }
            echo "</p>";
          } else {
            $sql = "INSERT INTO FavoriteMovies_8 (MovieID, Title, Genre, ReleaseYear, Rating, WatchDate)
                    VALUES ('".$conn->real_escape_string($MovieID)."', 
                            '".$conn->real_escape_string($Title)."', 
                            '".$conn->real_escape_string($Genre)."', 
                            '".$conn->real_escape_string($ReleaseYear)."', 
                            '".$conn->real_escape_string($Rating)."', 
                            '".$conn->real_escape_string($WatchDate)."')";

            if ($conn->query($sql) === TRUE) {
              echo "<p style='color:green;'>Record added successfully.</p>";
            } else {
              echo "<p style='color:red;'>Database Error: " . $conn->error . "</p>";
            }
          }

          $conn->close();
        }
      ?>

      <br />
      <a href="NimaIndex.php">Home</a>
    </center>
  </body>
</html>
