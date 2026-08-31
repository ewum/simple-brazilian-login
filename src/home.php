<?php
    session_start();
    require 'config/database.php';

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='container'>
        <h>Bem-vindo, <?=$_SESSION['name']?>!</h>
        <form action="logout.php" method="post">
            <button type="submit">sair</button>
        </form>
    </div>
</body>
</html>