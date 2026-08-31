<?php
    session_start();
    require 'config/database.php';

    if (isset($_SESSION['id'])) {
        header("Location: home.php");
        exit;
    }

    function validate_cpf($cpf) {
        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t <= 10; $t++) {
            $sum = 0;
            for ($i = 0; $i < $t; $i++) {
                $sum += $cpf[$i] * (($t + 1) - $i);
            }
            $digit = ($sum * 10) % 11;
            if ($digit == 10) $digit = 0;

            if ($digit != $cpf[$t]) {
                return false;
            }
        }

        return true;
    }
    
    function numbers_only($value) {
        return preg_replace('/[^0-9]/', '', $value);
    }

    function has_letter($value) {
        return preg_match('/[a-zA-Z]/', $value);
    }

    function has_number($value) {
        return preg_match('/[0-9]/', $value);
    }

    function has_at($value) {
        return preg_match('/[@]/', $value);
    }

    function is_valid_birthdate($date) {
        $today = date('Y-m-d');
        return $date < $today;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $birth_date = $_POST['birthdate'] ?? '';
        $password = $_POST['password'] ?? '' ;
        $repeatedpassword = $_POST['repeatpassword'] ?? '';

        $errors = [];

        if (has_number($name)) $errors['name'] = 'nome não pode conter números';
        if (!has_at($email)) $errors['email'] = 'email inválido';
        if (has_letter($cpf)) $errors['cpf'] = 'cpf não pode conter letras';
        if (has_letter($phone)) $errors['phone'] = 'telefone não pode conter letras';
        if (!is_valid_birthdate($birth_date)) $errors['birthdate'] = 'data de nascimento inválida';
        if ($password != $repeatedpassword) $errors['password'] = 'a senhas não coincidem';
        
        $cpf = numbers_only($cpf);
        $phone = numbers_only($phone);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        if (strlen($cpf) !== 11 || !validate_cpf($cpf)) {
            $errors['cpf'] = 'digite um cpf válido';
        }

        if (empty($errors)) {
            $stmt = $pdo->prepare(
            "INSERT INTO users (name, email, cpf, phone, password_hash, birth_date)
             VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $cpf, $phone, $password_hash, $birth_date]);
            header("Location: home.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="register.php" method="post">
        <div class="form2">
            <div class="field2">
                <label for="name">nome:</label>
                <input type="text" id="name" name="name" placeholder="silva" required>
                <?php if (isset($errors['name'])): ?>
                    <p class='err'><?=$errors['name']?></p>
                <?php endif; ?>
            </div>
            <div class="field2">
                <label for="email">email:</label>
                <input type="email" id="email" name="email" placeholder="e@mail.com" required>
                <?php if (isset($errors['email'])): ?>
                    <p class='err'><?=$errors['email']?></p>
                <?php endif; ?>
            </div>
            <div class="field2">
                <label for="phone">telefone:</label>
                <input type="tel" id="phone" name="phone" placeholder="(99) 99999-9999" required>
                <?php if (isset($errors['phone'])): ?>
                    <p class='err'><?=$errors['phone']?></p>
                <?php endif; ?>
            </div>
            <div class="field2">
                <label for="cpf">cpf:</label>
                <input type="number" id="cpf" name="cpf" placeholder="12345678900" required>
                <?php if (isset($errors['cpf'])): ?>
                    <p class='err'><?=$errors['cpf']?></p>
                <?php endif; ?>
            </div>
            <div class="field2">
                <label for="birthdate">data de nascimento:</label>
                <input type="date" id="birthdate" name="birthdate" required>
                <?php if (isset($errors['birthdate'])): ?>
                    <p class='err'><?=$errors['birthdate']?></p>
                <?php endif; ?>
            </div>
            <div class="field2">
                <label for="password">senha:</label>
                <input type="password" id="password" name="password" placeholder="senha" required>
            </div>
            <div class="field2">
                <label for="repeatpassword">repita a senha:</label>
                <input type="password" id="repeatpassword" name="repeatpassword" placeholder="mesma senha" required>
                <?php if (isset($errors['password'])): ?>
                    <p class='err'><?=$errors['password']?></p>
                <?php endif; ?>
            </div>
            <button type="submit">cadastrar</button>
            <a href="login.php">já tenho conta</a>
        </div>
    </form>
</body>
</html>