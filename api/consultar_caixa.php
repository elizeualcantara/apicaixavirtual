<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/caixas.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new Caixa($db);

    $item->caixa_id = isset($_GET['caixa_id']) ? $_GET['caixa_id'] : die();
  
    $item->consultaCaixa($ambiente_caixa_logado);

    if($item->caixa_id != null){

        $dados_arr = array(
            "caixa_id"                           => $item->caixa_id,
            "caixa_identificacao"                => $item->caixa_identificacao,
            "caixa_localizacao"                  => $item->caixa_localizacao,
            "caixa_tecnologia"                   => $item->caixa_tecnologia,
            "caixa_versao_aplicacao"             => $item->caixa_versao_aplicacao,
            "caixa_data_inicio_movimentacao"     => $item->caixa_data_inicio_movimentacao,
            "caixa_valor_inicio_movimentacao"    => $item->caixa_valor_inicio_movimentacao,
            "caixa_observacao"                   => $item->caixa_observacao,
            "caixa_emissao_razao_social"         => $item->caixa_emissao_razao_social,
            "caixa_emissao_cnpj"                 => $item->caixa_emissao_cnpj,
            "caixa_emissao_inscricao_estadual"   => $item->caixa_emissao_inscricao_estadual,
            "caixa_emissao_inscricao_municipal"  => $item->caixa_emissao_inscricao_municipal,
            "caixa_contato_suporte"              => $item->caixa_contato_suporte,
            "caixa_telefone_suporte"             => $item->caixa_telefone_suporte,
            "caixa_email_suporte"                => $item->caixa_email_suporte
        );
      
        http_response_code(200);
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }
      
    else{
        http_response_code(404);
        echo json_encode("Dados do Caixa não encontrado.");
    }
?>