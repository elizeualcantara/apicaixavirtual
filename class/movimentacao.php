<?php
    class Movimentacao{

        private $conn;
        
        private $db_table = "movimentacao";

        public $movimentacao_id;
        public $movimentacao_contareceber_id;
        public $movimentacao_contapagar_id;
        public $movimentacao_conta_id;
        public $movimentacao_caixa_id;
        public $movimentacao_data_lancamento;
        public $movimentacao_valor_lancamento;
        public $movimentacao_referente;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarMovimentacao($ambiente_caixa_logado){

            $sqlQuery = "SELECT
                         movimentacao_id,
                         movimentacao_contareceber_id,
                         movimentacao_contapagar_id,
                         movimentacao_conta_id,
                         movimentacao_caixa_id,
                         movimentacao_data_lancamento,
                         movimentacao_valor_lancamento,
                         movimentacao_referente
                         FROM " . $this->db_table . "
                         WHERE movimentacao_caixa_id =". $ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function consultaMovimentacao($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                         movimentacao_id,
                         movimentacao_contareceber_id,
                         movimentacao_contapagar_id,
                         movimentacao_conta_id,
                         movimentacao_caixa_id,
                         movimentacao_data_lancamento,
                         movimentacao_valor_lancamento,
                         movimentacao_referente
                        FROM
                        ". $this->db_table ."
                        WHERE
                        movimentacao_id = ?
                        AND movimentacao_caixa_id =".$ambiente_caixa_logado."
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->movimentacao_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->movimentacao_id = $dataRow['movimentacao_id'];
            $this->movimentacao_contareceber_id = $dataRow['movimentacao_contareceber_id'];
            $this->movimentacao_contapagar_id = $dataRow['movimentacao_contapagar_id'];
            $this->movimentacao_conta_id = $dataRow['movimentacao_conta_id'];
            $this->movimentacao_caixa_id = $dataRow['movimentacao_caixa_id'];
            $this->movimentacao_data_lancamento = $dataRow['movimentacao_data_lancamento'];
            $this->movimentacao_valor_lancamento = $dataRow['movimentacao_valor_lancamento'];
            $this->movimentacao_referente = $dataRow['movimentacao_referente'];
        }


    }

    
    class Saldo{

        private $conn;

        private $db_table = "conta";

        public $conta_id;
        public $conta_caixa_id;
        public $conta_numero_banco;
        public $conta_nome_banco;
        public $conta_valor_saldo_atual;
        public $conta_data_atual;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarMovimentacao($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                         conta_id,
                         conta_caixa_id,
                         conta_numero_banco,
                         conta_nome_banco,
                         conta_valor_saldo_atual,
                         conta_data_atual
                         FROM " . $this->db_table . "
                         WHERE conta_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

    }
?>

