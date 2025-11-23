<?php
//Permite o acesso do fetch sem o impedimento do CORS
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");



require_once('conexao.php');

$file = $_FILES['avatar'];

$fileUp = explode(".", $file['name']);
$dir = 'uploads/';

$arquivosPermitidos = ["jpeg", "png", "jpg", "webp"];

if (in_array($fileUp[sizeof($fileUp) - 1], $arquivosPermitidos)) {

   if (file_exists($dir)) {
      move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/" . $file['name']);
   }
   
      

   
}
$files = $_FILES['avatar']['name'];
$email = $_POST['email'];
$nome = $_POST['nome'];
$sql = "INSERT INTO usuarios (nome, email, avatar) VALUES (?, ?, ?)";


$pdo = $conexao->prepare($sql);

$pdo->execute([$nome, $email, $files]);







// if($_SERVER["REQUEST_METHOD"] === "GET"){



//         $arquivo = $_FILES["avatar"];
//         $arquivoNovo = explode('.', $arquivo['name']);



//         $uploadFile = 'C:\xampp\htdocs\cadastro_wellington\Cadastro_Wellington-main\uploads\ ';
//         $uploadFile = trim($uploadFile);
//         if(in_array($arquivoNovo[sizeof($arquivoNovo) - 1], $arquivosPermitidos)){
//          if($_SERVER["REQUEST_METHOD"] === "GET"){
//             $uploadFile = $uploadFile . " " . $arquivo['name'];
//             $uploadFile2 = str_replace(" ", "", $uploadFile);

//             echo json_encode($uploadFile2);

//          }
//             if(file_exists($uploadFile)){
//                $uploadFile = $uploadFile . " " . $arquivo['name'];
//                $uploadFile2 = str_replace(" ", "", $uploadFile);

//                move_uploaded_file($arquivo['tmp_name'], $uploadFile2);

//             }
//          else{
//                die("Preencher nome e email");            
//             };
//          $sql = "INSERT INTO usuarios (nome, email, avatar) VALUES (?, ?, ?)";
//          $conn = $conexao->prepare($sql);
//          $conn->execute([$nome, $email, $arquivo["tmp_name"]]); 
//          header("location: C:/xampp/htdocs/cadastro_wellington/Cadastro_Wellington-main/index.html");
//          exit();
//         }else{
//             die("Não pode");

//     }



// }




?>