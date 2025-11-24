<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST, PUT, OPTIONS, GET, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once "conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$avatar = $_FILES["avatar"];
$id = $_POST["ID"];


$dadosNovos = [];


$sql = $conexao->prepare('UPDATE usuarios SET nome = :nome, email = :email, avatar = :avatar WHERE id = :id'
);


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

print_r($dadosAnteriores);

$type = explode(".", $avatar['name']);
$extensao = strtolower(end($type));
$arquivosPermitidos = ["jpeg", "png", "jpg", "webp"];
$caminhoNovaImagem = $pasta . "/" . $avatar['name'];
if(in_array($extensao, $arquivosPermitidos)){
    if(move_uploaded_file($avatar['tmp_name'], $caminhoNovaImagem)){
        echo "Imagem trocada";
    }
}

$sql->bindParam(":nome", $nome, PDO::PARAM_STR);
$sql->bindParam(":email", $email, PDO::PARAM_STR);
$sql->bindParam(":avatar", $avatar['name'], PDO::PARAM_STR);
$sql->bindParam(":id", $id, PDO::PARAM_STR);


$sql->execute();











