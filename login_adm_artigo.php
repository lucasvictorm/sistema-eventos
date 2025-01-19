<?php
session_start();
require 'conexao_artigo.php'; // Verifique se o arquivo existe e o nome está correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário é um administrador
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Valida o email e a senha
    if ($usuario && $usuario['senha'] === $senha) { // Ajuste para senhas não criptografadas
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['role'] = $usuario['role'];
        header('Location: lista_artigos.php'); // Redireciona para a página de administração
        exit;
    } else {
        $erro = "Email e/ou senha inválidos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Login Administrador</h1>
        <?php if (isset($erro)): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>
        <form action="login_adm_artigo.php" method="POST" class="form">

<div class="form-group">
<label for="email">Email:</label>
<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
</div>


<div class="form-group">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
</div>
<button type="submit">Entrar</button>
</form>
    </div>
</body>
</html>
