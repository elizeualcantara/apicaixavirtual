<?php

date_default_timezone_set('America/Sao_Paulo');

//ini_set('display_errors', 0);
//error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once '../config/conexao.php';

$db = new Database();

$bd = mysqli_connect($db->host(),$db->user(),$db->pass(),$db->db());
if (mysqli_connect_errno()){
  echo  mysqli_connect_error();
  die();
}
     
if(isset($ambiente_caixa_logado))
{
    
    $resumo_array       = array();
    $movimentacao_array = array();
    $lancamento_array   = array();  
    $categoria_array    = array();
    
    
    ///////////////////////////////////////////
    // SALDO ATUAL DA LOJA E ID DA CONTA
    ///////////////////////////////////////////
        
    $sql_movimentacoes = "SELECT
                          conta_valor_saldo_atual,conta_id
                          FROM conta
                          WHERE conta_caixa_id=".$ambiente_caixa_logado."
                          LIMIT 1";
    $fetch_movimentacoes = mysqli_query($bd, $sql_movimentacoes) or die(mysqli_error($bd));
    while ($row_movimentacoes = mysqli_fetch_assoc($fetch_movimentacoes)) {
    
        $movimentacao_array['saldoTotal']       = (int)$row_movimentacoes['conta_valor_saldo_atual'];
        $movimentacao_array['movimentacoes']    = array();    
             
             
        ////////////////////////////////////////////////////////////////////             
        // DADOS DOS LANCAMENTO DA DATA DE HOJE
        ////////////////////////////////////////////////////////////////////
            
        $sql_lancamentos = "SELECT 
                            movimentacao_id,
                            movimentacao_data_lancamento,
                            movimentacao_valor_lancamento,
                            movimentacao_referente,
                            if (movimentacao_contareceber_id > 0, 'ENTRADA','SAIDA') as movimentacao_tipo,
                            if (movimentacao_contareceber_id > 0, c1.categoria_id,c2.categoria_id) as categoria_id,
                            if (movimentacao_contareceber_id > 0, contareceber_descricao,contapagar_descricao) as movimento_descricao
                            FROM movimentacao
                            LEFT JOIN contareceber ON movimentacao_contareceber_id = contareceber_id
                            LEFT JOIN contapagar ON movimentacao_contapagar_id = contapagar_id
                            LEFT JOIN categoria as c1 ON contareceber_categoria_id= c1.categoria_id
                            LEFT JOIN categoria as c2 ON contapagar_categoria_id= c2.categoria_id
                            WHERE
                            movimentacao_conta_id=".$row_movimentacoes['conta_id']."
                            AND DATE_FORMAT(movimentacao_data_lancamento, '%Y-%m-%d') = CURDATE()
                            ORDER BY movimentacao_id DESC";
                            // DEBUG
                            //echo "<br>sql_lancamentos: ".$sql_lancamentos;
                            //exit;
        $fetch_lancamentos = mysqli_query($bd, $sql_lancamentos) or die(mysqli_error($bd));
        while ($row_lancamentos = mysqli_fetch_assoc($fetch_lancamentos)) {
                                                                 
            $lancamento_array['data']         = date("d/m/Y", strtotime($row_lancamentos['movimentacao_data_lancamento']));
            $lancamento_array['id']           = $row_lancamentos['movimentacao_id'];
            $lancamento_array['categoria']    = array();
            $lancamento_array['tipo']         = $row_lancamentos['movimentacao_tipo'];
            $lancamento_array['valor']        = (int)$row_lancamentos['movimentacao_valor_lancamento'];
            $lancamento_array['descricao']    = $row_lancamentos['movimento_descricao']." (".$row_lancamentos['movimentacao_referente'].")";
                        
            
            ////////////////////////////////////////////////////////////////////             
            // DADOS DA CATEGORIA DE CADA LANCAMENTO
            ////////////////////////////////////////////////////////////////////
                        
            $sql_categorias = "SELECT 
                               categoria_id,
                               categoria_movimentacao
                               FROM categoria
                               WHERE categoria_id=".$row_lancamentos['categoria_id']."
                               LIMIT 1";            
            $fetch_categorias = mysqli_query($bd, $sql_categorias) or die(mysqli_error($bd));
            while ($row_categorias = mysqli_fetch_assoc($fetch_categorias)) {
            
                $categoria_array['id']         = $row_categorias['categoria_id'];
                $categoria_array['name']       = $row_categorias['categoria_movimentacao'];
                                 
                array_push($lancamento_array['categoria'],$categoria_array);
            
            }            
                            
            array_push($movimentacao_array['movimentacoes'],$lancamento_array);
        
        }
    
        array_push($resumo_array,$movimentacao_array);
    
    }

    $retorno_api_json = json_encode($resumo_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );

    echo  $retorno_api_json ;

}     
?>  