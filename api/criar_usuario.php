<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once '../class/usuarios.php';

    $database = new Database();
    $db = $database->conexao();

    $item = new Usuario($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->usuario_caixa_id = $ambiente_caixa_logado;
    
    $item->usuario_login          = $data->usuario_login;
    $item->usuario_senha          = $data->usuario_senha;
    $item->usuario_email          = $data->usuario_email;
    $item->usuario_nome           = $data->usuario_nome;
    $item->usuario_primeiro_nome  = $data->usuario_primeiro_nome;
    
    if($item->criarUsuario($ambiente_caixa_logado)){
        echo 'Usuário criado com sucesso.';
    } else{
        echo 'Usuário não pode ser criado.';
    }
?>