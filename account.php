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
            $stmt = $pdo->prepare("SELECT NAME, PASSWORD, EMAIL FROM login WHERE ID = :user_id");
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
    <title>Account Information</title>
    <link rel="stylesheet" href="account.css">
</>
    <h1>Account Information</h1>
    <div id="account-info">
        <?php if (isset($accounts['error'])): ?>
            <p><?php echo $accounts['error']; ?></p>
        <?php else: ?>
            <table>
                <tr>
                    <th>アカウント</th>
                    <th>パスワード</th>
                    <th>メールアドレス</th>
                </tr>
                <?php foreach ($accounts as $account): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($account['NAME'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($account['PASSWORD'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($account['EMAIL'], ENT_QUOTES, 'UTF-8'); ?></td>
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
</html>
