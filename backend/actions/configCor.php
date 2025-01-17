<?php 

include_once("./backend/database/conexaoEvento.php");

    $sql = "SELECT CorPrimaria, CorSecundaria, CorTerciaria FROM eventos";
    $result = mysqli_query($conexao, $sql);

    $row = mysqli_fetch_assoc($result);
    
$corPrimaria = !empty($row['CorPrimaria']) ? $row['CorPrimaria'] : '#312682';
$corSecundaria = !empty($row['CorSecundaria']) ? $row['CorSecundaria'] : '#e20712';
$corTerciaria = !empty($row['CorTerciaria']) ? $row['CorTerciaria'] : '#0080b9';

echo("
<style>
:root {
    --primary-color: $corPrimaria;
    --secondary-color: $corSecundaria;
    --tertiary-color: $corTerciaria;
}
</style>");

?>
    

    
    
