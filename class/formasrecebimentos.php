<?php
    class FormaRecebimento{

        private $conn;

        private $db_table = "formarecebimento";

        public $formarecebimento_id;
        public $formarecebimento_descricao;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarFormaRecebimentos($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        formarecebimento_id,
                        formarecebimento_descricao
                        FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarFormaRecebimento($ambiente_caixa_logado){
        
            $sqlformarecebimento  = " SELECT formarecebimento_id";
            $sqlformarecebimento .= " FROM formarecebimento";
            $sqlformarecebimento .= " WHERE formarecebimento_descricao = '".trim($this->formarecebimento_descricao)."' ";

            $sql = $this->conn->prepare($sqlformarecebimento);
            $sql->execute();

            $formarecebimento_existe = $sql->fetch();

            // CHECK SE JA EXISTE COM ESTA DESCRICAO

            if ($formarecebimento_existe=="") {

                $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                            SET
                            formarecebimento_descricao = :formarecebimento_descricao";

                $stmt = $this->conn->prepare($sqlQuery);

                $this->formarecebimento_descricao=htmlspecialchars(strip_tags($this->formarecebimento_descricao));

                $stmt->bindParam(":formarecebimento_descricao", $this->formarecebimento_descricao);

                if($stmt->execute()){
                   return true;
                }
                return false;


            } else {
              return false;
            }


        }

        public function consultaFormaRecebimento($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        formarecebimento_id,
                        formarecebimento_descricao
                        FROM
                        ". $this->db_table ."
                        WHERE
                        formarecebimento_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->formarecebimento_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->formarecebimento_id = $dataRow['formarecebimento_id'];
            $this->formarecebimento_descricao = $dataRow['formarecebimento_descricao'];
        }        

        public function atualizarFormaRecebimento($ambiente_caixa_logado){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        formarecebimento_descricao = :formarecebimento_descricao
                        WHERE
                        formarecebimento_id = :formarecebimento_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->formarecebimento_descricao=htmlspecialchars(strip_tags($this->formarecebimento_descricao));

            $stmt->bindParam(":formarecebimento_descricao", $this->formarecebimento_descricao);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


    }
?>

