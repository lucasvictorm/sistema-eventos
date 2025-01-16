<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $banco = "gerenciamentoeventos";
    $conexao = mysqli_connect($host, $user, $pass, $banco);
    if (!$conexao) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(!$conexao){
        die(mysqli_connect_error());
    }
?>