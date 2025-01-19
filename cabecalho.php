<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferência Regional de Engenharia de Software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./cabecalho.css">
    <?php  include_once('./backend/actions/configCor.php');?>
    
</head>
<body>

<?php 
    include_once('./backend/database/conexaoEvento.php');
   
?>
    <div id="div-pai-header">

    
    <header class="site-header">
        <div class="logo-container">
            <?php 
                $logo = mysqli_query($conexao, 'select Logo from eventos');
                $logo = mysqli_fetch_assoc($logo);
                if($logo['Logo'] == 'imagens/img_logo.'){
                    $logo = "./imagens/default-logo.jpg";
                }else{
                    $logo = $logo['Logo'];
                }

                echo("<img src='$logo' alt='Logo' class='logo'>");
            ?>
            
        </div>
        <div id="separador"></div>
        <div id="titulo-cabecalho" id="tituloCabecalho">
            <?php
             $titulo = mysqli_query($conexao, 'select Titulo from eventos');
                $titulo = mysqli_fetch_assoc($titulo);
                $titulo = $titulo['Titulo'];

                echo("<h1>$titulo</h1>");
            ?>
            
        </div>
    </header>
    <div>
        
    </div>
    <nav id="navContainer" class="site-nav navbar-dark navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" id="navegador">
            <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav" id="nav-lista">
              <li class="nav-item">
                <li><a href="./index.php" class="nav-link">Sobre o Evento</a></li>
              </li>
              <li class="nav-item">
                <li><a href="./cronograma.php" class="nav-link">Cronograma</a></li>
              </li>
              <li class="nav-item">
                <li><a href="./parceiros.php" class="nav-link">Parceiros</a></li>
              </li>
              <li class="nav-item">
                <li><a href="./index_artigo.php" class="nav-link">Submeter artigo</a></li>
              </li>
              <li class="nav-item">
                <li><a href="./inscricao.html" id="inscricao" class="nav-link">Inscrição</a></li>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>

      
   
          
        <!--
         
        <ul class="nav-list">
            <li><a href="./index.html" class="nav-link">Sobre o Evento</a></li>
            <li><a href="./cronograma.html" class="nav-link">Cronograma</a></li>
            <li><a href="./parceiros.html" class="nav-link">Parceiros</a></li>

            <li><a href="./inscricao.html" class="nav-link">Inscrição</a></li>
            
        </ul>
         -->
    </nav>
    </div>
</body>

<script>
   
        //document.getElementById('tituloCabecalho').innerText = 
</script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


</html>
