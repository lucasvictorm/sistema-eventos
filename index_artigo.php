<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Submeter Artigo</title>
   
    
</head>
<body>
<?php 
        include_once('cabecalho.php');
        
        ?>
    <div class="container">
        
        <h1>Sistema de Submissão de Artigos</h1>
        <form id="submeterArtigoForm" enctype="multipart/form-data" class="form">
        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
    </div>
    
    <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
    </div>
    
    <div class="form-group">
        <label for="nome">Nome do Autor</label>
        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do Autor" required>
    </div>
    
    <div class="form-group">
        <label for="titulo">Título do Artigo</label>
        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título do Artigo" required>
    </div>
    
    <div class="form-group">
        <label for="resumo">Resumo do Artigo</label>
        <textarea name="resumo" id="resumo" class="form-control" placeholder="Resumo do Artigo" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="arquivo">Arquivo</label>
        <input type="file" name="arquivo" id="arquivo" class="form-control" accept=".pdf,.doc,.docx" required>
    </div>
            <p id="status-submissao"></p>
            <button type="submit" class="btn btn-primary">Submeter Artigo</button>
        </form>
        <div class="links">
            <div class="btn-group">
                <a href="login_adm_artigo.php" class="btn btn-primary">Entrar como Administrador</a>
                <a href="login_usuario_artigo.php" class="btn btn-success">Editar/Excluir Submissão</a>
            </div>
            
        </div>
        
    </div>
    <div id="footer-div"></div>
    
</body>
<script>
    document.getElementById('submeterArtigoForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Previne o envio tradicional do formulário
    
    const formData = new FormData(this);  // Cria o FormData com os dados do formulário

    // Envia os dados via fetch para o arquivo PHP
    fetch('submeter_artigo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // A resposta do servidor
    .then(data => {
        let status = document.getElementById('status-submissao');
        if(data.error) {
           
            status.style.color = 'red';
            status.innerText = 'Senha inválida para este email';
            
            
        }else if(data.success){
            status.style.color = 'green';
            status.innerText = 'Artigo submetido com sucesso';
        }
        // Exibe o retorno do servidor (sucesso ou erro)
       
        // Pode adicionar uma lógica para limpar o formulário ou redirecionar após o sucesso
    })
    .catch(error => {
        console.error('Erro ao submeter o artigo:', error);
        alert('Erro ao submeter o artigo!');
    });
});

    fetch('rodape.html')
      .then(response => response.text())
      .then(data => {
        console.log(document.getElementById('footer-div'))
        document.getElementById('footer-div').innerHTML = data;
        
      });
</script>
</html>

        
