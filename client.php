<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $severity = htmlspecialchars($_POST["severity"]);
    $waitTime = htmlspecialchars($_POST["waitTime"]);

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

    // Inserts the patient data into the database
    $sql = 'INSERT INTO patients (name, severity, wait_time) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $severity, $waitTime]);

    header("Location: client.php"); // Redirects to client page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Patient Data Entry</h1>
    <h2>Add Patient</h2>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="severity">Severity:</label>
        <select id="severity" name="severity" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        <label for="waitTime">Wait Time (minutes):</label>
        <input type="number" id="waitTime" name="waitTime" required>
        <button type="submit" name="add">Add Patient</button>
    </form>

    <button id="goToAdminPage">Go to Admin Page</button>

    <script src="scripts.js"></script>
</body>
</html>
