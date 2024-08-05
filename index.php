<?php
// Start session if needed
session_start();

// Database connection 
$dsn = 'pgsql:host=localhost;dbname=clientdb';
$username = 'postgres';
$password = 'superuser'; 

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Handles form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $name = htmlspecialchars($_POST["name"]);
        $severity = htmlspecialchars($_POST["severity"]);
        $waitTime = htmlspecialchars($_POST["waitTime"]);
        $code = htmlspecialchars($_POST["code"]);

        // Validate the severity value
        $allowed_severities = ['Low', 'Medium', 'High'];
        if (!in_array($severity, $allowed_severities)) {
            die('Invalid severity value.');
        }

        // Check if code already exists
        $checkSql = 'SELECT COUNT(*) FROM patients WHERE code = ?';
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$code]);
        $exists = $checkStmt->fetchColumn();

        if ($exists) {
            echo "<script>alert('A patient with this code already exists.'); window.location.href = 'index.php';</script>";
            exit();
        }

        // Inserts patient data
        $sql = 'INSERT INTO patients (name, severity, wait_time, code) VALUES (?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$name, $severity, $waitTime, $code]);
        } catch (PDOException $e) {
            die('Insert failed: ' . $e->getMessage());
        }

        header("Location: index.php");
        exit();
    }

    if (isset($_POST['deleteById'])) {
        $id = intval($_POST["id"]);

        // Deletes patient
        $sql = 'DELETE FROM patients WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        header("Location: index.php");
        exit();
    }

    if (isset($_POST['deleteByName'])) {
        $name = htmlspecialchars($_POST["deleteName"]);

        // Delete patient by name
        $sql = 'DELETE FROM patients WHERE name = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name]);

        header("Location: index.php");
        exit();
    }
}

// Fetching patient data with ordering
$sql = 'SELECT * FROM patients ORDER BY 
        CASE severity
            WHEN \'High\' THEN 1
            WHEN \'Medium\' THEN 2
            WHEN \'Low\' THEN 3
        END, wait_time ASC';
$stmt = $pdo->query($sql);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>Patient Management</h1>
        <button id="goToClientPage">Go to Client Page</button>
    </div>

    <h2>Add Patient</h2>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="severity">Severity:</label>
        <select id="severity" name="severity" required>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        <label for="waitTime">Wait Time (minutes):</label>
        <input type="number" id="waitTime" name="waitTime" required>
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" maxlength="3" required>
        <button type="submit" name="add">Add Patient</button>
    </form>

    <h2>Patient List</h2>
    <table id="patients">
        <thead>
            <tr>
                <th>Name</th>
                <th>Severity</th>
                <th>Wait Time (minutes)</th>
                <th>Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($patients) && is_array($patients)): ?>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['name']); ?></td>
                        <td><?php echo htmlspecialchars($patient['severity']); ?></td>
                        <td><?php echo htmlspecialchars($patient['wait_time']); ?></td>
                        <td><?php echo htmlspecialchars($patient['code']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($patient['id']); ?>">
                                <button type="submit" name="deleteById">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No patients found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Delete Patient by Name</h2>
    <form method="POST" action="">
        <label for="deleteName">Name:</label>
        <input type="text" id="deleteName" name="deleteName" required>
        <button type="submit" name="deleteByName">Delete by Name</button>
    </form>

    <script src="scripts.js"></script>
</body>
</html>
