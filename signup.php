<?php
    require_once __DIR__ . '/db.php';

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_user = $_POST['new-user'];
            $new_email = $_POST['new-email'];
            $new_password = $_POST['new-password'];

            // ユーザーの存在確認
            $stmt = $pdo->prepare("SELECT * FROM login WHERE EMAIL = :email");
            $stmt->bindParam(':email', $new_email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "このメールアドレスはすでに登録されています。";
            } else {
                // 新規ユーザーの登録
                $stmt = $pdo->prepare("INSERT INTO login (NAME, EMAIL, PASSWORD) VALUES (:name, :email, :password)");
                $stmt->bindParam(':name', $new_user);
                $stmt->bindParam(':email', $new_email);
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT); // ハッシュ化したパスワードを変数に格納
                $stmt->bindParam(':password', $hashed_password);  // パスワードをバインド
                if ($stmt->execute()) {
                    echo "アカウントが作成されました。ログインします。";

                    // 新規登録後、ログイン処理を行う
                    // ユーザーの情報を再取得してセッションを開始
                    $stmt = $pdo->prepare("SELECT * FROM login WHERE EMAIL = :email");
                    $stmt->bindParam(':email', $new_email);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($new_password, $user['PASSWORD'])) {
                        // セッション開始
                        session_start();
                        $_SESSION['user_id'] = $user['ID'];
                        $_SESSION['user_name'] = $user['NAME'];
                        echo "ログインしました。ようこそ、" . $user['NAME'] . "さん！";
                        // ログイン後のリダイレクト（例: ホームページへ）
                        header("Location: index.php");
                        exit;
                    } else {
                        echo "ログインに失敗しました。";
                    }
                } else {
                    echo "アカウントの作成に失敗しました。";
                }
            }
        }
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規作成</title>
    <link rel="stylesheet" href="create_user.css">
</head>
<body>
    <div class="container">
        <h1>アカウント新規作成</h1>
        <div class="form-container">
            <form id="signup-form" method="POST">
                <div class="form-group">
                    <label for="new-user">ユーザー名:</label>
                    <input type="text" id="new-user" name="new-user" required>
                </div>
                <div class="form-group">
                    <label for="new-email">メールアドレス:</label>
                    <input type="email" id="new-email" name="new-email" required>
                </div>
                <div class="form-group">
                    <label for="new-password">パスワード:</label>
                    <input type="password" id="new-password" name="new-password" required>
                </div>
                <button type="submit">新規作成</button>
            </form>
        </div>
    </div>
</body>
</html>
