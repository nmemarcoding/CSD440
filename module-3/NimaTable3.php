<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nima Table3</title>

  <?php
    /*
      Author: Nima Memarzadeh
      Course: Bellevue University
      Module: 3 – Functions & Scope
      Assignment: Table3
      File: NimaTable3.php
      Description:
        Builds upon the Module 2 table by delegating cell value generation
        to a function in an external file (fun_NimaTable3.php).
        Each cell displays two random numbers and their sum.
        Table tags are written in HTML; PHP is only used for values.
    */
    require('fun_table3.php'); // Include external function
  ?>
</head>
<body>

  <h2>Sum of Two Random Numbers</h2>

  <!-- 
    Table Notes:
      - 8x8 grid
      - Each cell shows the format "r1 + r2 = sum"
      - Table structure is HTML; PHP inserts the values
  -->
  <table border="1" width="600">
    <caption>Two-Dimensional Table — Random Numbers and Their Sum</caption>
    <thead>
      <tr>
        <td colspan="8" style="text-align:center;">Each cell = rand(1,6) + rand(1,6) = sum</td>
      </tr>
    </thead>
    <tbody>
      <?php
        // Outer loop controls the rows
        for ($row = 0; $row < 8; $row++) {
      ?>
        <tr>
          <?php
            // Inner loop controls the columns
            for ($col = 0; $col < 8; $col++) {
              $r1 = rand(1, 6);
              $r2 = rand(1, 6);

              // Call the external function to get the sum
              $cellValue = generateCellValue($r1, $r2);
          ?>
            <td>
              <?php echo "$r1 + $r2 = $cellValue"; ?>
            </td>
          <?php
            } // end inner loop
          ?>
        </tr>
      <?php
        } // end outer loop
      ?>
    </tbody>
  </table>

</body>
</html>
