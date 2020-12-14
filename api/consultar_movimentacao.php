<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/movimentacao.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new Movimentacao($db);

    $item->movimentacao_id = isset($_GET['movimentacao_id']) ? $_GET['movimentacao_id'] : die();
  
    $item->consultaMovimentacao($ambiente_caixa_logado);

    if($item->movimentacao_id != null){

        $dados_arr = array(
            "movimentacao_id"                 => $item->movimentacao_id,
            "movimentacao_contareceber_id"    => $item->movimentacao_contareceber_id,
            "movimentacao_contapagar_id"      => $item->movimentacao_contapagar_id,
            "movimentacao_conta_id"           => $item->movimentacao_conta_id,
            "movimentacao_caixa_id"            => $item->movimentacao_caixa_id,
            "movimentacao_data_lancamento"    => $item->movimentacao_data_lancamento,
            "movimentacao_valor_lancamento"   => $item->movimentacao_valor_lancamento,
            "movimentacao_referente"          => $item->movimentacao_referente
        );
      
        http_response_code(200);
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }
      
    else{
        http_response_code(404);
        echo json_encode("Movimentacao nao encontrada.");
    }
?>