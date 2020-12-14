<?php

// INICIO - VALIDACAO DA AUTENTICACAO VIA TOKEN JWT PARA ACESSO A UMA DETERINADA LOJA

$senha_api_caixa_10 = "ewrx0865720i12e7pies92g4yiim4p";

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
   echo 'Acesso nao autorizado.';
   exit;
}

$token = $headers['Authorization'];
$part = explode(".",$token);
$header = $part[0];
$header = trim(str_replace("Bearer","",$header));
$payload = $part[1];
$signature = $part[2];
$validacao_senha_api_caixa_10 = hash_hmac('sha256',"$header.$payload",$senha_api_caixa_10,true);
$validacao_senha_api_caixa_10 = base64_encode($validacao_senha_api_caixa_10);

if($signature == $validacao_senha_api_caixa_10){
   // Chave Válida
   $ambiente_caixa_logado = "10";
}else{
   echo 'Chave Invalida. Acesso nao autorizado.';
   exit;
}

// FINAL - VALIDACAO DA AUTENTICACAO VIA TOKEN JWT PARA ACESSO A UMA DETERINADA LOJA



?>