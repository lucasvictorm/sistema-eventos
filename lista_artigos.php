<?php
session_start();
require 'conexao_artigo.php';

// Verifica se o administrador está logado
if (!isset($_SESSION['usuario_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index_artigo.php');
    exit;
}

// Processa exclusão de artigos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['excluir'])) {
    $id = $_POST['id'];

    // Busca o arquivo do artigo para excluir
    $stmt = $pdo->prepare("SELECT arquivo FROM artigos WHERE id = ?");
    $stmt->execute([$id]);
    $artigo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($artigo) {
        // Exclui o arquivo do sistema
        if (file_exists($artigo['arquivo'])) {
            unlink($artigo['arquivo']);
        }

        // Exclui o registro do banco de dados
        $stmt = $pdo->prepare("DELETE FROM artigos WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Atualiza a página para refletir a exclusão
    header('Location: lista_artigos.php');
    exit;
}

// Busca todos os artigos e informações do autor
$artigos = $pdo->query("SELECT a.id, a.titulo, a.resumo, a.arquivo, u.nome AS autor FROM artigos a JOIN usuarios u ON a.usuario_id = u.id ORDER BY a.id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/lista_artigos.css">
    <title>Lista de Artigos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <?php 
        include_once('adm.php');
    ?>
    <div class="container">
        <h1>Todos os Artigos</h1>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Total de Artigos</th>
                        <th>Total de Autores</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo count($artigos); ?></td>
                        <td><?php echo count(array_unique(array_column($artigos, 'autor'))); ?></td>
                        
                    </tr>
                </tbody>
                
            </table>
        </div>
        
        <div id="div-artigos">
            <table id="artigos" class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Resumo</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artigos as $artigo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($artigo['resumo']); ?></td>
                            <td id="autor"> <?php echo htmlspecialchars($artigo['autor']); ?></td>
                            <td id="acoes">
                                <a class="btn btn-success" href="<?php echo $artigo['arquivo']; ?>" download>Baixar</a>
                                <form action="lista_artigos.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $artigo['id']; ?>">
                                    <button class="btn btn-danger" type="submit" name="excluir">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 20px;">
            <!-- Botão Voltar -->
            <a href="index_artigo.php" class="btn-primary btn">Voltar</a>
        </div>
    </div>
</body>
</html>
