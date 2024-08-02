<?php
// Start session if needed
session_start();

// Database connection details
$dsn = 'pgsql:host=localhost;dbname=clientdb';
$username = 'postgres';
$password = 'superuser'; // Update with your PostgreSQL password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $severity = htmlspecialchars($_POST["severity"]);
    $waitTime = htmlspecialchars($_POST["waitTime"]);

    // Insert patient data into the database
    $sql = 'INSERT INTO patients (name, severity, wait_time) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $severity, $waitTime]);

    // Redirect to avoid form resubmission
    header("Location: index.php");
    exit();
}

// Fetch patient data
$sql = 'SELECT * FROM patients';
$stmt = $pdo->query($sql);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Waitlist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Patient Waitlist</h1>
    <h2>Add Patient</h2>
    <form id="patientForm" method="POST" action="">
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
        <button type="submit">Add Patient</button>
    </form>
    <h2>Patient List</h2>
    <table id="patients">
        <thead>
            <tr>
                <th>Name</th>
                <th>Severity</th>
                <th>Wait Time (minutes)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?php echo htmlspecialchars($patient['name']); ?></td>
                    <td><?php echo htmlspecialchars($patient['severity']); ?></td>
                    <td><?php echo htmlspecialchars($patient['wait_time']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="scripts.js"></script>
</body>
</html>
