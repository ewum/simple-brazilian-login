<?php
    session_start();
    require 'config/database.php';

    if (isset($_SESSION['id'])) {
        header("Location: home.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $invalid_credentials = false;

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header('Location: home.php');
            exit;
        } else {
            $invalid_credentials = true;
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
                <input type="email" id="email" name="email" placeholder="e@mail.com" required>
            </div>
            <div class="field">
                <label for="password">senha:</label>
                <input type="password" id="password" name="password" placeholder="s3nh4" required>
                <?php if (isset($invalid_credentials) && $invalid_credentials): ?>
                    <p class='err'>email ou senha incorretos</p>
                <?php endif; ?>
            </div>
            <button type="submit">entrar</button>
            <a href="register.php">não tenho conta</a>
        </div>
    </form>
</body>
</html>