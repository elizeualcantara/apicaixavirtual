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

    $item->categoria_movimentacao = $data->categoria_movimentacao;
    $item->categoria_flag_entrada_saida = $data->categoria_flag_entrada_saida;
    
    if($item->criarCategoria()){
        echo 'Categoria criada com sucesso.';
    } else{
        echo 'Categoria não pode ser criada.';
    }
?>