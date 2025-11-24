<?php
// deletar_usuario.php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST, DELETE");
header("Content-Type: application/json");

require_once "conexao.php";

// Recebe o ID. Se estiver usando DELETE, use file_get_contents('php://input').
// Como o JS acima usa POST, usamos $_POST:
$id = $_POST["ID"] ?? null;

if (empty($id)) {
    echo json_encode(["status" => "error", "message" => "ID não fornecido."]);
    exit;
}

try {
    // 1. Opcional: Busca o avatar antigo para deletar o arquivo físico
    $stmt = $conexao->prepare("SELECT avatar FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $dadosAnteriores = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dadosAnteriores && $dadosAnteriores['avatar']) {
        $caminhoImagem = "uploads/" . $dadosAnteriores['avatar'];
        if (file_exists($caminhoImagem)) {
            @unlink($caminhoImagem); // Deleta o arquivo
        }
    }

    // 2. Deleta o registro do banco de dados
    $sql = $conexao->prepare("DELETE FROM usuarios WHERE id = :id");
    $sql->bindParam(":id", $id, PDO::PARAM_INT);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Usuário deletado com sucesso."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Nenhum usuário encontrado com este ID."]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erro no banco de dados: " . $e->getMessage()]);
}
?>