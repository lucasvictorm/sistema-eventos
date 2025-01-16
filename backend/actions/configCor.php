<?php 

include_once("./backend/database/conexaoEvento.php");

    $sql = "SELECT CorPrimaria, CorSecundaria, CorTerciaria FROM eventos";
    $result = mysqli_query($conexao, $sql);

    $row = mysqli_fetch_assoc($result);
    $corPrimaria = $row['CorPrimaria'] ?? '#000000';
    $corSecundaria = $row['CorSecundaria'] ?? '#FFFFFF';
    $corTerciaria = $row['CorTerciaria'] ?? '#CCCCCC';
    echo("
    <style>
    :root {
        --primary-color: $corPrimaria;
        --secondary-color: $corSecundaria;
        --tertiary-color: $corTerciaria;
    }
        
    </style>"
    
    )
?>
    

    
    
