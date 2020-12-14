<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/conexao.php';
    include_once '../class/categorias.php';
    
    $database = new Database();
    $db = $database->conexao();
    
    $item = new Categoria($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->categoria_id = $data->categoria_id;
    $item->categoria_movimentacao = $data->categoria_movimentacao;
    $item->categoria_flag_entrada_saida = $data->categoria_flag_entrada_saida;
    $item->categoria_flag_atualiza_saldo = $data->categoria_flag_atualiza_saldo;
    $item->categoria_flag_ativo = $data->categoria_flag_ativo;

    if($item->atualizarCategoria()){
        echo json_encode("Dados da Categoria atualizados.");
    } else{
        echo json_encode("Dados da Categoria não foram atualizados");
    }
?>