<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/conexao.php';
    include_once '../class/formasrecebimentos.php';
    
    $database = new Database();
    $db = $database->conexao();
    
    $item = new FormaPgto($db);
    
    $data = json_decode(file_get_contents("php://input"));

    $item->formarecebimento_id             = $data->formarecebimento_id;
    $item->formarecebimento_descricao      = $data->formarecebimento_descricao;

    if($item->atualizarFormaRecebimento($ambiente_caixa_logado)){
        echo json_encode("Dados da Forma de Recebimento atualizados.");
    } else{
        echo json_encode("Dados do Forma de Recebimento não foram atualizados");
    }
?>