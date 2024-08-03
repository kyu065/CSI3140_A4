<?php
header('Content-Type: application/json');

// Get patient ID from POST request
$data = json_decode(file_get_contents('php://input'), true);
$patientId = $data['id'];

// Connect to PostgreSQL
$dsn = 'pgsql:host=localhost;dbname=clientdb';
$username = 'postgres';
$password = 'superuser'; 

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

// Delete patient from the database
$sql = 'DELETE FROM patients WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$patientId]);

// Adjust wait times
$sql = 'UPDATE patients SET wait_time = wait_time - 5 WHERE wait_time > 0';
$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode(['success' => true]);
?>
