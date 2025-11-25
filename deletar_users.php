<?php

header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST, PUT, OPTIONS, GET, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once "conexao.php";

$id = $_POST['ID'];

$pdo = $conexao->prepare("DELETE FROM usuarios WHERE id = :id");


$stmt = $conexao->prepare("SELECT nome, email, avatar FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);

$dadosAnteriores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$imagem = $dadosAnteriores[0]['avatar'];
$pasta = "uploads";
$caminhoImagem = 'uploads/' . $imagem;

if(file_exists($caminhoImagem)){
    if(unlink($caminhoImagem)){
        echo "Imagem deletada";
    }
}

$pdo->execute([":id" => $id]);