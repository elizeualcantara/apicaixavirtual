<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/conexao.php';
    include_once '../class/categorias.php';

    $database = new Database();
    $db = $database->conexao();

    $items = new Categoria($db);

    $stmt = $items->listarCategorias();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $dados_arr = array();
        $dados_arr["body"] = array();
        $dados_arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            "categoria_id" =>  $categoria_id,
            "categoria_movimentacao" => $categoria_movimentacao,
            "categoria_flag_entrada_saida" => $categoria_flag_entrada_saida,
            "categoria_flag_atualiza_saldo" => $categoria_flag_atualiza_saldo,
            "categoria_flag_ativo" => $categoria_flag_ativo
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