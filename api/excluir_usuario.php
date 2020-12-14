<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/conexao.php';
    include_once '../class/usuarios.php';
    
    $database = new Database();
    $db = $database->conexao();
    
    $item = new Usuario($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->usuario_id = $data->usuario_id;
    
    if($item->excluirUsuario($ambiente_caixa_logado)){
        echo json_encode("Usuário deletado.");
    } else{
        echo json_encode("Usuário não foi deletado.");
    }
?>