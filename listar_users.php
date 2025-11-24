<?php
//Permite o acesso do fetch sem o impedimento do CORS
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


require_once "conexao.php";

$dados = [];

$pdo = $conexao->query("SELECT * FROM usuarios");
$dados = $pdo->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($dados, JSON_PRETTY_PRINT);


