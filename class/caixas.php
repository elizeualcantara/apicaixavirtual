<?php
    class Caixa{

        private $conn;

        private $db_table = "caixa";

        public $caixa_id;
        public $caixa_identificacao;
        public $caixa_localizacao;
        public $caixa_tecnologia;
        public $caixa_versao_aplicacao;
        public $caixa_data_inicio_movimentacao;
        public $caixa_valor_inicio_movimentacao;
        public $caixa_observacao;
        public $caixa_emissao_razao_social;
        public $caixa_emissao_cnpj;
        public $caixa_emissao_inscricao_estadual;
        public $caixa_emissao_inscricao_municipal;
        public $caixa_contato_suporte;
        public $caixa_telefone_suporte;
        public $caixa_email_suporte;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarCaixas($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        caixa_id,
                        caixa_identificacao,
                        caixa_localizacao,
                        caixa_tecnologia,
                        caixa_versao_aplicacao,
                        caixa_data_inicio_movimentacao,
                        caixa_valor_inicio_movimentacao,
                        caixa_observacao,
                        caixa_emissao_razao_social,
                        caixa_emissao_cnpj,
                        caixa_emissao_inscricao_estadual,
                        caixa_emissao_inscricao_municipal,
                        caixa_contato_suporte,
                        caixa_telefone_suporte,
                        caixa_email_suporte
                        FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarCaixa($ambiente_caixa_logado){
        
            $sqlcaixa  = " SELECT caixa_id";
            $sqlcaixa .= " FROM caixa";
            $sqlcaixa .= " WHERE caixa_identificacao = '".trim($this->caixa_identificacao)."' ";

            $sql = $this->conn->prepare($sqlcaixa);
            $sql->execute();

            $caixa_existe = $sql->fetch();

            // CHECK SE JA EXISTE COM ESTA IDENTIFICACAO

            if ($caixa_existe=="") {

                $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                            SET
                            caixa_identificacao = :caixa_identificacao,
                            caixa_localizacao = :caixa_localizacao,
                            caixa_data_inicio_movimentacao = :caixa_data_inicio_movimentacao,
                            caixa_valor_inicio_movimentacao = :caixa_valor_inicio_movimentacao,
                            caixa_emissao_razao_social = :caixa_emissao_razao_social,
                            caixa_emissao_cnpj = :caixa_emissao_cnpj,
                            caixa_versao_aplicacao = :caixa_versao_aplicacao,
                            caixa_observacao = :caixa_observacao";

                /*
                $sqlQuery .= ",
                            caixa_tecnologia = :caixa_tecnologia,
                            caixa_emissao_inscricao_estadual = :caixa_emissao_inscricao_estadual,
                            caixa_emissao_inscricao_municipal = :caixa_emissao_inscricao_municipal,
                            caixa_contato_suporte = :caixa_contato_suporte,
                            caixa_telefone_suporte = :caixa_telefone_suporte,
                            caixa_email_suporte = :caixa_email_suporte";
                */

                $stmt = $this->conn->prepare($sqlQuery);

                $this->caixa_identificacao=htmlspecialchars(strip_tags($this->caixa_identificacao));
                $this->caixa_localizacao=htmlspecialchars(strip_tags($this->caixa_localizacao));
                $this->caixa_data_inicio_movimentacao=htmlspecialchars(strip_tags($this->caixa_data_inicio_movimentacao));
                $this->caixa_valor_inicio_movimentacao=htmlspecialchars(strip_tags($this->caixa_valor_inicio_movimentacao));
                $this->caixa_emissao_razao_social=htmlspecialchars(strip_tags($this->caixa_emissao_razao_social));
                $this->caixa_emissao_cnpj=htmlspecialchars(strip_tags($this->caixa_emissao_cnpj));
                $this->caixa_versao_aplicacao=htmlspecialchars(strip_tags($this->caixa_versao_aplicacao));
                $this->caixa_observacao=htmlspecialchars(strip_tags($this->caixa_observacao));

                /*
                $this->caixa_tecnologia=htmlspecialchars(strip_tags($this->caixa_tecnologia));
                $this->caixa_emissao_inscricao_estadual=htmlspecialchars(strip_tags($this->caixa_emissao_inscricao_estadual));
                $this->caixa_emissao_inscricao_municipal=htmlspecialchars(strip_tags($this->caixa_emissao_inscricao_municipal));
                $this->caixa_contato_suporte=htmlspecialchars(strip_tags($this->caixa_contato_suporte));
                $this->caixa_telefone_suporte=htmlspecialchars(strip_tags($this->caixa_telefone_suporte));
                $this->caixa_email_suporte=htmlspecialchars(strip_tags($this->caixa_email_suporte));
                */

                $stmt->bindParam(":caixa_identificacao", $this->caixa_identificacao);
                $stmt->bindParam(":caixa_localizacao", $this->caixa_localizacao);
                $stmt->bindParam(":caixa_data_inicio_movimentacao", $this->caixa_data_inicio_movimentacao);
                $stmt->bindParam(":caixa_valor_inicio_movimentacao", $this->caixa_valor_inicio_movimentacao);
                $stmt->bindParam(":caixa_emissao_razao_social", $this->caixa_emissao_razao_social);
                $stmt->bindParam(":caixa_emissao_cnpj", $this->caixa_emissao_cnpj);
                $stmt->bindParam(":caixa_versao_aplicacao", $this->caixa_versao_aplicacao);
                $stmt->bindParam(":caixa_observacao", $this->caixa_observacao);

                /*
                $stmt->bindParam(":caixa_tecnologia", $this->caixa_tecnologia);
                $stmt->bindParam(":caixa_emissao_inscricao_estadual", $this->caixa_emissao_inscricao_estadual);
                $stmt->bindParam(":caixa_emissao_inscricao_municipal", $this->caixa_emissao_inscricao_municipal);
                $stmt->bindParam(":caixa_contato_suporte", $this->caixa_contato_suporte);
                $stmt->bindParam(":caixa_telefone_suporte", $this->caixa_telefone_suporte);
                $stmt->bindParam(":caixa_email_suporte", $this->caixa_email_suporte);
                */

                if($stmt->execute()){
                   return true;
                }
                return false;


            } else {
              return false;
            }
            
        }

        public function consultaCaixa($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        caixa_id,
                        caixa_identificacao,
                        caixa_localizacao,
                        caixa_tecnologia,
                        caixa_versao_aplicacao,
                        caixa_data_inicio_movimentacao,
                        caixa_valor_inicio_movimentacao,
                        caixa_observacao,
                        caixa_emissao_razao_social,
                        caixa_emissao_cnpj,
                        caixa_emissao_inscricao_estadual,
                        caixa_emissao_inscricao_municipal,
                        caixa_contato_suporte,
                        caixa_telefone_suporte,
                        caixa_email_suporte
                        FROM
                        ". $this->db_table ."
                        WHERE
                        caixa_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->caixa_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->caixa_id = $dataRow['caixa_id'];
            $this->caixa_identificacao = $dataRow['caixa_identificacao'];
            $this->caixa_localizacao = $dataRow['caixa_localizacao'];
            $this->caixa_tecnologia = $dataRow['caixa_tecnologia'];
            $this->caixa_versao_aplicacao = $dataRow['caixa_versao_aplicacao'];
            $this->caixa_data_inicio_movimentacao = $dataRow['caixa_data_inicio_movimentacao'];
            $this->caixa_valor_inicio_movimentacao = $dataRow['caixa_valor_inicio_movimentacao'];
            $this->caixa_observacao = $dataRow['caixa_observacao'];
            $this->caixa_emissao_razao_social = $dataRow['caixa_emissao_razao_social'];
            $this->caixa_emissao_cnpj = $dataRow['caixa_emissao_cnpj'];
            $this->caixa_emissao_inscricao_estadual = $dataRow['caixa_emissao_inscricao_estadual'];
            $this->caixa_emissao_inscricao_municipal = $dataRow['caixa_emissao_inscricao_municipal'];
            $this->caixa_contato_suporte = $dataRow['caixa_contato_suporte'];
            $this->caixa_telefone_suporte = $dataRow['caixa_telefone_suporte'];
            $this->caixa_email_suporte = $dataRow['caixa_email_suporte'];
        }

        public function atualizarCaixa($ambiente_caixa_logado){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        caixa_identificacao = :caixa_identificacao,
                        caixa_localizacao = :caixa_localizacao,
                        caixa_tecnologia = :caixa_tecnologia,
                        caixa_versao_aplicacao = :caixa_versao_aplicacao,
                        caixa_data_inicio_movimentacao = :caixa_data_inicio_movimentacao,
                        caixa_valor_inicio_movimentacao = :caixa_valor_inicio_movimentacao,
                        caixa_observacao = :caixa_observacao,
                        caixa_emissao_razao_social = :caixa_emissao_razao_social,
                        caixa_emissao_cnpj = :caixa_emissao_cnpj,
                        caixa_emissao_inscricao_estadual = :caixa_emissao_inscricao_estadual,
                        caixa_emissao_inscricao_municipal = :caixa_emissao_inscricao_municipal,
                        caixa_contato_suporte = :caixa_contato_suporte,
                        caixa_telefone_suporte = :caixa_telefone_suporte,
                        caixa_email_suporte = :caixa_email_suporte
                        WHERE
                        caixa_id = :caixa_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->caixa_identificacao=htmlspecialchars(strip_tags($this->caixa_identificacao));
            $this->caixa_localizacao=htmlspecialchars(strip_tags($this->caixa_localizacao));
            $this->caixa_tecnologia=htmlspecialchars(strip_tags($this->caixa_tecnologia));
            $this->caixa_versao_aplicacao=htmlspecialchars(strip_tags($this->caixa_versao_aplicacao));
            $this->caixa_data_inicio_movimentacao=htmlspecialchars(strip_tags($this->caixa_data_inicio_movimentacao));
            $this->caixa_valor_inicio_movimentacao=htmlspecialchars(strip_tags($this->caixa_valor_inicio_movimentacao));
            $this->caixa_observacao=htmlspecialchars(strip_tags($this->caixa_observacao));
            $this->caixa_emissao_razao_social=htmlspecialchars(strip_tags($this->caixa_emissao_razao_social));
            $this->caixa_emissao_cnpj=htmlspecialchars(strip_tags($this->caixa_emissao_cnpj));
            $this->caixa_emissao_inscricao_estadual=htmlspecialchars(strip_tags($this->caixa_emissao_inscricao_estadual));
            $this->caixa_emissao_inscricao_municipal=htmlspecialchars(strip_tags($this->caixa_emissao_inscricao_municipal));
            $this->caixa_contato_suporte=htmlspecialchars(strip_tags($this->caixa_contato_suporte));
            $this->caixa_telefone_suporte=htmlspecialchars(strip_tags($this->caixa_telefone_suporte));
            $this->caixa_email_suporte=htmlspecialchars(strip_tags($this->caixa_email_suporte));

            // PERMISSAO PARA SOMENTE ATUALIZAR OS SEUS PROPRIOS DADOS DO CAIXA
            $stmt->bindParam(":caixa_id", $ambiente_caixa_logado);

            $stmt->bindParam(":caixa_identificacao", $this->caixa_identificacao);
            $stmt->bindParam(":caixa_localizacao", $this->caixa_localizacao);
            $stmt->bindParam(":caixa_tecnologia", $this->caixa_tecnologia);
            $stmt->bindParam(":caixa_versao_aplicacao", $this->caixa_versao_aplicacao);
            $stmt->bindParam(":caixa_data_inicio_movimentacao", $this->caixa_data_inicio_movimentacao);
            $stmt->bindParam(":caixa_valor_inicio_movimentacao", $this->caixa_valor_inicio_movimentacao);
            $stmt->bindParam(":caixa_observacao", $this->caixa_observacao);
            $stmt->bindParam(":caixa_emissao_razao_social", $this->caixa_emissao_razao_social);
            $stmt->bindParam(":caixa_emissao_cnpj", $this->caixa_emissao_cnpj);
            $stmt->bindParam(":caixa_emissao_inscricao_estadual", $this->caixa_emissao_inscricao_estadual);
            $stmt->bindParam(":caixa_emissao_inscricao_municipal", $this->caixa_emissao_inscricao_municipal);
            $stmt->bindParam(":caixa_contato_suporte", $this->caixa_contato_suporte);
            $stmt->bindParam(":caixa_telefone_suporte", $this->caixa_telefone_suporte);
            $stmt->bindParam(":caixa_email_suporte", $this->caixa_email_suporte);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

    }
?>

