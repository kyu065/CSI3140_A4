<?php
header('Content-Type: application/json');

// Connect to PostgreSQL
$dsn = 'pgsql:host=localhost;dbname=clientdb';
$username = 'postgres';
$password = 'superuser'; // Update with your PostgreSQL password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch patient data from the database
    $sql = 'SELECT * FROM patients';
    $stmt = $pdo->query($sql);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
