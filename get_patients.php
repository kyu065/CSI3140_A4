<?php
header('Content-Type: application/json');

// Database connection
$dsn = 'pgsql:host=localhost;dbname=clientdb';
$username = 'postgres';
$password = 'superuser'; 

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Fetch patient data with proper ordering
$sql = 'SELECT * FROM patients 
        ORDER BY 
        CASE severity
            WHEN \'High\' THEN 1
            WHEN \'Medium\' THEN 2
            WHEN \'Low\' THEN 3
            ELSE 4
        END, 
        wait_time ASC';

$stmt = $pdo->query($sql);

// Error handling for the query
if (!$stmt) {
    echo json_encode(['error' => 'Query failed']);
    exit();
}

$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output data as JSON
echo json_encode($patients);
?>
