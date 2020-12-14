<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/contareceber.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new ContaReceber($db);

    $item->contareceber_id = isset($_GET['contareceber_id']) ? $_GET['contareceber_id'] : die();
  
    $item->consultaContaReceber($ambiente_caixa_logado);

    if($item->contareceber_id != null){

        $dados_arr = array(
            "contareceber_id" =>  $item->contareceber_id,
            "contareceber_formarecebimento_id" => $item->contareceber_formarecebimento_id,
            "contareceber_conta_id" => $item->contareceber_conta_id,
            "contareceber_categoria_id" => $item->contareceber_categoria_id,
            "contareceber_caixa_id" => $item->contareceber_caixa_id,
            "contareceber_nome_cliente" => $item->contareceber_nome_cliente,
            "contareceber_numero_duplicata" => $item->contareceber_numero_duplicata,
            "contareceber_numero_documento" => $item->contareceber_numero_documento,
            "contareceber_data_emissao" => $item->contareceber_data_emissao,
            "contareceber_data_vencimento" => $item->contareceber_data_vencimento,
            "contareceber_data_recebimento" => $item->contareceber_data_recebimento,
            "contareceber_valor_duplicata" => $item->contareceber_valor_duplicata,
            "contareceber_valor_total" => $item->contareceber_valor_total,
            "contareceber_descricao" => $item->contareceber_descricao,
            "contareceber_data_lancamento" => $item->contareceber_data_lancamento,
            "contareceber_numero_nota_fiscal" => $item->contareceber_numero_nota_fiscal,
            "contareceber_numero_parcela" => $item->contareceber_numero_parcela,
            "contareceber_nosso_numero" => $item->contareceber_nosso_numero
        );
      
        http_response_code(200);
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }
      
    else{
        http_response_code(404);
        echo json_encode("Conta a Receber nao encontrada.");
    }
?>