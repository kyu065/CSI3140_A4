<?php
header('Content-Type: application/json');

// Open the CSV file for reading
$file = fopen('patients.csv', 'r');
$data = [];

// Read the CSV file line by line
while (($row = fgetcsv($file)) !== FALSE) {
    // Skip the header row
    if ($row[0] === 'id') {
        continue;
    }
    $data[] = [
        'id' => $row[0],
        'name' => $row[1],
        'severity' => $row[2],
        'wait_time' => $row[3],
        'created_at' => $row[4]
    ];
}

// Close the file
fclose($file);

// Return the data as JSON
echo json_encode($data);
?>
