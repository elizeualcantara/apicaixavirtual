<?php
    class FormaPgto{

        private $conn;

        private $db_table = "formapgto";

        public $formapgto_id;
        public $formapgto_descricao;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarFormaPgtos($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        formapgto_id,
                        formapgto_descricao
                        FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarFormaPgto($ambiente_caixa_logado){
        
            $sqlformapgto  = " SELECT formapgto_id";
            $sqlformapgto .= " FROM formapgto";
            $sqlformapgto .= " WHERE formapgto_descricao = '".trim($this->formapgto_descricao)."' ";

            $sql = $this->conn->prepare($sqlformapgto);
            $sql->execute();

            $formapgto_existe = $sql->fetch();

            // CHECK SE JA EXISTE COM ESTA DESCRICAO

            if ($formapgto_existe=="") {

                $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                            SET
                            formapgto_descricao = :formapgto_descricao";

                $stmt = $this->conn->prepare($sqlQuery);

                $this->formapgto_descricao=htmlspecialchars(strip_tags($this->formapgto_descricao));

                $stmt->bindParam(":formapgto_descricao", $this->formapgto_descricao);

                if($stmt->execute()){
                   return true;
                }
                return false;

            } else {
              return false;
            }
            
        }

        public function consultaFormaPgto($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        formapgto_id,
                        formapgto_descricao
                        FROM
                        ". $this->db_table ."
                        WHERE
                        formapgto_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->formapgto_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->formapgto_id = $dataRow['formapgto_id'];
            $this->formapgto_descricao = $dataRow['formapgto_descricao'];
        }        

        public function atualizarFormaPgto($ambiente_caixa_logado){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        formapgto_descricao = :formapgto_descricao
                        WHERE
                        formapgto_id = :formapgto_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->formapgto_descricao=htmlspecialchars(strip_tags($this->formapgto_descricao));

            $stmt->bindParam(":formapgto_descricao", $this->formapgto_descricao);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


    }
?>

