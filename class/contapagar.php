<?php

    date_default_timezone_set('America/Sao_Paulo');
    
    class ContaPagar{

        private $conn;

        private $db_table = "contapagar";

        public $contapagar_id;
        public $contapagar_formapgto_id;
        public $contapagar_conta_id;
        public $contapagar_categoria_id;
        public $contapagar_caixa_id;
        public $contapagar_nome_credor;
        public $contapagar_numero_duplicata;
        public $contapagar_numero_documento;
        public $contapagar_data_emissao;
        public $contapagar_data_vencimento;
        public $contapagar_data_pagamento;
        public $contapagar_valor_duplicata;
        public $contapagar_valor_juros;
        public $contapagar_valor_desconto;
        public $contapagar_valor_total;
        public $contapagar_descricao;
        public $contapagar_nome_banco;
        public $contapagar_numero_agencia;
        public $contapagar_numero_conta;
        public $contapagar_data_lancamento;
        public $contapagar_numero_nota_fiscal;
        public $contapagar_numero_parcela;
        public $contapagar_nosso_numero;
        public $contapagar_flag_cancelada;
        public $contapagar_flag_estorno_devolucao;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarContaPagar($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        contapagar_id,
                        contapagar_formapgto_id,
                        contapagar_conta_id,
                        contapagar_categoria_id,
                        contapagar_caixa_id,
                        contapagar_nome_credor,
                        contapagar_numero_duplicata,
                        contapagar_numero_documento,
                        contapagar_data_emissao,
                        contapagar_data_vencimento,
                        contapagar_data_pagamento,
                        contapagar_valor_duplicata,
                        contapagar_valor_juros,
                        contapagar_valor_desconto,
                        contapagar_valor_total,
                        contapagar_descricao,
                        contapagar_nome_banco,
                        contapagar_numero_agencia,
                        contapagar_numero_conta,
                        contapagar_data_lancamento,
                        contapagar_numero_nota_fiscal,
                        contapagar_numero_parcela,
                        contapagar_nosso_numero,
                        contapagar_flag_cancelada,
                        contapagar_flag_estorno_devolucao
                        FROM " . $this->db_table . "
                        WHERE contapagar_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarContaPagar($ambiente_caixa_logado){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                        SET
                        contapagar_formapgto_id = :contapagar_formapgto_id,
                        contapagar_conta_id = :contapagar_conta_id,
                        contapagar_categoria_id = :contapagar_categoria_id,
                        contapagar_caixa_id = :contapagar_caixa_id,
                        contapagar_nome_credor = :contapagar_nome_credor,
                        contapagar_numero_duplicata = :contapagar_numero_duplicata,
                        contapagar_numero_documento = :contapagar_numero_documento,
                        contapagar_data_emissao = :contapagar_data_emissao,
                        contapagar_data_vencimento = :contapagar_data_vencimento,
                        contapagar_data_pagamento = :contapagar_data_pagamento,
                        contapagar_valor_duplicata = :contapagar_valor_duplicata,
                        contapagar_valor_total = :contapagar_valor_total,
                        contapagar_descricao = :contapagar_descricao,
                        contapagar_nome_banco = :contapagar_nome_banco,
                        contapagar_numero_agencia = :contapagar_numero_agencia,
                        contapagar_numero_conta = :contapagar_numero_conta,
                        contapagar_data_lancamento = :contapagar_data_lancamento,
                        contapagar_numero_nota_fiscal = :contapagar_numero_nota_fiscal,
                        contapagar_numero_parcela = :contapagar_numero_parcela,
                        contapagar_nosso_numero = :contapagar_nosso_numero";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->contapagar_formapgto_id=htmlspecialchars(strip_tags($this->contapagar_formapgto_id));
            $this->contapagar_conta_id=htmlspecialchars(strip_tags($this->contapagar_conta_id));
            $this->contapagar_categoria_id=htmlspecialchars(strip_tags($this->contapagar_categoria_id));
            $this->contapagar_caixa_id=htmlspecialchars(strip_tags($this->contapagar_caixa_id));
            $this->contapagar_nome_credor=htmlspecialchars(strip_tags($this->contapagar_nome_credor));
            $this->contapagar_numero_duplicata=htmlspecialchars(strip_tags($this->contapagar_numero_duplicata));
            $this->contapagar_numero_documento=htmlspecialchars(strip_tags($this->contapagar_numero_documento));
            $this->contapagar_data_emissao=htmlspecialchars(strip_tags($this->contapagar_data_emissao));
            $this->contapagar_data_vencimento=htmlspecialchars(strip_tags($this->contapagar_data_vencimento));
            $this->contapagar_data_pagamento=htmlspecialchars(strip_tags($this->contapagar_data_pagamento));
            $this->contapagar_valor_duplicata=htmlspecialchars(strip_tags($this->contapagar_valor_duplicata));
            $this->contapagar_valor_total=htmlspecialchars(strip_tags($this->contapagar_valor_total));
            $this->contapagar_descricao=htmlspecialchars(strip_tags($this->contapagar_descricao));
            $this->contapagar_nome_banco=htmlspecialchars(strip_tags($this->contapagar_nome_banco));
            $this->contapagar_numero_agencia=htmlspecialchars(strip_tags($this->contapagar_numero_agencia));
            $this->contapagar_numero_conta=htmlspecialchars(strip_tags($this->contapagar_numero_conta));
            $this->contapagar_data_lancamento=htmlspecialchars(strip_tags($this->contapagar_data_lancamento));
            $this->contapagar_numero_nota_fiscal=htmlspecialchars(strip_tags($this->contapagar_numero_nota_fiscal));
            $this->contapagar_numero_parcela=htmlspecialchars(strip_tags($this->contapagar_numero_parcela));
            $this->contapagar_nosso_numero=htmlspecialchars(strip_tags($this->contapagar_nosso_numero));
            
            // TRATAMENTO
            $this->contapagar_descricao=remover_acentos($this->contapagar_descricao);
            $this->contapagar_nome_credor=remover_acentos($this->contapagar_nome_credor);
            
            $stmt->bindParam(":contapagar_caixa_id", $ambiente_caixa_logado);

            $stmt->bindParam(":contapagar_formapgto_id", $this->contapagar_formapgto_id);
            $stmt->bindParam(":contapagar_conta_id", $this->contapagar_conta_id);
            $stmt->bindParam(":contapagar_categoria_id", $this->contapagar_categoria_id);
            $stmt->bindParam(":contapagar_nome_credor", $this->contapagar_nome_credor);
            $stmt->bindParam(":contapagar_numero_duplicata", $this->contapagar_numero_duplicata);
            $stmt->bindParam(":contapagar_numero_documento", $this->contapagar_numero_documento);
            $stmt->bindParam(":contapagar_data_emissao", $this->contapagar_data_emissao);
            $stmt->bindParam(":contapagar_data_vencimento", $this->contapagar_data_vencimento);
            $stmt->bindParam(":contapagar_data_pagamento", $this->contapagar_data_pagamento);
            $stmt->bindParam(":contapagar_valor_duplicata", $this->contapagar_valor_duplicata);
            $stmt->bindParam(":contapagar_valor_total", $this->contapagar_valor_total);
            $stmt->bindParam(":contapagar_descricao", $this->contapagar_descricao);
            $stmt->bindParam(":contapagar_nome_banco", $this->contapagar_nome_banco);
            $stmt->bindParam(":contapagar_numero_agencia", $this->contapagar_numero_agencia);
            $stmt->bindParam(":contapagar_numero_conta", $this->contapagar_numero_conta);
            $stmt->bindParam(":contapagar_data_lancamento", $this->contapagar_data_lancamento);
            $stmt->bindParam(":contapagar_numero_nota_fiscal", $this->contapagar_numero_nota_fiscal);
            $stmt->bindParam(":contapagar_numero_parcela", $this->contapagar_numero_parcela);
            $stmt->bindParam(":contapagar_nosso_numero", $this->contapagar_nosso_numero);


            if($stmt->execute()){

                $movimentacao_contapagar_id = $this->conn->lastInsertId();

                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // RECUPERA O ID CRIADO DA SAIDA, CHECA SE SETADO SALDO ATUAL DE HOJE, E LANCA TAMBEM NA TABELA DE MOVIMENTACOES DE ENTRADA/SAIDAS
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
                              movimentacao_contapagar_id = :movimentacao_contapagar_id,
                              movimentacao_conta_id = :movimentacao_conta_id,
                              movimentacao_caixa_id = :movimentacao_caixa_id,
                              movimentacao_data_lancamento = :movimentacao_data_lancamento,
                              movimentacao_valor_lancamento = :movimentacao_valor_lancamento,
                              movimentacao_referente = :movimentacao_referente";

                $stmt2 = $this->conn->prepare($sqlQuery2);

                ////////////////////////////////////////////////////////////////////
                // ATENCAO: LANCA VALOR A NEGATIVO NA TABELA DE MOVIMENTACAO
                ////////////////////////////////////////////////////////////////////
                $this->contapagar_valor_total = $this->contapagar_valor_total *-1;
                
                $stmt2->bindParam(":movimentacao_caixa_id", $ambiente_caixa_logado);

                $stmt2->bindParam(":movimentacao_contapagar_id", $movimentacao_contapagar_id);
                $stmt2->bindParam(":movimentacao_conta_id", $this->contapagar_conta_id);
                $stmt2->bindParam(":movimentacao_data_lancamento", $this->contapagar_data_lancamento);
                $stmt2->bindParam(":movimentacao_valor_lancamento", $this->contapagar_valor_total);
                $stmt2->bindParam(":movimentacao_referente", $this->contapagar_nome_credor);


                if($stmt2->execute()){
                   return true;
                }
            }
            return false;
        }

        public function consultaContaPagar($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        contapagar_id,
                        contapagar_formapgto_id,
                        contapagar_conta_id,
                        contapagar_categoria_id,
                        contapagar_caixa_id,
                        contapagar_nome_credor,
                        contapagar_numero_duplicata,
                        contapagar_numero_documento,
                        contapagar_data_emissao,
                        contapagar_data_vencimento,
                        contapagar_data_pagamento,
                        contapagar_valor_duplicata,
                        contapagar_valor_juros,
                        contapagar_valor_desconto,
                        contapagar_valor_total,
                        contapagar_descricao,
                        contapagar_nome_banco,
                        contapagar_numero_agencia,
                        contapagar_numero_conta,
                        contapagar_data_lancamento,
                        contapagar_numero_nota_fiscal,
                        contapagar_numero_parcela,
                        contapagar_nosso_numero,
                        contapagar_flag_cancelada,
                        contapagar_flag_estorno_devolucao
                        FROM
                        ". $this->db_table ."
                        WHERE
                        contapagar_id = ?
                        AND contapagar_caixa_id =".$ambiente_caixa_logado."
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->contapagar_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->contapagar_id = $dataRow['contapagar_id'];
            $this->contapagar_formapgto_id = $dataRow['contapagar_formapgto_id'];
            $this->contapagar_conta_id = $dataRow['contapagar_conta_id'];
            $this->contapagar_categoria_id = $dataRow['contapagar_categoria_id'];
            $this->contapagar_caixa_id = $dataRow['contapagar_caixa_id'];
            $this->contapagar_nome_credor = $dataRow['contapagar_nome_credor'];
            $this->contapagar_numero_duplicata = $dataRow['contapagar_numero_duplicata'];
            $this->contapagar_numero_documento = $dataRow['contapagar_numero_documento'];
            $this->contapagar_data_emissao = $dataRow['contapagar_data_emissao'];
            $this->contapagar_data_vencimento = $dataRow['contapagar_data_vencimento'];
            $this->contapagar_data_pagamento = $dataRow['contapagar_data_pagamento'];
            $this->contapagar_valor_duplicata = $dataRow['contapagar_valor_duplicata'];
            $this->contapagar_valor_total = $dataRow['contapagar_valor_total'];
            $this->contapagar_descricao = $dataRow['contapagar_descricao'];
            $this->contapagar_nome_banco = $dataRow['contapagar_nome_banco'];
            $this->contapagar_numero_agencia = $dataRow['contapagar_numero_agencia'];
            $this->contapagar_numero_conta = $dataRow['contapagar_numero_conta'];
            $this->contapagar_data_lancamento = $dataRow['contapagar_data_lancamento'];
            $this->contapagar_numero_nota_fiscal = $dataRow['contapagar_numero_nota_fiscal'];
            $this->contapagar_numero_parcela = $dataRow['contapagar_numero_parcela'];
            $this->contapagar_nosso_numero = $dataRow['contapagar_nosso_numero'];
            
        }        

        public function atualizarContaPagar($ambiente_caixa_logado){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        contapagar_formapgto_id = :contapagar_formapgto_id,
                        contapagar_conta_id = :contapagar_conta_id,
                        contapagar_categoria_id = :contapagar_categoria_id,
                        contapagar_caixa_id = :contapagar_caixa_id,
                        contapagar_nome_credor = :contapagar_nome_credor,
                        contapagar_numero_duplicata = :contapagar_numero_duplicata,
                        contapagar_numero_documento = :contapagar_numero_documento,
                        contapagar_data_emissao = :contapagar_data_emissao,
                        contapagar_data_vencimento = :contapagar_data_vencimento,
                        contapagar_data_pagamento = :contapagar_data_pagamento,
                        contapagar_valor_duplicata = :contapagar_valor_duplicata,
                        contapagar_valor_total = :contapagar_valor_total,
                        contapagar_descricao = :contapagar_descricao,
                        contapagar_nome_banco = :contapagar_nome_banco,
                        contapagar_numero_agencia = :contapagar_numero_agencia,
                        contapagar_numero_conta = :contapagar_numero_conta,
                        contapagar_data_lancamento = :contapagar_data_lancamento,
                        contapagar_numero_nota_fiscal = :contapagar_numero_nota_fiscal,
                        contapagar_numero_parcela = :contapagar_numero_parcela,
                        contapagar_nosso_numero = :contapagar_nosso_numero
                        WHERE
                        contapagar_id = :contapagar_id
                        AND contapagar_caixa_id = :contapagar_caixa_id";

            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->contapagar_formapgto_id=htmlspecialchars(strip_tags($this->contapagar_formapgto_id));
            $this->contapagar_conta_id=htmlspecialchars(strip_tags($this->contapagar_conta_id));
            $this->contapagar_categoria_id=htmlspecialchars(strip_tags($this->contapagar_categoria_id));
            $this->contapagar_caixa_id=htmlspecialchars(strip_tags($this->contapagar_caixa_id));
            $this->contapagar_nome_credor=htmlspecialchars(strip_tags($this->contapagar_nome_credor));
            $this->contapagar_numero_duplicata=htmlspecialchars(strip_tags($this->contapagar_numero_duplicata));
            $this->contapagar_numero_documento=htmlspecialchars(strip_tags($this->contapagar_numero_documento));
            $this->contapagar_data_emissao=htmlspecialchars(strip_tags($this->contapagar_data_emissao));
            $this->contapagar_data_vencimento=htmlspecialchars(strip_tags($this->contapagar_data_vencimento));
            $this->contapagar_data_pagamento=htmlspecialchars(strip_tags($this->contapagar_data_pagamento));
            $this->contapagar_valor_duplicata=htmlspecialchars(strip_tags($this->contapagar_valor_duplicata));
            $this->contapagar_valor_total=htmlspecialchars(strip_tags($this->contapagar_valor_total));
            $this->contapagar_descricao=htmlspecialchars(strip_tags($this->contapagar_descricao));
            $this->contapagar_nome_banco=htmlspecialchars(strip_tags($this->contapagar_nome_banco));
            $this->contapagar_numero_agencia=htmlspecialchars(strip_tags($this->contapagar_numero_agencia));
            $this->contapagar_numero_conta=htmlspecialchars(strip_tags($this->contapagar_numero_conta));
            $this->contapagar_data_lancamento=htmlspecialchars(strip_tags($this->contapagar_data_lancamento));
            $this->contapagar_numero_nota_fiscal=htmlspecialchars(strip_tags($this->contapagar_numero_nota_fiscal));
            $this->contapagar_numero_parcela=htmlspecialchars(strip_tags($this->contapagar_numero_parcela));
            $this->contapagar_nosso_numero=htmlspecialchars(strip_tags($this->contapagar_nosso_numero));

            // TRATAMENTO
            $this->contapagar_descricao=remover_acentos($this->contapagar_descricao);
            $this->contapagar_nome_credor=remover_acentos($this->contapagar_nome_credor);

            $stmt->bindParam(":contapagar_caixa_id", $ambiente_caixa_logado);

            $stmt->bindParam(":contapagar_formapgto_id", $this->contapagar_formapgto_id);
            $stmt->bindParam(":contapagar_conta_id", $this->contapagar_conta_id);
            $stmt->bindParam(":contapagar_categoria_id", $this->contapagar_categoria_id);
            $stmt->bindParam(":contapagar_nome_credor", $this->contapagar_nome_credor);
            $stmt->bindParam(":contapagar_numero_duplicata", $this->contapagar_numero_duplicata);
            $stmt->bindParam(":contapagar_numero_documento", $this->contapagar_numero_documento);
            $stmt->bindParam(":contapagar_data_emissao", $this->contapagar_data_emissao);
            $stmt->bindParam(":contapagar_data_vencimento", $this->contapagar_data_vencimento);
            $stmt->bindParam(":contapagar_data_pagamento", $this->contapagar_data_pagamento);
            $stmt->bindParam(":contapagar_valor_duplicata", $this->contapagar_valor_duplicata);
            $stmt->bindParam(":contapagar_valor_total", $this->contapagar_valor_total);
            $stmt->bindParam(":contapagar_descricao", $this->contapagar_descricao);
            $stmt->bindParam(":contapagar_nome_banco", $this->contapagar_nome_banco);
            $stmt->bindParam(":contapagar_numero_agencia", $this->contapagar_numero_agencia);
            $stmt->bindParam(":contapagar_numero_conta", $this->contapagar_numero_conta);
            $stmt->bindParam(":contapagar_data_lancamento", $this->contapagar_data_lancamento);
            $stmt->bindParam(":contapagar_numero_nota_fiscal", $this->contapagar_numero_nota_fiscal);
            $stmt->bindParam(":contapagar_numero_parcela", $this->contapagar_numero_parcela);
            $stmt->bindParam(":contapagar_nosso_numero", $this->contapagar_nosso_numero);
            
            $stmt->bindParam(":contapagar_id", $this->contapagar_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function excluirContaPagar($ambiente_caixa_logado){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE contapagar_id = ? AND contapagar_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->contapagar_id=htmlspecialchars(strip_tags($this->contapagar_id));
        
            $stmt->bindParam(1, $this->contapagar_id);
        
            if($stmt->execute()){

                $sqlQuery2 = "DELETE FROM movimentacao WHERE movimentacao_contapagar_id = ? AND movimentacao_caixa_id =".$ambiente_caixa_logado;
                $stmt2 = $this->conn->prepare($sqlQuery2);

                $this->contapagar_id=htmlspecialchars(strip_tags($this->contapagar_id));

                $stmt2->bindParam(1, $this->contapagar_id);

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

