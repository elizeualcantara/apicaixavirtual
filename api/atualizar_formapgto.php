<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/conexao.php';
    include_once '../class/formaspgtos.php';
    
    $database = new Database();
    $db = $database->conexao();
    
    $item = new FormaPgto($db);
    
    $data = json_decode(file_get_contents("php://input"));

    $item->formapgto_id             = $data->formapgto_id;
    $item->formapgto_descricao      = $data->formapgto_descricao;

    if($item->atualizarFormaPgto($ambiente_caixa_logado)){
        echo json_encode("Dados da Forma de Pagamento atualizados.");
    } else{
        echo json_encode("Dados do Forma de Pagamento não foram atualizados");
    }
?>