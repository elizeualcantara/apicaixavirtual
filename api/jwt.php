<?php

//////////////////////////////
//// LADO SERVER
//////////////////////////////

$chave_api_caixa_01 = "ewrx0865720i12e7pies92g4yiim4p";

$header = [
   'alg' => 'HS256',
   'typ' => 'JWT'
];
$header = json_encode($header);
$header = base64_encode($header);

$payload = [
   'iss'   => 'http://elizeu.com.br',
   'name'  => 'NomeEmpresa',
   'email' => 'elizeu@elizeu.com.br'
];
$payload = json_encode($payload);
$payload = base64_encode($payload);

$signature = hash_hmac('sha256',"$header.$payload",$chave_api_caixa_01,true);
$signature = base64_encode($signature);

$token = "$header.$payload.$signature";

echo $token;



/*

//////////////////////////////
//// LADO CLIENTE
//////////////////////////////

$token = $_GET['token'];

$part = explode(".",$token);
$header = $part[0];
$payload = $part[1];
$signature = $part[2];

$validacao_chave_api_caixa_01 = hash_hmac('sha256',"$header.$payload",'ewrx0865720i12e7pies92g4yiim4p',true);
$validacao_chave_api_caixa_01 = base64_encode($validacao_chave_api_caixa_01);

if($signature == $validacao_chave_api_caixa_01){
   echo "<br>Chave Válida";
} else{
   echo '<br>Chave Inválida';
}

exit;
*/


////////////////////////////////////////////
/// GERADOR DE TOKEN JWT ( MODELO 2)
////////////////////////////////////////////

function base64url_encode($data) {
  $b64 = base64_encode($data);
  if ($b64 === false) {
    return false;
  }
  $url = strtr($b64, '+/', '-_');
  return rtrim($url, '=');
}

$token  = "Bmn0c8rQDJoGTibk";                 // base64_encode(random_bytes(12));
$secret = "yXWczx0LwgKInpMFfgh0gCYCA8EKbOnw"; // base64_encode(random_bytes(24));

// RFC-defined structure
$header = [
    "alg" => "HS256",
    "typ" => "JWT"
];

// whatever you want
$payload = [
    "token" => $token,
    "stamp" => "2020-01-02T22:00:00+00:00"    // date("c")
];

$jwt = sprintf(
    "%s.%s",
    base64url_encode(json_encode($header)),
    base64url_encode(json_encode($payload))
);

$jwt = sprintf(
    "%s.%s",
    $jwt,
    base64url_encode(hash_hmac('SHA256', $jwt, base64_decode($secret), true))
);

var_dump($jwt);
exit;


?>
