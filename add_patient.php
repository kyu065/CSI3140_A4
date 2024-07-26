<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $severity = htmlspecialchars($_POST["severity"]);
    $waitTime = htmlspecialchars($_POST["waitTime"]);

    $file = 'patients.csv';
    $data = [$name, $severity, $waitTime];
    
    $handle = fopen($file, 'a'); // Open the file in append mode
    if ($handle) {
        fputcsv($handle, $data); // Write the data to the CSV
        fclose($handle);
    }
    
    header("Location: index.html"); // Redirect back to the index page
    exit();
}
?>
