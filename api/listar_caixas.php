<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/conexao.php';
    include_once '../class/caixas.php';
    
    $database = new Database();
    $db = $database->conexao();

    $items = new Caixa($db);

    $stmt = $items->listarCaixas($ambiente_caixa_logado);
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $dados_arr = array();
        $dados_arr["body"] = array();
        $dados_arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            "caixa_id" =>  $caixa_id,
            "caixa_identificacao" => $caixa_identificacao,
            "caixa_localizacao" => $caixa_localizacao,
            "caixa_tecnologia" => $caixa_tecnologia,
            "caixa_versao_aplicacao" => $caixa_versao_aplicacao,
            "caixa_data_inicio_movimentacao" => $caixa_data_inicio_movimentacao,
            "caixa_valor_inicio_movimentacao" => $caixa_valor_inicio_movimentacao,
            "caixa_observacao" => $caixa_observacao,
            "caixa_emissao_razao_social" => $caixa_emissao_razao_social,
            "caixa_emissao_cnpj" => $caixa_emissao_cnpj,
            "caixa_emissao_inscricao_estadual" => $caixa_emissao_inscricao_estadual,
            "caixa_emissao_inscricao_municipal" => $caixa_emissao_inscricao_municipal,
            "caixa_contato_suporte" => $caixa_contato_suporte,
            "caixa_telefone_suporte" => $caixa_telefone_suporte,
            "caixa_email_suporte" => $caixa_email_suporte
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