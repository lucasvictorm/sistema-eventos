<?php
require 'conexao_artigo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $nome = $_POST['nome']; // Captura o nome fornecido no formulário

    // Verifica se o usuário já existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) 
        // Cria um novo usuário com o nome fornecido
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$nome, $email, $senha]);
        $usuario_id = $pdo->lastInsertId();
    } else {
        // Usa o ID do usuário existente
        $usuario_id = $usuario['id'];

        // Verifica a senha
        if ($usuario['senha'] !== $senha) {
            die("Senha inválida para este email.");
        }
    }

    // Faz o upload do arquivo
    if (!empty($_FILES['arquivo']['name'])) {
        $uploadDir = 'uploads/';
        $arquivoNome = basename($_FILES['arquivo']['name']);
        $caminhoArquivo = $uploadDir . $arquivoNome;

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoArquivo)) {
            // Insere o artigo no banco de dados
            $stmt = $pdo->prepare("INSERT INTO artigos (titulo, resumo, arquivo, usuario_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$titulo, $resumo, $caminhoArquivo, $usuario_id]);

            echo "<p>Artigo submetido com sucesso!</p>";
        } else {
            echo "<p>Erro ao fazer o upload do arquivo.</p>";
        }
    } else {
        echo "<p>Por favor, envie um arquivo.</p>";
    }

?>

<a href="index_artigo.php">Voltar</a>
