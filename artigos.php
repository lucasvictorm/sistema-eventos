<?php
session_start();
require 'conexao_artigo.php';

// Verifica se o usuário está logado e é um usuário comum
if (!isset($_SESSION['usuario_id']) || $_SESSION['role'] !== 'user') {
    header('Location: index_artigo.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Processa a exclusão do artigo
    if (isset($_POST['excluir'])) {
        // Busca o caminho do arquivo para excluí-lo
        $stmt = $pdo->prepare("SELECT arquivo FROM artigos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $usuario_id]);
        $artigo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($artigo) {
            // Exclui o arquivo do sistema
            if (file_exists($artigo['arquivo'])) {
                unlink($artigo['arquivo']);
            }

            // Exclui o registro do banco de dados
            $stmt = $pdo->prepare("DELETE FROM artigos WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$id, $usuario_id]);
        }
    }

    // Processa a edição do artigo
    if (isset($_POST['editar'])) {
        $titulo = $_POST['titulo'];
        $resumo = $_POST['resumo'];

        // Verifica se um novo arquivo foi enviado
        if (!empty($_FILES['arquivo']['name'])) {
            // Busca o caminho do arquivo antigo para excluí-lo
            $stmt = $pdo->prepare("SELECT arquivo FROM artigos WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$id, $usuario_id]);
            $artigo = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($artigo && file_exists($artigo['arquivo'])) {
                unlink($artigo['arquivo']);
            }

            // Faz o upload do novo arquivo
            $uploadDir = 'uploads/';
            $arquivoNome = basename($_FILES['arquivo']['name']);
            $caminhoArquivo = $uploadDir . $arquivoNome;

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoArquivo)) {
                // Atualiza o título, resumo e caminho do arquivo no banco de dados
                $stmt = $pdo->prepare("UPDATE artigos SET titulo = ?, resumo = ?, arquivo = ? WHERE id = ? AND usuario_id = ?");
                $stmt->execute([$titulo, $resumo, $caminhoArquivo, $id, $usuario_id]);
            }
        } else {
            // Atualiza apenas o título e o resumo
            $stmt = $pdo->prepare("UPDATE artigos SET titulo = ?, resumo = ? WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$titulo, $resumo, $id, $usuario_id]);
        }
    }
}

// Busca todos os artigos do usuário
$artigos = $pdo->query("SELECT * FROM artigos WHERE usuario_id = $usuario_id")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Meus Artigos</title>
</head>
<body>
    <div class="container">
        <h1>Meus Artigos</h1>
        <ul>
            <?php foreach ($artigos as $artigo): ?>
                <li>
                    <form action="artigos.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $artigo['id']; ?>">
                        <input type="text" name="titulo" value="<?php echo htmlspecialchars($artigo['titulo']); ?>" required>
                        <textarea name="resumo" required><?php echo htmlspecialchars($artigo['resumo']); ?></textarea>
                        <p>Arquivo atual: <a href="<?php echo $artigo['arquivo']; ?>" download><?php echo basename($artigo['arquivo']); ?></a></p>
                        <label for="arquivo">Substituir arquivo:</label>
                        <input type="file" name="arquivo" accept=".pdf,.doc,.docx,.ppxt">
                        <button type="submit" name="editar">Salvar Alterações</button>
                        <button type="submit" name="excluir">Excluir Artigo</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <div style="margin-top: 20px;">
            <!-- Botão Voltar -->
            <a href="index_artigo.php" class="button">Voltar</a>
        </div>
    </div>
</body>
</html>
