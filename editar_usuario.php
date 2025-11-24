<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST, PUT, OPTIONS, GET, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once "conexao.php";

$pdo = $conexao->prepare(
    `UPDATE usuarios
    SET nome = 
`);