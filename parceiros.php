<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parceiros</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #parceiros{
            height: 100vh;
            margin-top: 240px;

        }

        @media (max-width: 768px) {
            #parceiros{
                margin-top: 300px;
            }
        }
    </style>
</head>

<body>
    
    <!--div onde será carregado o cabeçalho remotamente-->
    <div id="header-div"><?php 
        include_once ('./cabecalho.php');
    ?></div>
    
    <!--Bloco onde ficam os parceiros-->
    <section id="parceiros">
        <!--Subtitulo em uma div que define uma borda cinza-->
        <div class="div-borda-cinza">
            <h2 class="subtitulo-azul">Parceiros</h2>
        </div>
        <!--div individual do apoiador-->
        <div class="div-apoiador div-borda-cinza">
            <div class="apoiador-logo">
                <img src="imagens/Meta-Logo.png" alt="Logo Meta">
            </div>
            <div class="textos">
                <h3>Meta</h3>
                <p>A Meta, fundada por Mark Zuckerberg, é a empresa por trás de Facebook, Instagram, WhatsApp e Messenger. Com inovação constante, a Meta conecta o mundo de novas maneiras.</p>
            </div>
        </div>

        <div class="div-apoiador div-borda-cinza">
            <div id="starlink-logo" class="apoiador-logo">
                <img src="imagens/starlink-logo.png" alt="Logo Meta">
            </div>
            <div class="textos">
                <h3>Starlink</h3>
                <p>A Starlink, da SpaceX, oferece internet de alta velocidade via satélite para qualquer lugar do mundo. Ideal para áreas remotas, garante baixa latência e conexão estável.</p>
            </div>
        </div>

        <div class="div-apoiador">
            <div class="apoiador-logo">
                <img src="imagens/google-logo.png" alt="Logo Google">
            </div>
            <div class="textos">
                <h3>Google</h3>
                <p>O Google é líder em inovação tecnológica, oferecendo pesquisa online, Gmail, Google Maps, YouTube e muito mais. Com uma missão de organizar as informações do mundo, o Google facilita sua vida diária.</p>
                
                
            </div>
        </div>
        
    </section>
    <div id="footer-div"></div>
</body>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
    

    //carrega o rodapé remotamente
    fetch('rodape.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-div').innerHTML = data;
      });

</script>
</html>