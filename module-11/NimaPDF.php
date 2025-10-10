<!DOCTYPE html>
<html lang="en">
<!--
  Name: Nima Memarzadeh
  File: NimaPDF.php
  Date: 2025-10-06
  Description:
    Launch page for generating a PDF of my Favorite Movies database.
-->
<head>
  <meta charset="UTF-8">
  <title>Nima PDF Generator</title>
  <script>
    function getPDF() {
      window.open("NimaToPDF.php");
    }
  </script>
</head>
<body style="font-family: Arial; text-align:center; margin-top: 100px;">

  <h1>Module 11 Assignment: FPDF + MySQL</h1>
  <p>Click below to generate a PDF report of my favorite movies.</p>
  <button onclick="getPDF();" style="padding: 10px 20px; font-size: 18px;">Generate PDF</button>

</body>
</html>
