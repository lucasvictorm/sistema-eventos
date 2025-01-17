<?php
session_start();
require 'conexao_artigo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário comum existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND role = 'user'");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Valida o email e a senha
    if ($usuario && $usuario['senha'] === $senha) { // Ajuste para senhas não criptografadas
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['role'] = $usuario['role'];
        header('Location: artigos.php'); // Redireciona para a página de gerenciamento do usuário
        exit;
    } else {
        $erro = "Email ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Login Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Login Usuário</h1>
        <?php if (isset($erro)): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>
        <form action="login_usuario_artigo.php" method="POST" class="form">

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
        <div style="margin-top: 20px;">
            <!-- Botão Voltar -->
            <a href="index_artigo.php" class="button btn btn-primary"  >Voltar</a>
        </div>
    </div>
</body>
</html>
