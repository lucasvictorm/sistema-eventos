<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <link rel="stylesheet" href="style.css">

    
    
    <title>Evento</title>
</head>
<body>
    <div id="container-geral">
    <!--div onde será carregado o cabeçalho remotamente-->
    <!--<div id="header-div"></div>-->

    <?php 
    include_once ('./cabecalho.php');
    include_once ('./backend/actions/configCor.php');

    ?>

        <?php 
            $imagemFundo = mysqli_query($conexao, 'select ImagemFundo from eventos');
            $imagemFundo = mysqli_fetch_assoc($imagemFundo);
            $imagemFundo = $imagemFundo['ImagemFundo'];

            echo("<style>
                .parallax {
                    background-image: url('$imagemFundo');
                }
            </style>");

    
        ?>

    <!--título com efeito parallax de fundo-->
    <div class="parallax"> <?php
             $titulo = mysqli_query($conexao, 'select Titulo from eventos');
                $titulo = mysqli_fetch_assoc($titulo);
                $titulo = $titulo['Titulo'];

                echo("<h1>$titulo</h1>");
            ?></div>
    <section class="conteudo-principal">
        <h2 class="subtitulo" id="sobre">Sobre o evento</h2>

        <?php 

                $descricao = mysqli_query($conexao, 'select Descricao from eventos');
                $descricao = mysqli_fetch_assoc($descricao);
                $descricao = $descricao['Descricao'];

                echo("<p>" . nl2br($descricao) . "</p>");
               
        
        ?>
        <!--
        <p>A Conferência regional de engenharia de software é mais do que um encontro acadêmico: é uma celebração da ciência, da tecnologia e das mentes que moldam o futuro. O Campus V da UEPA será o palco de um ambiente vibrante de troca de ideias, aprendizado e networking.</p>

        <p>
            Reuniremos pesquisadores renomados, líderes do setor e jovens talentos para explorar temas emergentes como inteligência artificial, sustentabilidade, biotecnologia.
        </p>-->

        <div class="linha-destaque"></div>
        <div id="div-imagens">
            <?php 
                $galeria = mysqli_query($conexao, 'select caminho from galeria');
                $galeria = mysqli_fetch_all($galeria, MYSQLI_ASSOC);
                foreach ($galeria as $imagem) {
                    echo("<a href='{$imagem['caminho']}' data-fancybox>
                    <img src='{$imagem['caminho']}'>
                </a>");
                }
            
            ?>

            <!--
            <a href="imagens/galeria/auditorio.jpg" data-fancybox>
                <img src="imagens/galeria/auditorio.jpg">
            </a>
            
            <a href="imagens/galeria/bancada.jpg" data-fancybox>
                <img src="imagens/galeria/bancada.jpg" alt="Bancada">
            </a>

            <a href="imagens/galeria/ccnt.jpg" data-fancybox>
                <img src="imagens/galeria/ccnt.jpg" alt="CCNT">
            </a>

            <a href="imagens/galeria/palestra.jpg" data-fancybox>
                <img src="imagens/galeria/palestra.jpg" alt="Palestra">
            </a>
            -->
           
            

        </div>

        <h2 class="subtitulo">O que esperar?</h2>

        <?php 

                $expectativa = mysqli_query($conexao, 'select Expectativa from eventos');
                $expectativa = mysqli_fetch_assoc($expectativa);
                $expectativa = $expectativa['Expectativa'];

                echo("<p>" . nl2br($expectativa) . "</p>");
        ?>
        <!--
        <ul>
            <li>
                <p>
                Palestrantes de renome mundial: Especialistas que lideram avanços em tecnologia  
                </p>
                
            </li>

            <li>
                <p>
                Workshops interativos: Aprenda na prática com atividades projetadas para expandir seu conhecimento. 
                </p>
                
            </li>

            <li>
                <p>
                    Painéis de discussão: Debates sobre os desafios e as oportunidades do cenário científico atual.
                </p>
                
            </li>

            <li>
                <p>Networking: Oportunidades para conectar-se com pesquisadores, empresas e instituições de destaque.</p>
                
            </li>
        </ul>
        -->

        <h2 class="subtitulo">Data e inscrições</h2>

        <?php
            // Data atual
            
            $dados = mysqli_query($conexao, 'select DataInicio, Hora, Taxa from eventos');
            $dados = mysqli_fetch_assoc($dados);
            $data = $dados['DataInicio'];

            $hora = $dados['Hora'];
            $taxa = $dados['Taxa'];

            $hora = date("H:i", strtotime($hora));

            // Separando o dia e o mês
            $dia = date("d", strtotime($data)); // Extrai o dia
            $mesNumerico = date("m", strtotime($data)); // Extrai o mês numérico

            // Convertendo o mês numérico para o nome do mês
            $mesPorExtenso = [
                "01" => "Janeiro",
                "02" => "Fevereiro",
                "03" => "Março",
                "04" => "Abril",
                "05" => "Maio",
                "06" => "Junho",
                "07" => "Julho",
                "08" => "Agosto",
                "09" => "Setembro",
                "10" => "Outubro",
                "11" => "Novembro",
                "12" => "Dezembro",
            ];

            $nomeMes = $mesPorExtenso[$mesNumerico];

             // Exemplo de valor vindo do banco

            // Formata para o padrão brasileiro (R$ 26,33)
            $precoFormatado = "R$ " . number_format($taxa, 2, ',', '.');

             
            

            // Exibindo o resultado
        echo(" <p>O evento ocorrerá no dia <span class='destaque'>$dia de $nomeMes, às $hora horas</span> </p>");

        echo("<p>Inscrição por apenas R$ $precoFormatado</p>");
            
        ?>
        
        
        <p>Você pode se inscrever <a href="./inscricao.html" class="destaque">clicando aqui</a></p>
        
        <!--Mapa incorporado-->
        <h2 class="subtitulo-centralizado">Local</h2>
        <div id="div-mapa"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d957.1200821480579!2d-48.45199446827701!3d-1.4344599205879636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a48d2aeb3e38c9%3A0x4620051ef0c9d6d!2sCampus%20V%20-%20Centro%20de%20Ci%C3%AAncias%20Naturais%20e%20Tecnologia!5e0!3m2!1spt-BR!2sbr!4v1736967569726!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </section>


    

    <section>
        <div class="div-borda-cinza">
            <h2 class="subtitulo-azul">Realização</h2>
        </div>
        <div id="logo-uepa">
            <img src="imagens/LogoUepa.png" alt="Logo da UEPA">
        </div>
    </section>

    <!--div onde será carregado o rodapé remotamente-->
    <div id="footer-div"></div>

</div>
</body>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script>
    Fancybox.bind("[data-fancybox]", {
    // Your custom options
    });
  
    

    //carrega o cabeçalho remotamente
    

    //carrega o rodapé remotamente
    fetch('rodape.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-div').innerHTML = data;
      });

      
</script>
</html>
