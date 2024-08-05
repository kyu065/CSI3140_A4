<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $severity = htmlspecialchars($_POST["severity"]);
    $waitTime = htmlspecialchars($_POST["waitTime"]);
    $code = htmlspecialchars($_POST["code"]);

    // Connect to PostgreSQL
    $dsn = 'pgsql:host=localhost;dbname=clientdb';
    $username = 'postgres';
    $password = 'superuser'; 
    
    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }

    // Insert patient data
    $sql = 'INSERT INTO patients (name, severity, wait_time, code) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$name, $severity, $waitTime, $code]);
    } catch (PDOException $e) {
        if ($e->getCode() == '23505') {
            echo "<script>alert('A patient with this code already exists.'); window.location.href = 'index.php';</script>";
            exit();
        } else {
            die('Insert failed: ' . $e->getMessage());
        }
    }

    header("Location: index.php"); // Redirects to index page
    exit();
}
?>
