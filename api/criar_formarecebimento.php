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

    $item = new FormaRecebimento($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->formarecebimento_descricao = $data->formarecebimento_descricao;
    
    if($item->criarFormaRecebimento($ambiente_caixa_logado)){
        echo 'Nova Forma de Recebimento criada com sucesso.';
    } else{
        echo 'Forma de Recebimento não pode ser criada.';
    }
?>