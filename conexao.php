<?php

$host = 'localhost';
$db = 'cadastro_usuarios';
$user = 'root';
$pass = '';

try{
$conexao = new PDO("mysql:dbname=".$db. "; host=". $host, $user, $pass);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $err){
    echo "Erro de conexão com o banco de dados: " . $err->getMessage();

}



?>
