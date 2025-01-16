<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferência Regional de Engenharia de Software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <?php  include_once('./backend/actions/configCor.php');?>
    <style>
        
      
        
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Orbitron:wght@400..900&display=swap');
        body {
        margin: 0;
        font-family: Arial, sans-serif;
        }

        #div-pai-header{
            position: fixed;
            top: 0;
            width: 100vw;
        }

        .site-header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            gap: 10px;
            background-color: white;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .titulo{
            color: var(--tertiary-color);
            font-family: "Orbitron", serif;
        }

        .logo {
            width: 100px;
        }

        .site-nav {
            background-color: var(--primary-color);
            padding: 20px 0;
            text-align: center;
        }

        #nav-lista{
            gap: 10px;
        }

        .nav-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--tertiary-color);
        }
        #separador{
            width: 3px;
            height: 60px;
            background-color: var(--secondary-color);
        }

        #inscricao{
            background-color: var(--secondary-color);
            border-radius: 10px;

            
        }

        #inscricao:hover{
            color: white;
        }

        @media (max-width: 768px) {
            .site-header {
                flex-direction: column;
                align-items: center;
            }

            .logo-container {
                justify-content: center;
            }

            .site-nav {
                text-align: left;
                padding: 10px;
            }

            .nav-list {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .nav-link {
                font-size: 1.2rem;
            }

            #separador{
                width: 100%;
                height: 3px;
                background-color: var(--secondary-color);
        }

        }
    </style>
    
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
                $logo = $logo['Logo'];

                echo("<img src='$logo' alt='Logo' class='logo'>");
            ?>
            
        </div>
        <div id="separador"></div>
        <div class="titulo" id="tituloCabecalho">
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
                <li><a href="./index.html" class="nav-link">Sobre o Evento</a></li>
              </li>
              <li class="nav-item">
                <li><a href="./cronograma.html" class="nav-link">Cronograma</a></li>
              </li>
              <li class="nav-item">
                <li><a href="./parceiros.html" class="nav-link">Parceiros</a></li>
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
