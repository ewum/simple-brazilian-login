<?php
    require 'config/database.php';

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password_hash'])) {
        } else {
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <div class="form">
            <div class="field">
                <label for="email">email:</label>
                <input type="text" id="email" name="email" placeholder="e@mail.com">
            </div>
            <div class="field">
                <label for="password">senha:</label>
                <input type="password" id="password" name="password" placeholder="s3nh4">
            </div>
            <button type="submit">entrar</button>
            <a href="register.php">não tenho conta</a>
        </div>
    </form>
</body>
</html>