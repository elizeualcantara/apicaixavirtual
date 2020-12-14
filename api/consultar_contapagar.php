<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/contapagar.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new ContaPagar($db);

    $item->contapagar_id = isset($_GET['contapagar_id']) ? $_GET['contapagar_id'] : die();
  
    $item->consultaContaPagar($ambiente_caixa_logado);

    if($item->contapagar_id != null){

        $dados_arr = array(
            "contapagar_id" =>  $item->contapagar_id,
            "contapagar_formapgto_id" => $item->contapagar_formapgto_id,
            "contapagar_conta_id" => $item->contapagar_conta_id,
            "contapagar_categoria_id" => $item->contapagar_categoria_id,
            "contapagar_caixa_id" => $item->contapagar_caixa_id,
            "contapagar_nome_credor" => $item->contapagar_nome_credor,
            "contapagar_numero_duplicata" => $item->contapagar_numero_duplicata,
            "contapagar_numero_documento" => $item->contapagar_numero_documento,
            "contapagar_data_emissao" => $item->contapagar_data_emissao,
            "contapagar_data_vencimento" => $item->contapagar_data_vencimento,
            "contapagar_data_pagamento" => $item->contapagar_data_pagamento,
            "contapagar_valor_duplicata" => $item->contapagar_valor_duplicata,
            "contapagar_valor_total" => $item->contapagar_valor_total,
            "contapagar_descricao" => $item->contapagar_descricao,
            "contapagar_nome_banco" => $item->contapagar_nome_banco,
            "contapagar_numero_agencia" => $item->contapagar_numero_agencia,
            "contapagar_numero_conta" => $item->contapagar_numero_conta,
            "contapagar_data_lancamento" => $item->contapagar_data_lancamento,
            "contapagar_numero_nota_fiscal" => $item->contapagar_numero_nota_fiscal,
            "contapagar_numero_parcela" => $item->contapagar_numero_parcela,
            "contapagar_nosso_numero" => $item->contapagar_nosso_numero
        );
      
        http_response_code(200);
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }
      
    else{
        http_response_code(404);
        echo json_encode("Conta a Pagar nao encontrada.");
    }
?>