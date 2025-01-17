<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once("../database/conexaoEvento.php");

mysqli_query($conexao, 'DELETE FROM `eventos`');
mysqli_query($conexao, 'DELETE FROM `galeria`');
mysqli_query($conexao, 'DELETE FROM `avisos`');

$nome_evento = htmlspecialchars($_POST['nome-evento'], ENT_QUOTES, 'UTF-8');
$imagem = $_FILES['logo-evento'];
$corPrimaria = $_POST['corPrimaria'];
$corSecundaria = $_POST['corSecundaria'];
$corTerciaria = $_POST['corTerciaria'];
$sobre = trim($_POST['sobre-evento']);
$oqEsperar = trim($_POST['o-que-esperar']);
$data = $_POST['data-evento'];
$hora = $_POST['hora-evento'];
$taxa = $_POST['taxa-inscricao'];
$imagem_fundo = $_FILES['imagem-fundo'];
$imagens_galeria = $_FILES['imagens-galeria'];
$dataParaBanco = date('d-m'); // Retorna "MM-DD"




if (isset($_POST['avisos']) && !empty($_POST['avisos'])) {
    
    $avisos = $_POST['avisos']; // Array de avisos enviados

    // Preparar a consulta de inserção
    

    // Iterar sobre o array de avisos e inserir no banco
    foreach ($avisos as $aviso) {
        $nome = $aviso['nome']; // Evitar SQL Injection
        $data = $aviso['data'];

            // Inserir no banco de dados
            $sql = "INSERT INTO avisos (nome, data) VALUES ('$nome', STR_TO_DATE('$data', '%d/%m/%Y'))";
        // Bind do valor do aviso
        
    /*
        $sql = "INSERT INTO avisos (nome) VALUES ('$aviso')";
        echo($sql);*/
        // Executar a consulta
        try {
            mysqli_query($conexao, $sql);
        } catch (PDOException $e) {
            // Se ocorrer um erro na inserção de um aviso, você pode continuar ou parar, dependendo do que deseja
            echo "Erro ao inserir o aviso: " . $e->getMessage();
        }
    }

    // Retornar resposta ao frontend
    echo json_encode(['status' => 'success', 'message' => 'Avisos cadastrados com sucesso.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nenhum aviso enviado.']);
}





if (isset($_FILES['imagens-galeria']) && !empty($_FILES['imagens-galeria']['name'][0])) {
    // Diretório onde as imagens serão armazenadas
    $diretorio_destino = '../../imagens/galeria/';

    // Garantir que o diretório de destino existe, se não, criá-lo
    if (!is_dir($diretorio_destino)) {
        mkdir($diretorio_destino, 0777, true);
    }

    // Contar o número de imagens enviadas
    $total_imagens = count($_FILES['imagens-galeria']['name']);

    // Loop para processar cada imagem
    for ($i = 0; $i < $total_imagens; $i++) {
        // Obter informações do arquivo
        $nome_arquivo = $_FILES['imagens-galeria']['name'][$i];
        $tmp_arquivo = $_FILES['imagens-galeria']['tmp_name'][$i];
        $erro = $_FILES['imagens-galeria']['error'][$i];
        $tamanho = $_FILES['imagens-galeria']['size'][$i];
        $extensaoGaleria = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

        // Verificar se o upload foi bem-sucedido
        if ($erro === UPLOAD_ERR_OK) {
            // Gerar um nome único para o arquivo (evitar sobrescrita)
            $nome_unico = "img_fundo_$i" . '.' . $extensaoGaleria;

            // Caminho completo de destino
            $caminho_destino = $diretorio_destino . $nome_unico;
            $caminhoSql = './imagens/galeria/' . $nome_unico;


            // Mover o arquivo para o diretório de destino
            if (move_uploaded_file($tmp_arquivo, $caminho_destino)) {

                $sql = "insert into galeria (caminho) values ('$caminhoSql')";
                mysqli_query($conexao, $sql);
                echo "Imagem {$nome_arquivo} carregada com sucesso!<br>";
            } else {
                echo "Erro ao carregar a imagem {$nome_arquivo}.<br>";
            }
        } else {
            echo "Erro no upload do arquivo {$nome_arquivo}. Código de erro: {$erro}.<br>";
        }
    }
} else {
    echo "Nenhuma imagem foi enviada.";
}


$extensaoFundo = pathinfo($imagem_fundo['name'], PATHINFO_EXTENSION);
$nomeImagemFundo = 'img_background' . '.' . $extensaoFundo;

// Caminho completo do arquivo
$caminhoImagemFundo = 'imagens/' . $nomeImagemFundo;
$caminhoLocalFundo = '../../imagens/' . $nomeImagemFundo;

// Move a imagem para o diretório de upload

move_uploaded_file($imagem_fundo['tmp_name'], $caminhoLocalFundo);



$extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
$nomeImagem = 'img_logo' . '.' . $extensao;

// Caminho completo do arquivo
$caminhoImagem = 'imagens/' . $nomeImagem;
$caminhoLocal = '../../imagens/' . $nomeImagem;

// Move a imagem para o diretório de upload

    // Insere os dados no banco de dados
move_uploaded_file($imagem['tmp_name'], $caminhoLocal);

$sql = "INSERT INTO eventos (Titulo, Logo,CorPrimaria,CorSecundaria,CorTerciaria, Descricao, Expectativa, DataInicio, Hora, Taxa, ImagemFundo) VALUES ('$nome_evento', '$caminhoImagem', '$corPrimaria', '$corSecundaria', '$corTerciaria', '$sobre', '$oqEsperar', '$data', '$hora', '$taxa', '$caminhoImagemFundo')";
echo json_encode($sql);

$result = mysqli_query($conexao, $sql);

$response = [];
if ($conexao->affected_rows > 0) {
    $response['status'] = 'success';
    $response['message'] = 'Usuário inscrito com sucesso!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Falha ao inscrever o usuário.';
}

echo json_encode($sql);


?>