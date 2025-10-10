<?php
/*
Name: Nima Memarzadeh
File: NimaToPDF.php
Date: 2025-10-06
Description:
  Connects to the 'baseball_01' database, fetches data from 'FavoriteMovies_8',
  and generates a formatted PDF with general topic info, header, footer, and a data table.
*/

require('./fpdf.php');

// Custom class to add header and footer
class PDF extends FPDF {
  // Page header
  function Header() {
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(0, 10, 'Favorite Movies Report', 0, 1, 'C');
    $this->Ln(5);
  }

  // Page footer
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
  }
}

// Create PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// --- General Information Section ---
$pdf->MultiCell(0, 8, 
  "This PDF report contains data from my 'FavoriteMovies_8' MySQL table created in Module 8.
Each record represents one of my favorite films, including its title, genre, release year, personal rating, and the date I watched it.
This project demonstrates how PHP and the FPDF library can be used to dynamically retrieve and format data from a database into a portable PDF document."
);
$pdf->Ln(10);

// --- Connect to Database ---
$conn = new mysqli("localhost", "student1", "pass", "baseball_01");
if ($conn->connect_error) {
  $pdf->Cell(0, 10, "Database connection failed: " . $conn->connect_error, 0, 1, 'C');
  $pdf->Output();
  exit;
}

$result = $conn->query("SELECT * FROM FavoriteMovies_8");

if ($result && $result->num_rows > 0) {

  // --- Table Header ---
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->SetFillColor(200, 220, 255);
  $pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
  $pdf->Cell(50, 10, 'Title', 1, 0, 'C', true);
  $pdf->Cell(35, 10, 'Genre', 1, 0, 'C', true);
  $pdf->Cell(25, 10, 'Year', 1, 0, 'C', true);
  $pdf->Cell(25, 10, 'Rating', 1, 0, 'C', true);
  $pdf->Cell(35, 10, 'Watch Date', 1, 1, 'C', true);

  // --- Table Rows ---
  $pdf->SetFont('Arial', '', 11);
  while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 8, $row['MovieID'], 1);
    $pdf->Cell(50, 8, $row['Title'], 1);
    $pdf->Cell(35, 8, $row['Genre'], 1);
    $pdf->Cell(25, 8, $row['ReleaseYear'], 1);
    $pdf->Cell(25, 8, $row['Rating'], 1);
    $pdf->Cell(35, 8, $row['WatchDate'], 1);
    $pdf->Ln();
  }

} else {
  $pdf->Cell(0, 10, "No records found in FavoriteMovies_8.", 0, 1, 'C');
}

$conn->close();

// Output the PDF
$pdf->Output();
?>
