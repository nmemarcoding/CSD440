<?php
/*
Name: Nima Memarzadeh
File: NimaQueryTable.php
Date: 2025-08-28
Assignment:
  Program that checks if a string is a palindrome.
  I used six examples: three are palindromes and three are not.
  For each test it shows the original string, the reversed string,
  and the result from my function.
*/

$conn = new mysqli("localhost", "student1", "pass", "baseball_01");

if ($conn->connect_error) {
  die("ERROR: Unable to connect: " . $conn->connect_error);
}

try {
  $sql = "SELECT * FROM FavoriteMovies_8";
  $rs = $conn->query($sql);

  echo "<table border='1' width='80%'>";
  echo "<tr style='background-color:#ffdead;'>
          <th>Movie ID</th>
          <th>Title</th>
          <th>Genre</th>
          <th>Year</th>
          <th>Rating</th>
          <th>Watch Date</th>
        </tr>";

  while ($row = $rs->fetch_assoc()) {
    echo "<tr style='background-color:#ffdead;'>
            <td>".$row['MovieID']."</td>
            <td>".$row['Title']."</td>
            <td>".$row['Genre']."</td>
            <td>".$row['ReleaseYear']."</td>
            <td>".$row['Rating']."</td>
            <td>".$row['WatchDate']."</td>
          </tr>";
  }

  echo "</table>";

} catch (mysqli_sql_exception $e) {
  if ($e->getCode() == 1146) { // Table doesn't exist
    echo "ERROR: Table 'FavoriteMovies_8' does not exist.";
  } else {
    echo "SQL ERROR: " . $e->getMessage();
  }
}

$conn->close();
?>
