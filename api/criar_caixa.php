<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/caixas.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new Caixa($db);

    $data = json_decode(file_get_contents("php://input"));

    if ($ambiente_caixa_logado > 0) {
    // ESTA LOGADO EM UM CAIXA (REGRAS DE PERMISSÃO DE ACORDO COM REGRAS DE NEGÓCIO, QUANDO FOR PRODUÇÃO)
    } else {
        echo 'Sem permissão. Caixa não pode ser criado.';
    }

    $item->caixa_identificacao                = $data->caixa_identificacao;
    $item->caixa_localizacao                  = $data->caixa_localizacao;
    $item->caixa_data_inicio_movimentacao     = $data->caixa_data_inicio_movimentacao;
    $item->caixa_valor_inicio_movimentacao    = $data->caixa_valor_inicio_movimentacao;
    $item->caixa_emissao_razao_social         = $data->caixa_emissao_razao_social;
    $item->caixa_emissao_cnpj                 = $data->caixa_emissao_cnpj;
    $item->caixa_versao_aplicacao             = $data->caixa_versao_aplicacao;
    $item->caixa_observacao                   = $data->caixa_observacao;

    //$item->caixa_tecnologia                   = $data->caixa_tecnologia;
    //$item->caixa_emissao_inscricao_estadual   = $data->caixa_emissao_inscricao_estadual;
    //$item->caixa_emissao_inscricao_municipal  = $data->caixa_emissao_inscricao_municipal;
    //$item->caixa_contato_suporte              = $data->caixa_contato_suporte;
    //$item->caixa_telefone_suporte             = $data->caixa_telefone_suporte;
    //$item->caixa_email_suporte                = $data->caixa_email_suporte;
    
    if($item->criarCaixa($ambiente_caixa_logado)){
        echo 'Caixa criado com sucesso.';
    } else{
        echo 'Caixa não pode ser criado.';
    }
?>