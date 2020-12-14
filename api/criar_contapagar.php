<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/contapagar.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new ContaPagar($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->contapagar_caixa_id = $ambiente_caixa_logado;

    $item->contapagar_formapgto_id = $data->contapagar_formapgto_id;
    $item->contapagar_conta_id = $data->contapagar_conta_id;
    $item->contapagar_categoria_id = $data->contapagar_categoria_id;
    $item->contapagar_nome_credor = $data->contapagar_nome_credor;
    $item->contapagar_numero_duplicata = $data->contapagar_numero_duplicata;
    $item->contapagar_numero_documento = $data->contapagar_numero_documento;
    $item->contapagar_data_emissao = $data->contapagar_data_emissao;
    $item->contapagar_data_vencimento = $data->contapagar_data_vencimento;
    $item->contapagar_data_pagamento = $data->contapagar_data_pagamento;
    $item->contapagar_valor_duplicata = $data->contapagar_valor_duplicata;
    $item->contapagar_valor_total = $data->contapagar_valor_total;
    $item->contapagar_descricao = $data->contapagar_descricao;
    $item->contapagar_nome_banco = $data->contapagar_nome_banco;
    $item->contapagar_numero_agencia = $data->contapagar_numero_agencia;
    $item->contapagar_numero_conta = $data->contapagar_numero_conta;
    $item->contapagar_data_lancamento = date('Y-m-d');
    $item->contapagar_numero_nota_fiscal = $data->contapagar_numero_nota_fiscal;
    $item->contapagar_numero_parcela = $data->contapagar_numero_parcela;
    $item->contapagar_nosso_numero = $data->contapagar_nosso_numero;
            
    
    if($item->criarContaPagar($ambiente_caixa_logado)){
        echo 'Conta a Pagar criada com sucesso.';
    } else{
        echo 'Conta a Pagar não pode ser criada.';
    }
?>