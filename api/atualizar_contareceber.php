<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/conexao.php';
    include_once '../class/contareceber.php';
    
    $database = new Database();
    $db = $database->conexao();
    
    $item = new ContaReceber($db);
    
    $data = json_decode(file_get_contents("php://input"));

    $item->contareceber_id = $data->contareceber_id;
    $item->contareceber_formarecebimento_id = $data->contareceber_formarecebimento_id;
    $item->contareceber_conta_id = $data->contareceber_conta_id;
    $item->contareceber_categoria_id = $data->contareceber_categoria_id;
    $item->contareceber_nome_cliente = $data->contareceber_nome_cliente;
    $item->contareceber_numero_duplicata = $data->contareceber_numero_duplicata;
    $item->contareceber_numero_documento = $data->contareceber_numero_documento;
    $item->contareceber_data_emissao = $data->contareceber_data_emissao;
    $item->contareceber_data_vencimento = $data->contareceber_data_vencimento;
    $item->contareceber_data_recebimento = $data->contareceber_data_recebimento;
    $item->contareceber_valor_duplicata = $data->contareceber_valor_duplicata;
    $item->contareceber_valor_total = $data->contareceber_valor_total;
    $item->contareceber_descricao = $data->contareceber_descricao;
    $item->contareceber_data_lancamento = date('Y-m-d');
    $item->contareceber_numero_nota_fiscal = $data->contareceber_numero_nota_fiscal;
    $item->contareceber_numero_parcela = $data->contareceber_numero_parcela;
    $item->contareceber_nosso_numero = $data->contareceber_nosso_numero;
    

    if($item->atualizarContaReceber($ambiente_caixa_logado)){
        echo json_encode("Dados da Conta a Receber atualizados.");
    } else{
        echo json_encode("Dados do Conta a Receber não foram atualizados");
    }
?>