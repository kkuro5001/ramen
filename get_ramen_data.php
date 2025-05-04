<?php
require_once __DIR__ . '/db.php';
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("
        SELECT
            r.ID,
            r.STORE_NAME,
            r.COMMENT,
            r.DATE,
            t.NAME AS TASTE,
            u.NAME AS USER_NAME,
            p.PHOTO
        FROM ramen_reviews r
        LEFT JOIN taste t ON r.TASTE_ID = t.ID
        LEFT JOIN login u ON r.USER_ID = u.ID
        LEFT JOIN ramen_photos p ON r.ID = p.REVIEW_ID
        ORDER BY r.DATE DESC
    ");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Base64 encode the photo so it can be used in <img src="">
    foreach ($results as &$row) {
        if (!empty($row['PHOTO'])) {
            $row['PHOTO'] = 'data:image/jpeg;base64,' . base64_encode($row['PHOTO']);
        } else {
            $row['PHOTO'] = null;
        }
    }

    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
