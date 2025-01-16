<?php 

    include_once("../database/conexao.php");

    $sql = "SELECT * FROM eventos";
    $result = mysqli_query($conexao, $sql);

    $palestras = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $palestras[] = $row;
        }
    } else {
        echo "0 results";
    }

    echo json_encode($palestras);

    mysqli_close($conexao);


?>