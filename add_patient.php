<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $severity = htmlspecialchars($_POST["severity"]);
    $waitTime = htmlspecialchars($_POST["waitTime"]);

    // Connect to PostgreSQL
    $dsn = 'pgsql:host=localhost;dbname=clientdb';
    $username = 'postgres';
    $password = 'superuser'; // Update with your PostgreSQL password

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }

    // Inserts the patient data into the database
    $sql = 'INSERT INTO patients (name, severity, wait_time) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $severity, $waitTime]);

    header("Location: index.php"); // Redirects to index page
    exit();
}
?>
