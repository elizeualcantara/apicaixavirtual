<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/conexao.php';
    include_once '../class/contapagar.php';

    $database = new Database();
    $db = $database->conexao();

    $items = new ContaPagar($db);

    $stmt = $items->listarContaPagar($ambiente_caixa_logado);
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $dados_arr = array();
        $dados_arr["body"] = array();
        $dados_arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            "contapagar_id" =>  $contapagar_id,
            "contapagar_formapgto_id" => $contapagar_formapgto_id,
            "contapagar_conta_id" => $contapagar_conta_id,
            "contapagar_categoria_id" => $contapagar_categoria_id,
            "contapagar_caixa_id" => $contapagar_caixa_id,
            "contapagar_nome_credor" => $contapagar_nome_credor,
            "contapagar_numero_duplicata" => $contapagar_numero_duplicata,
            "contapagar_numero_documento" => $contapagar_numero_documento,
            "contapagar_data_emissao" => $contapagar_data_emissao,
            "contapagar_data_vencimento" => $contapagar_data_vencimento,
            "contapagar_data_pagamento" => $contapagar_data_pagamento,
            "contapagar_valor_duplicata" => $contapagar_valor_duplicata,
            "contapagar_valor_total" => $contapagar_valor_total,
            "contapagar_descricao" => $contapagar_descricao,
            "contapagar_nome_banco" => $contapagar_nome_banco,
            "contapagar_numero_agencia" => $contapagar_numero_agencia,
            "contapagar_numero_conta" => $contapagar_numero_conta,
            "contapagar_data_lancamento" => $contapagar_data_lancamento,
            "contapagar_numero_nota_fiscal" => $contapagar_numero_nota_fiscal,
            "contapagar_numero_parcela" => $contapagar_numero_parcela,
            "contapagar_nosso_numero" => $contapagar_nosso_numero,
            "contapagar_flag_cancelada" => $contapagar_flag_cancelada,
            "contapagar_flag_estorno_devolucao" => $contapagar_flag_estorno_devolucao
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