<?php
    // Database connection
    $host = 'localhost';
    $dbname = 'anything';
    $username = 'kkuro';
    $password = '5001';

    session_start(); // Start the session

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if user is logged in
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            // Fetch accounts for the logged-in user
            $stmt = $pdo->prepare("SELECT USERNAME, PASSWORD FROM accounts WHERE ID = :user_id ORDER BY CREATED_AT DESC");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Return as JSON
            echo json_encode($accounts);
        } else {
            echo json_encode(['error' => 'User not logged in']);
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Information</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
    <h1>Account Information</h1>
    <script src="account.js"></script>
</body>
</html>
