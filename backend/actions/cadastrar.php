<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once("../database/conexaoEvento.php");

mysqli_query($conexao, 'DELETE FROM `eventos`');

$nome_evento = $_POST['nome-evento'];
$imagem = $_FILES['logo-evento'];
$corPrimaria = $_POST['corPrimaria'];
$corSecundaria = $_POST['corSecundaria'];
$corTerciaria = $_POST['corTerciaria'];
$sobre = trim($_POST['sobre-evento']);

$extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
$nomeImagem = 'img_logo' . '.' . $extensao;

// Caminho completo do arquivo
$caminhoImagem = 'imagens/' . $nomeImagem;
$caminhoLocal = '../../imagens/' . $nomeImagem;

// Move a imagem para o diretório de upload

    // Insere os dados no banco de dados
move_uploaded_file($imagem['tmp_name'], $caminhoLocal);

$sql = "INSERT INTO eventos (Titulo, Logo,CorPrimaria,CorSecundaria,CorTerciaria, Descricao) VALUES ('$nome_evento', '$caminhoImagem', '$corPrimaria', '$corSecundaria', '$corTerciaria', '$sobre')";
$result = mysqli_query($conexao, $sql);

$response = [];
if ($conexao->affected_rows > 0) {
    $response['status'] = 'success';
    $response['message'] = 'Usuário inscrito com sucesso!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Falha ao inscrever o usuário.';
}

echo json_encode($response);


?>