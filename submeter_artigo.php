<?php
require 'conexao_artigo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $nome = $_POST['nome']; // Captura o nome fornecido no formulário

    header('Content-Type: application/json');  // Defina o cabeçalho para JSON

    // Verifica se o usuário já existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // Cria um novo usuário com o nome fornecido
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$nome, $email, $senha]);
        $usuario_id = $pdo->lastInsertId();  // Obtém o ID do usuário criado
    } else {
        // Usa o ID do usuário existente
        $usuario_id = $usuario['id'];

        // Verifica a senha
        if ($usuario['senha'] !== $senha) {
            echo json_encode(['error' => 'Senha inválida']);
            exit;
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

            echo json_encode(['success' => 'Artigo submetido com sucesso!']);
        } else {
            echo json_encode(['error' => 'Erro ao fazer o upload do arquivo.']);
        }
    } else {
        echo json_encode(['error' => 'Por favor, envie um arquivo.']);
    }
}
?>
