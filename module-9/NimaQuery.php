<?php
/*
Name: Nima Memarzadeh
File: NimaQuery.php
Date: 2025-09-22
Description:
  Query page for Module 9 assignment.
  Allows user to search the FavoriteMovies_8 table by genre or title.
  Displays results in a formatted HTML table.
*/
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN'
  'http://www.w3.org/TR/1999/REC-html-19991224/strict.dtd'>

<html>
  <head>
    <title> Nima - Query Favorite Movies </title>
  </head>

  <body bgcolor='#ffe4b5'>
    <center>
      <h2>Search Favorite Movies</h2>
      <br />

      <?php
        $conn = new mysqli("localhost", "student1", "pass", "baseball_01");

        if ($conn->connect_error) {
          die("ERROR: Unable to connect: " . $conn->connect_error);
        }

        $sql = "SELECT DISTINCT Genre FROM FavoriteMovies_8 ORDER BY Genre";
        $rs = mysqli_query($conn, $sql);
      ?>

      <form action='NimaQuery.php' method='post'>
        <p>
          <label>
            Select Genre
            <br /><br />
          </label>
          <select name='genre'>
            <option value=''>-- All Genres --</option>
            <?php
              if ($rs && mysqli_num_rows($rs) > 0) {
                while ($row = mysqli_fetch_assoc($rs)) {
                  echo("<option value='".$row['Genre']."'>".$row['Genre']."</option>");
                }
              }
            ?>
          </select>
        </p>

        <p>
          <label>
            Or Enter Title
            <br /><br />
          </label>
          <input type='text' name='title' />
        </p>

        <p>
          <input type='submit' value='Search' />
        </p>
      </form>

      <br />

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $genre = $_POST['genre'];
          $title = $_POST['title'];

          if (!empty($genre)) {
            $sql = "SELECT * FROM FavoriteMovies_8 WHERE Genre = '" . $conn->real_escape_string($genre) . "'";
          } elseif (!empty($title)) {
            $sql = "SELECT * FROM FavoriteMovies_8 WHERE Title LIKE '%" . $conn->real_escape_string($title) . "%'";
          } else {
            $sql = "SELECT * FROM FavoriteMovies_8";
          }

          $rs = mysqli_query($conn, $sql);

          if ($rs && mysqli_num_rows($rs) > 0) {
            echo "<table border='1' width='80%'>";
            echo "<tr align='center' style='background-color:#ffdead;'>
                    <td><b>Movie ID</b></td>
                    <td><b>Title</b></td>
                    <td><b>Genre</b></td>
                    <td><b>Year</b></td>
                    <td><b>Rating</b></td>
                    <td><b>Watch Date</b></td>
                  </tr>";

            while ($row = mysqli_fetch_assoc($rs)) {
              echo "<tr align='center' style='background-color:#ffdead;'>
                      <td>".$row['MovieID']."</td>
                      <td>".$row['Title']."</td>
                      <td>".$row['Genre']."</td>
                      <td>".$row['ReleaseYear']."</td>
                      <td>".$row['Rating']."</td>
                      <td>".$row['WatchDate']."</td>
                    </tr>";
            }
            echo "</table>";
          } else {
            echo "No records found.";
          }
        }

        $conn->close();
      ?>

      <br />
      <a href="NimaIndex.php">Home</a>
    </center>
  </body>
</html>
