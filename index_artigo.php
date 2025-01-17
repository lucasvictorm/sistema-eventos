<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Submeter Artigo</title>
</head>
<body>
    <div class="container">
        <?php 
        include_once('cabecalho.php');
        ?>
        <h1>Sistema de Submissão de Artigos</h1>
        <form action="submeter_artigo.php" method="POST" enctype="multipart/form-data" class="form">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="text" name="nome" placeholder="Nome do Autor" required>
            <input type="text" name="titulo" placeholder="Título do Artigo" required>
            <textarea name="resumo" placeholder="Resumo do Artigo" required></textarea>
            <input type="file" name="arquivo" accept=".pdf,.doc,.docx" required>
            <button type="submit">Submeter Artigo</button>
        </form>
        <div class="links">
            <a href="login_adm_artigo.php">Entrar como Administrador</a>
            <a href="login_usuario_artigo.php">Editar/Excluir Submissão</a>
        </div>
    </div>
</body>
</html>

        
