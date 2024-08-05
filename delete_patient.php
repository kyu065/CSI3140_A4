<?php
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

// Database connection
$dsn = 'pgsql:host=localhost;dbname=clientdb';
$username = 'postgres';
$password = 'superuser'; 

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

if (isset($input['id'])) {
    $id = intval($input['id']);

    $sql = 'DELETE FROM patients WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$id]);

    echo json_encode(['success' => $result]);
} else {
    echo json_encode(['success' => false, 'error' => 'No ID provided']);
}