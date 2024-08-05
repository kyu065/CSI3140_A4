<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $code = htmlspecialchars($_POST["code"]);

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

    // Fetch patient data
    $sql = 'SELECT wait_time FROM patients WHERE name = ? AND code = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $code]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $waitTime = $result['wait_time'];
        echo "<script>alert('Your approximate wait time is: $waitTime minutes');</script>";
    } else {
        echo "<script>alert('Wrong input. Please check your name and code.');</script>";
    }
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
    <h2>Check Wait Time</h2>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" maxlength="3" required> <!-- New field -->
        <button type="submit" name="check">Check Wait Time</button>
    </form>

    <button id="goToAdminPage">Go to Admin Page</button>

    <script src="scripts.js"></script>
</body>
</html>
