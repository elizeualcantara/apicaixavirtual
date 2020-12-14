<?php

    date_default_timezone_set('America/Sao_Paulo');

    class ContaReceber{

        private $conn;

        private $db_table = "contareceber";

        public $contareceber_id;
        public $contareceber_formarecebimento_id;
        public $contareceber_conta_id;
        public $contareceber_categoria_id;
        public $contareceber_caixa_id;
        public $contareceber_nome_cliente;
        public $contareceber_numero_duplicata;
        public $contareceber_numero_documento;
        public $contareceber_data_emissao;
        public $contareceber_data_vencimento;
        public $contareceber_data_recebimento;
        public $contareceber_valor_duplicata;
        public $contareceber_valor_juros;
        public $contareceber_valor_desconto;
        public $contareceber_valor_total;
        public $contareceber_descricao;
        public $contareceber_data_lancamento;
        public $contareceber_numero_nota_fiscal;
        public $contareceber_numero_parcela;
        public $contareceber_nosso_numero;
        public $contareceber_flag_cancelada;
        public $contareceber_flag_estorno_devolucao;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarContaReceber($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        contareceber_id,
                        contareceber_formarecebimento_id,
                        contareceber_conta_id,
                        contareceber_categoria_id,
                        contareceber_caixa_id,
                        contareceber_nome_cliente,
                        contareceber_numero_duplicata,
                        contareceber_numero_documento,
                        contareceber_data_emissao,
                        contareceber_data_vencimento,
                        contareceber_data_recebimento,
                        contareceber_valor_duplicata,
                        contareceber_valor_juros,
                        contareceber_valor_desconto,
                        contareceber_valor_total,
                        contareceber_descricao,
                        contareceber_data_lancamento,
                        contareceber_numero_nota_fiscal,
                        contareceber_numero_parcela,
                        contareceber_nosso_numero,
                        contareceber_flag_cancelada,
                        contareceber_flag_estorno_devolucao
                        FROM " . $this->db_table . "
                        WHERE contareceber_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarContaReceber($ambiente_caixa_logado){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                        SET
                        contareceber_formarecebimento_id = :contareceber_formarecebimento_id,
                        contareceber_conta_id = :contareceber_conta_id,
                        contareceber_categoria_id = :contareceber_categoria_id,
                        contareceber_caixa_id = :contareceber_caixa_id,
                        contareceber_nome_cliente = :contareceber_nome_cliente,
                        contareceber_numero_duplicata = :contareceber_numero_duplicata,
                        contareceber_numero_documento = :contareceber_numero_documento,
                        contareceber_data_emissao = :contareceber_data_emissao,
                        contareceber_data_vencimento = :contareceber_data_vencimento,
                        contareceber_data_recebimento = :contareceber_data_recebimento,
                        contareceber_valor_duplicata = :contareceber_valor_duplicata,
                        contareceber_valor_total = :contareceber_valor_total,
                        contareceber_descricao = :contareceber_descricao,
                        contareceber_data_lancamento = :contareceber_data_lancamento,
                        contareceber_numero_nota_fiscal = :contareceber_numero_nota_fiscal,
                        contareceber_numero_parcela = :contareceber_numero_parcela,
                        contareceber_nosso_numero = :contareceber_nosso_numero";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->contareceber_formarecebimento_id=htmlspecialchars(strip_tags($this->contareceber_formarecebimento_id));
            $this->contareceber_conta_id=htmlspecialchars(strip_tags($this->contareceber_conta_id));
            $this->contareceber_categoria_id=htmlspecialchars(strip_tags($this->contareceber_categoria_id));
            $this->contareceber_caixa_id=htmlspecialchars(strip_tags($this->contareceber_caixa_id));
            $this->contareceber_nome_cliente=htmlspecialchars(strip_tags($this->contareceber_nome_cliente));
            $this->contareceber_numero_duplicata=htmlspecialchars(strip_tags($this->contareceber_numero_duplicata));
            $this->contareceber_numero_documento=htmlspecialchars(strip_tags($this->contareceber_numero_documento));
            $this->contareceber_data_emissao=htmlspecialchars(strip_tags($this->contareceber_data_emissao));
            $this->contareceber_data_vencimento=htmlspecialchars(strip_tags($this->contareceber_data_vencimento));
            $this->contareceber_data_recebimento=htmlspecialchars(strip_tags($this->contareceber_data_recebimento));
            $this->contareceber_valor_duplicata=htmlspecialchars(strip_tags($this->contareceber_valor_duplicata));
            $this->contareceber_valor_total=htmlspecialchars(strip_tags($this->contareceber_valor_total));
            $this->contareceber_descricao=htmlspecialchars(strip_tags($this->contareceber_descricao));
            $this->contareceber_data_lancamento=htmlspecialchars(strip_tags($this->contareceber_data_lancamento));
            $this->contareceber_numero_nota_fiscal=htmlspecialchars(strip_tags($this->contareceber_numero_nota_fiscal));
            $this->contareceber_numero_parcela=htmlspecialchars(strip_tags($this->contareceber_numero_parcela));
            $this->contareceber_nosso_numero=htmlspecialchars(strip_tags($this->contareceber_nosso_numero));

            // TRATAMENTO
            $this->contareceber_descricao=remover_acentos($this->contareceber_descricao);
            $this->contareceber_nome_cliente=remover_acentos($this->contareceber_nome_cliente);
            
            $stmt->bindParam(":contareceber_caixa_id", $ambiente_caixa_logado);
            
            $stmt->bindParam(":contareceber_formarecebimento_id", $this->contareceber_formarecebimento_id);
            $stmt->bindParam(":contareceber_conta_id", $this->contareceber_conta_id);
            $stmt->bindParam(":contareceber_categoria_id", $this->contareceber_categoria_id);
            $stmt->bindParam(":contareceber_nome_cliente", $this->contareceber_nome_cliente);
            $stmt->bindParam(":contareceber_numero_duplicata", $this->contareceber_numero_duplicata);
            $stmt->bindParam(":contareceber_numero_documento", $this->contareceber_numero_documento);
            $stmt->bindParam(":contareceber_data_emissao", $this->contareceber_data_emissao);
            $stmt->bindParam(":contareceber_data_vencimento", $this->contareceber_data_vencimento);
            $stmt->bindParam(":contareceber_data_recebimento", $this->contareceber_data_recebimento);
            $stmt->bindParam(":contareceber_valor_duplicata", $this->contareceber_valor_duplicata);
            $stmt->bindParam(":contareceber_valor_total", $this->contareceber_valor_total);
            $stmt->bindParam(":contareceber_descricao", $this->contareceber_descricao);
            $stmt->bindParam(":contareceber_data_lancamento", $this->contareceber_data_lancamento);
            $stmt->bindParam(":contareceber_numero_nota_fiscal", $this->contareceber_numero_nota_fiscal);
            $stmt->bindParam(":contareceber_numero_parcela", $this->contareceber_numero_parcela);
            $stmt->bindParam(":contareceber_nosso_numero", $this->contareceber_nosso_numero);
            
        
            if($stmt->execute()){

                $movimentacao_contareceber_id = $this->conn->lastInsertId();

                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // RECUPERA O ID CRIADO DA ENTRADA, CHECA SE SETADO SALDO ATUAL DE HOJE, E LANCA TAMBEM NA TABELA DE MOVIMENTACOES DE ENTRADA/SAIDAS
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                
                $sqlCONTA  = " SELECT conta_valor_saldo_atual,conta_data_atual,conta_valor_saldo_data_anterior,conta_data_anterior";
                $sqlCONTA .= " FROM conta";
                $sqlCONTA .= " WHERE conta_caixa_id = ".$ambiente_caixa_logado." AND DATE_FORMAT(conta_data_atual, '%Y-%m-%d') = CURDATE()";
                       
                $sql = $this->conn->prepare($sqlCONTA);
                $sql->execute();
                
                $saldo_hoje_existe = $sql->fetch();  
                
                // SE NAO SETADO SALDO ATUAL DE HOJE: SALDO ANTERIOR = SALDO ATUAL E DATA ANTERIOR = DATA ATUAL E DATA ATUAL = HOJE
                // OBJETIVO: ANTES DA 1a MOVIMENTACAO DO DIA, O SALDO ATUAL É SALVO COMO SALDO DO DIA ANTERIOR (POR SEGURANÇA E CONFERÊNCIA)
                 
                if ($saldo_hoje_existe=="") {

                    $updateCONTA1  = " UPDATE conta ";
                    $updateCONTA1 .= " SET conta_valor_saldo_data_anterior=conta_valor_saldo_atual , conta_data_anterior=conta_data_atual ";
                    $updateCONTA1 .= " WHERE conta_caixa_id = ".$ambiente_caixa_logado." ";
                    $sql1 = $this->conn->prepare($updateCONTA1);
                    $sql1->execute();

                    $updateCONTA2  = " UPDATE conta ";
                    $updateCONTA2 .= " SET conta_data_atual = CURDATE()";
                    $updateCONTA2 .= " WHERE conta_caixa_id = ".$ambiente_caixa_logado." ";
                    $sql2 = $this->conn->prepare($updateCONTA2);
                    $sql2->execute();
    
                }


                $sqlQuery2 = "INSERT INTO
                              movimentacao
                              SET
                              movimentacao_contareceber_id = :movimentacao_contareceber_id,
                              movimentacao_conta_id = :movimentacao_conta_id,
                              movimentacao_caixa_id = :movimentacao_caixa_id,
                              movimentacao_data_lancamento = :movimentacao_data_lancamento,
                              movimentacao_valor_lancamento = :movimentacao_valor_lancamento,
                              movimentacao_referente = :movimentacao_referente";

                $stmt2 = $this->conn->prepare($sqlQuery2);
                
                $stmt2->bindParam(":movimentacao_caixa_id", $ambiente_caixa_logado);

                $stmt2->bindParam(":movimentacao_contareceber_id", $movimentacao_contareceber_id);
                $stmt2->bindParam(":movimentacao_conta_id", $this->contareceber_conta_id);
                $stmt2->bindParam(":movimentacao_data_lancamento", $this->contareceber_data_lancamento);
                $stmt2->bindParam(":movimentacao_valor_lancamento", $this->contareceber_valor_total);
                $stmt2->bindParam(":movimentacao_referente", $this->contareceber_nome_cliente);


                if($stmt2->execute()){
                   return true;
                }
            }
            return false;
        }

        public function consultaContaReceber($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        contareceber_id,
                        contareceber_formarecebimento_id,
                        contareceber_conta_id,
                        contareceber_categoria_id,
                        contareceber_caixa_id,
                        contareceber_nome_cliente,
                        contareceber_numero_duplicata,
                        contareceber_numero_documento,
                        contareceber_data_emissao,
                        contareceber_data_vencimento,
                        contareceber_data_recebimento,
                        contareceber_valor_duplicata,
                        contareceber_valor_juros,
                        contareceber_valor_desconto,
                        contareceber_valor_total,
                        contareceber_descricao,
                        contareceber_data_lancamento,
                        contareceber_numero_nota_fiscal,
                        contareceber_numero_parcela,
                        contareceber_nosso_numero,
                        contareceber_flag_cancelada,
                        contareceber_flag_estorno_devolucao
                        FROM
                        ". $this->db_table ."
                        WHERE
                        contareceber_id = ?
                        AND contareceber_caixa_id =".$ambiente_caixa_logado."
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->contareceber_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->contareceber_id = $dataRow['contareceber_id'];
            $this->contareceber_formarecebimento_id = $dataRow['contareceber_formarecebimento_id'];
            $this->contareceber_conta_id = $dataRow['contareceber_conta_id'];
            $this->contareceber_categoria_id = $dataRow['contareceber_categoria_id'];
            $this->contareceber_caixa_id = $dataRow['contareceber_caixa_id'];
            $this->contareceber_nome_cliente = $dataRow['contareceber_nome_cliente'];
            $this->contareceber_numero_duplicata = $dataRow['contareceber_numero_duplicata'];
            $this->contareceber_numero_documento = $dataRow['contareceber_numero_documento'];
            $this->contareceber_data_emissao = $dataRow['contareceber_data_emissao'];
            $this->contareceber_data_vencimento = $dataRow['contareceber_data_vencimento'];
            $this->contareceber_data_recebimento = $dataRow['contareceber_data_recebimento'];
            $this->contareceber_valor_duplicata = $dataRow['contareceber_valor_duplicata'];
            $this->contareceber_valor_total = $dataRow['contareceber_valor_total'];
            $this->contareceber_descricao = $dataRow['contareceber_descricao'];
            $this->contareceber_data_lancamento = $dataRow['contareceber_data_lancamento'];
            $this->contareceber_numero_nota_fiscal = $dataRow['contareceber_numero_nota_fiscal'];
            $this->contareceber_numero_parcela = $dataRow['contareceber_numero_parcela'];
            $this->contareceber_nosso_numero = $dataRow['contareceber_nosso_numero'];
            
        }        

        public function atualizarContaReceber($ambiente_caixa_logado){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        contareceber_formarecebimento_id = :contareceber_formarecebimento_id,
                        contareceber_conta_id = :contareceber_conta_id,
                        contareceber_categoria_id = :contareceber_categoria_id,
                        contareceber_caixa_id = :contareceber_caixa_id,
                        contareceber_nome_cliente = :contareceber_nome_cliente,
                        contareceber_numero_duplicata = :contareceber_numero_duplicata,
                        contareceber_numero_documento = :contareceber_numero_documento,
                        contareceber_data_emissao = :contareceber_data_emissao,
                        contareceber_data_vencimento = :contareceber_data_vencimento,
                        contareceber_data_recebimento = :contareceber_data_recebimento,
                        contareceber_valor_duplicata = :contareceber_valor_duplicata,
                        contareceber_valor_total = :contareceber_valor_total,
                        contareceber_descricao = :contareceber_descricao,
                        contareceber_data_lancamento = :contareceber_data_lancamento,
                        contareceber_numero_nota_fiscal = :contareceber_numero_nota_fiscal,
                        contareceber_numero_parcela = :contareceber_numero_parcela,
                        contareceber_nosso_numero = :contareceber_nosso_numero
                        WHERE
                        contareceber_id = :contareceber_id
                        AND contareceber_caixa_id = :contareceber_caixa_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->contareceber_formarecebimento_id=htmlspecialchars(strip_tags($this->contareceber_formarecebimento_id));
            $this->contareceber_conta_id=htmlspecialchars(strip_tags($this->contareceber_conta_id));
            $this->contareceber_categoria_id=htmlspecialchars(strip_tags($this->contareceber_categoria_id));
            $this->contareceber_caixa_id=htmlspecialchars(strip_tags($this->contareceber_caixa_id));
            $this->contareceber_nome_cliente=htmlspecialchars(strip_tags($this->contareceber_nome_cliente));
            $this->contareceber_numero_duplicata=htmlspecialchars(strip_tags($this->contareceber_numero_duplicata));
            $this->contareceber_numero_documento=htmlspecialchars(strip_tags($this->contareceber_numero_documento));
            $this->contareceber_data_emissao=htmlspecialchars(strip_tags($this->contareceber_data_emissao));
            $this->contareceber_data_vencimento=htmlspecialchars(strip_tags($this->contareceber_data_vencimento));
            $this->contareceber_data_recebimento=htmlspecialchars(strip_tags($this->contareceber_data_recebimento));
            $this->contareceber_valor_duplicata=htmlspecialchars(strip_tags($this->contareceber_valor_duplicata));
            $this->contareceber_valor_total=htmlspecialchars(strip_tags($this->contareceber_valor_total));
            $this->contareceber_descricao=htmlspecialchars(strip_tags($this->contareceber_descricao));
            $this->contareceber_data_lancamento=htmlspecialchars(strip_tags($this->contareceber_data_lancamento));
            $this->contareceber_numero_nota_fiscal=htmlspecialchars(strip_tags($this->contareceber_numero_nota_fiscal));
            $this->contareceber_numero_parcela=htmlspecialchars(strip_tags($this->contareceber_numero_parcela));
            $this->contareceber_nosso_numero=htmlspecialchars(strip_tags($this->contareceber_nosso_numero));

            // TRATAMENTO
            $this->contareceber_descricao=remover_acentos($this->contareceber_descricao);
            $this->contareceber_nome_cliente=remover_acentos($this->contareceber_nome_cliente);
            
            $stmt->bindParam(":contareceber_caixa_id", $ambiente_caixa_logado);

            $stmt->bindParam(":contareceber_formarecebimento_id", $this->contareceber_formarecebimento_id);
            $stmt->bindParam(":contareceber_conta_id", $this->contareceber_conta_id);
            $stmt->bindParam(":contareceber_categoria_id", $this->contareceber_categoria_id);
            $stmt->bindParam(":contareceber_nome_cliente", $this->contareceber_nome_cliente);
            $stmt->bindParam(":contareceber_numero_duplicata", $this->contareceber_numero_duplicata);
            $stmt->bindParam(":contareceber_numero_documento", $this->contareceber_numero_documento);
            $stmt->bindParam(":contareceber_data_emissao", $this->contareceber_data_emissao);
            $stmt->bindParam(":contareceber_data_vencimento", $this->contareceber_data_vencimento);
            $stmt->bindParam(":contareceber_data_recebimento", $this->contareceber_data_recebimento);
            $stmt->bindParam(":contareceber_valor_duplicata", $this->contareceber_valor_duplicata);
            $stmt->bindParam(":contareceber_valor_total", $this->contareceber_valor_total);
            $stmt->bindParam(":contareceber_descricao", $this->contareceber_descricao);
            $stmt->bindParam(":contareceber_data_lancamento", $this->contareceber_data_lancamento);
            $stmt->bindParam(":contareceber_numero_nota_fiscal", $this->contareceber_numero_nota_fiscal);
            $stmt->bindParam(":contareceber_numero_parcela", $this->contareceber_numero_parcela);
            $stmt->bindParam(":contareceber_nosso_numero", $this->contareceber_nosso_numero);
            
            $stmt->bindParam(":contareceber_id", $this->contareceber_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function excluirContaReceber($ambiente_caixa_logado){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE contareceber_id = ? AND contareceber_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->contareceber_id=htmlspecialchars(strip_tags($this->contareceber_id));
        
            $stmt->bindParam(1, $this->contareceber_id);
        
            if($stmt->execute()){

                $sqlQuery2 = "DELETE FROM movimentacao WHERE movimentacao_contareceber_id = ? AND movimentacao_caixa_id =".$ambiente_caixa_logado;
                $stmt2 = $this->conn->prepare($sqlQuery2);

                $this->contareceber_id=htmlspecialchars(strip_tags($this->contareceber_id));

                $stmt2->bindParam(1, $this->contareceber_id);

                if($stmt2->execute()){
                    return true;
                }

            }
            return false;
        }


    }

    function remover_acentos($texto){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $texto);
    }
?>

