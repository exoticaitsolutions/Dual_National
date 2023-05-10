<?php
if(isset($_POST['download_csv'])) {
  // Set headers for CSV download
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="filename.csv"');

  // Create CSV data
  $csv_data = "Name,Email\n";
  $csv_data .= "John Doe,john@example.com\n";
  $csv_data .= "Jane Doe,jane@example.com\n";

  // Output CSV data to the browser
  echo $csv_data;
  exit;
}
