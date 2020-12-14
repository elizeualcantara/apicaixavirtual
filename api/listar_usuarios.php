<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/conexao.php';
    include_once '../class/usuarios.php';
    
    $database = new Database();
    $db = $database->conexao();

    $items = new Usuario($db);

    $stmt = $items->listarUsuarios($ambiente_caixa_logado);
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $dados_arr = array();
        $dados_arr["body"] = array();
        $dados_arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            "usuario_id" =>  $usuario_id,
            "usuario_caixa_id" => $usuario_caixa_id,
            "usuario_login" => $usuario_login,
            "usuario_senha" => $usuario_senha,
            "usuario_email" => $usuario_email,
            "usuario_nome" => $usuario_nome,
            "usuario_primeiro_nome" => $usuario_primeiro_nome,
            "usuario_ativo" => $usuario_ativo
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