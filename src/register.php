<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="home.php" method="post">
        <div class="form2">
            <div class="field2">
                <label for="nome">nome:</label>
                <input type="text" id="nome" name="nome" placeholder="nome">
            </div>
            <div class="field2">
                <label for="email">email:</label>
                <input type="text" id="email" name="email" placeholder="seu@email.com">
            </div>
            <div class="field2">
                <label for="phone">telefone:</label>
                <input type="text" id="phone" name="phone" placeholder="(99) 99999-9999">
            </div>
            <div class="field2">
                <label for="cpf">cpf:</label>
                <input type="text" id="cpf" name="cpf" placeholder="123456789-10">
            </div>
            <div class="field2">
                <label for="birthdate">data de nascimento:</label>
                <input type="date" id="birthdate" name="birthdate">
            </div>
            <div class="field2">
                <label for="password">senha:</label>
                <input type="password" id="password" name="password" placeholder="senha">
            </div>
            <div class="field2">
                <label for="repeatpassword">repita a senha:</label>
                <input type="password" id="repeatpassword" name="repeatpassword" placeholder="mesma senha">
            </div>
            <button type="submit">entrar</button>
            <a href="login.php">já tenho conta</a>
        </div>
    </form>
</body>
</html>