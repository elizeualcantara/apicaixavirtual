<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/conexao.php';
    include_once '../class/contareceber.php';

    $database = new Database();
    $db = $database->conexao();

    $items = new ContaReceber($db);

    $stmt = $items->listarContaReceber($ambiente_caixa_logado);
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $dados_arr = array();
        $dados_arr["body"] = array();
        $dados_arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            "contareceber_id" =>  $contareceber_id,
            "contareceber_formarecebimento_id" => $contareceber_formarecebimento_id,
            "contareceber_conta_id" => $contareceber_conta_id,
            "contareceber_categoria_id" => $contareceber_categoria_id,
            "contareceber_caixa_id" => $contareceber_caixa_id,
            "contareceber_nome_cliente" => $contareceber_nome_cliente,
            "contareceber_numero_duplicata" => $contareceber_numero_duplicata,
            "contareceber_numero_documento" => $contareceber_numero_documento,
            "contareceber_data_emissao" => $contareceber_data_emissao,
            "contareceber_data_vencimento" => $contareceber_data_vencimento,
            "contareceber_data_recebimento" => $contareceber_data_recebimento,
            "contareceber_valor_duplicata" => $contareceber_valor_duplicata,
            "contareceber_valor_total" => $contareceber_valor_total,
            "contareceber_descricao" => $contareceber_descricao,
            "contareceber_data_lancamento" => $contareceber_data_lancamento,
            "contareceber_numero_nota_fiscal" => $contareceber_numero_nota_fiscal,
            "contareceber_numero_parcela" => $contareceber_numero_parcela,
            "contareceber_nosso_numero" => $contareceber_nosso_numero,
            "contareceber_flag_cancelada" => $contareceber_flag_cancelada,
            "contareceber_flag_estorno_devolucao" => $contareceber_flag_estorno_devolucao
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