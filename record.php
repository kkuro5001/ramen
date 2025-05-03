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

            // Fetch reviews for the logged-in user
            $stmt = $pdo->prepare("SELECT ramen_reviews.STORE_NAME, ramen_reviews.COMMENT, taste.NAME AS TASTE_NAME, ramen_reviews.DATE 
                                   FROM ramen_reviews
                                   JOIN taste ON ramen_reviews.TASTE_ID = taste.ID 
                                   WHERE ramen_reviews.USER_ID = :user_id 
                                   ORDER BY ramen_reviews.DATE DESC");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Return as JSON
            echo json_encode($reviews);
        } else {
            echo json_encode(['error' => 'User not logged in']);
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ramen Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>My Ramen Reviews</h1>
    <div id="reviews"></div>
    <script src="script.js"></script>
</body>
</html>
