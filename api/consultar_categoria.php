<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/categorias.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new Categoria($db);

    $item->categoria_id = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : die();
  
    $item->consultaCategoria();

    if($item->categoria_id != null){

        $dados_arr = array(
            "categoria_id" =>  $item->categoria_id,
            "categoria_movimentacao" => $item->categoria_movimentacao,
            "categoria_flag_entrada_saida" => $item->categoria_flag_entrada_saida,
            "categoria_flag_atualiza_saldo" => $item->categoria_flag_atualiza_saldo,
            "categoria_flag_ativo" => $item->categoria_flag_ativo
        );
      
        http_response_code(200);
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }
      
    else{
        http_response_code(404);
        echo json_encode("Categoria nao encontrada.");
    }
?>