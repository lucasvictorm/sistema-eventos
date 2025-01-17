<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        main{
            max-width: 600px;
            margin: auto;
        }

        h1{
            text-align: center;
        }

        #div-cadastrar{
            text-align: end;
        }
        button{
            margin-top: 20px;
        }


        #btnMais{
            margin: 0;
            width: 20%;
        }

        .form-group{
            margin-bottom: 20px;
        }

        .lixeira{
            cursor: pointer;
            width: 100px;
            text-align: center;
        }

        #aviso-cadastrado{
            text-align: end;
            color: green;
            margin-top: 5px;
            margin-bottom: 20px;
            display: none;
        }
    </style>
  </head>

<body>
    <?php 
    
        include_once('./backend/database/conexaoEvento.php');

        $sql = "SELECT * FROM eventos";
        $resultado = mysqli_query($conexao, $sql);

        $resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $resultado = $resultado[0];
    ?>
    <main>

    <h1>Cadastro de Evento</h1>
    <form id="formulario" enctype="multipart/form-data">
        <!-- Nome do evento -->
        <div class="form-group">
            <label for="nome-evento">Nome do evento:</label>
            <input type="text" value="<?= htmlspecialchars_decode(htmlspecialchars($resultado['Titulo'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES)?>" id="nome-evento" name="nome-evento" class="form-control" placeholder="Digite o nome do evento" required>
        </div>

        <!-- Logo do evento -->
        <div class="form-group">
            <label for="logo-evento">Logo do evento:</label>
            <input type="file" id="logo-evento" name="logo-evento" class="form-control" accept="image/*">
        </div>

        <!-- Imagem de fundo -->
        <div class="form-group">
            <label for="imagem-fundo">Imagem de fundo:</label>
            <input type="file" id="imagem-fundo" name="imagem-fundo" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="imagem-fundo">Imagens da galeria</label>
            <input type="file" id="imagens-galeria" multiple name="imagens-galeria[]" class="form-control" accept="image/*">
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="corPrimaria">Cor primária</label>
                <input type="color" id="corPrimaria" value="<?= $resultado['CorPrimaria']?>" name="corPrimaria" placeholder="#ffffff" class="form-control">
            </div>
            <div class="col">
                <label for="corSecundaria">Cor secundária</label>
                <input type="color" id="corSecundaria" value="<?= $resultado['CorSecundaria']?>" name="corSecundaria" placeholder="#ffffff" class="form-control">
            </div>
            <div class="col">
                <label for="corTerciaria">Cor terciária</label>
                <input type="color" id="corTerciaria" value="<?= $resultado['CorTerciaria']?>" name="corTerciaria" placeholder="#ffffff" class="form-control">
            </div>
          </div>

        <!-- Sobre o evento -->
        <div class="form-group">
            <label for="sobre-evento">Sobre o evento:</label>
            <textarea id="sobre-evento" name="sobre-evento" class="form-control" rows="4" placeholder="Descreva o evento" ><?= $resultado['Descricao']?></textarea>
        </div>

        <!-- O que esperar -->
        <div class="form-group">
            <label for="o-que-esperar">O que esperar:</label>
            <textarea id="o-que-esperar" name="o-que-esperar" class="form-control" rows="4" placeholder="Descreva o que os participantes podem esperar" ><?= $resultado['Expectativa']?></textarea>
        </div>

        <!-- Data do evento -->
        <div class="form-group">
            <label for="data-evento">Data do evento:</label>
            <?php 
            
            $dataFormatada = DateTime::createFromFormat('Y-d-m', $resultado['DataInicio'])->format('Y-m-d');
            ?>
            
            <input type="date" id="data-evento" value="<?=$dataFormatada?>" name="data-evento" class="form-control" >
        </div>

        <div class="form-group">
            <label for="hora-evento">Hora do evento:</label>
            <?php
                // Formatar a hora para o formato HH:mm (remover os segundos)
                $horaFormatada = substr($resultado['Hora'], 0, 5);
                ?>
            <input type="time" id="hora-evento" value="<?= $horaFormatada?>" name="hora-evento" class="form-control" >
        </div>

        <!-- Inscrições -->
        <div class="form-group">
            <label for="taxa-inscricao">Taxa de inscrição (R$):</label>
            <input type="number" id="taxa-inscricao" value="<?= $resultado['Taxa']?>" name="taxa-inscricao" class="form-control" placeholder="Digite o valor da inscrição" step="0.01" min="0">
        </div>
        <!--
        <div class="row" >
            <label for="avisos">Avisos</label>
            <div class="input-group">
                
                <input type="text" id="avisos" name="avisos" placeholder="Escreva aqui seu aviso" class="form-control">
                <button onclick="adicionarAviso()" type="button" id="btnMais" class="btn btn-primary">+</button>
            </div>
           
            
        </div>

        <div id="avisos-container">
            Avisos adicionados pelo usuário 
            <table id="tabela-opcoes" class="table">
                
                <tbody id="lista-de-opcoes">
                  

                </tbody>

              </table>
        </div>

        -->
          
        

        <!-- Botão de envio -->
         <div id="div-cadastrar">
            <button type="submit" class="btn btn-success">Cadastrar Evento</button>
         </div>
        
        <p id="aviso-cadastrado">Evento cadastrado</p>
    </form>
</main>
</body>
<script src="gerenciador.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>