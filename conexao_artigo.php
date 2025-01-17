<?php
$host = 'localhost';
$dbname = 'submissao_artigos';
$user = 'root'; // Usuário padrão do XAMPP
$password = ''; // Senha padrão é vazia

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
