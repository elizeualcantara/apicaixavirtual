<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/usuarios.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new Usuario($db);

    $item->usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : die();
  
    $item->consultaUsuario($ambiente_caixa_logado);

    if($item->usuario_id != null){

        $dados_arr = array(
            "usuario_id"            => $item->usuario_id,
            "usuario_caixa_id"       => $item->usuario_caixa_id,
            "usuario_login"         => $item->usuario_login,
            "usuario_senha"         => $item->usuario_senha,
            "usuario_email"         => $item->usuario_email,
            "usuario_nome"          => $item->usuario_nome,
            "usuario_primeiro_nome" => $item->usuario_primeiro_nome,
            "usuario_ativo"         => $item->usuario_ativo
        );
      
        http_response_code(200);
        echo json_encode($dados_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    }
      
    else{
        http_response_code(404);
        echo json_encode("Usuario nao encontrado.");
    }
?>