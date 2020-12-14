<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/conexao.php';
    include_once '../class/contapagar.php';
    
    $database = new Database();
    $db = $database->conexao();
    
    $item = new ContaPagar($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->contapagar_id = $data->contapagar_id;
    
    if($item->excluirContaPagar($ambiente_caixa_logado)){
        echo json_encode("Conta a Pagar excluída.");
    } else{
        echo json_encode("Conta a Pagar não foi excluída.");
    }
?>