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
            // Fetch account and review count for the logged-in user
    $stmt = $pdo->prepare("
    SELECT
        l.NAME, l.PASSWORD, l.EMAIL,
        COUNT(r.ID) AS review_count
    FROM login l
    LEFT JOIN ramen_reviews r ON l.ID = r.USER_ID
    WHERE l.ID = :user_id
    GROUP BY l.ID
    ");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } else {
                $accounts = ['error' => 'User not logged in'];
            }
        } catch (PDOException $e) {
            $accounts = ['error' => 'Connection failed: ' . $e->getMessage()];
        }
    ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント情報</title>
    <link rel="stylesheet" href="account.css">
</>
    <h1>アカウント情報</h1>
    <div id="account-info">
        <?php if (isset($accounts['error'])): ?>
            <p><?php echo $accounts['error']; ?></p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>投稿回数</th>
                </tr>
                <?php foreach ($accounts as $account): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($account['NAME'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($account['EMAIL'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($account['review_count'], ENT_QUOTES, 'UTF-8'); ?></td> <!-- ← 追加 -->
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="button-container">
                <form action="logout.php" method="post">
                    <button type="submit">ログアウト</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <script src="account.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>
