<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/conexao.php';
    include_once '../class/movimentacao.php';

    $database = new Database();
    $db = $database->conexao();

    $items = new Movimentacao($db);

    $stmt = $items->listarMovimentacao($ambiente_caixa_logado);
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $dados_arr = array();
        $dados_arr["body"] = array();
        $dados_arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            "movimentacao_id" =>  $movimentacao_id,
            "movimentacao_contareceber_id" => $movimentacao_contareceber_id,
            "movimentacao_contapagar_id" => $movimentacao_contapagar_id,
            "movimentacao_conta_id" => $movimentacao_conta_id,
            "movimentacao_data_lancamento" => $movimentacao_data_lancamento,
            "movimentacao_valor_lancamento" => $movimentacao_valor_lancamento,
            "movimentacao_referente" => $movimentacao_referente
            );

            array_push($dados_arr["body"], $e);
        }
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Dados não encontrados.")
        );
    }
?>