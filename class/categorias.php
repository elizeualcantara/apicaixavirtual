<?php
    class Categoria{

        private $conn;

        private $db_table = "categoria";

        public $categoria_id;
        public $categoria_movimentacao;
        public $categoria_flag_entrada_saida;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarCategorias(){
            $sqlQuery = "SELECT
                         categoria_id,
                         categoria_movimentacao,
                         categoria_flag_entrada_saida,
                         categoria_flag_atualiza_saldo,
                         categoria_flag_ativo
                         FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarCategoria(){
        
            $sqlcategoria  = " SELECT categoria_id";
            $sqlcategoria .= " FROM categoria";
            $sqlcategoria .= " WHERE categoria_movimentacao = '".trim($this->categoria_movimentacao)."' ";

            $sql = $this->conn->prepare($sqlcategoria);
            $sql->execute();

            $categoria_existe = $sql->fetch();

            // CHECK SE JA EXISTE COM ESTA DESCRICAO

            if ($categoria_existe=="") {

                $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                            SET
                            categoria_movimentacao = :categoria_movimentacao,
                            categoria_flag_entrada_saida = :categoria_flag_entrada_saida";

                $stmt = $this->conn->prepare($sqlQuery);

                $this->categoria_movimentacao=htmlspecialchars(strip_tags($this->categoria_movimentacao));
                $this->categoria_flag_entrada_saida=htmlspecialchars(strip_tags($this->categoria_flag_entrada_saida));

                $stmt->bindParam(":categoria_movimentacao", $this->categoria_movimentacao);
                $stmt->bindParam(":categoria_flag_entrada_saida", $this->categoria_flag_entrada_saida);

                if($stmt->execute()){
                   return true;
                }
                return false;

            } else {
              return false;
            }
            
            
        }

        public function consultaCategoria(){
            $sqlQuery = "SELECT
                        categoria_id,
                        categoria_movimentacao,
                        categoria_flag_entrada_saida,
                        categoria_flag_atualiza_saldo,
                        categoria_flag_ativo
                        FROM
                        ". $this->db_table ."
                        WHERE
                        categoria_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->categoria_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->categoria_id = $dataRow['categoria_id'];
            $this->categoria_movimentacao = $dataRow['categoria_movimentacao'];
            $this->categoria_flag_entrada_saida = $dataRow['categoria_flag_entrada_saida'];
            $this->categoria_flag_atualiza_saldo = $dataRow['categoria_flag_atualiza_saldo'];
            $this->categoria_flag_ativo = $dataRow['categoria_flag_ativo'];
        }        

        public function atualizarCategoria(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        categoria_movimentacao = :categoria_movimentacao,
                        categoria_flag_entrada_saida = :categoria_flag_entrada_saida
                        WHERE
                        categoria_id = :categoria_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->categoria_movimentacao=htmlspecialchars(strip_tags($this->categoria_movimentacao));
            $this->categoria_flag_entrada_saida=htmlspecialchars(strip_tags($this->categoria_flag_entrada_saida));

            $stmt->bindParam(":categoria_movimentacao", $this->categoria_movimentacao);
            $stmt->bindParam(":categoria_flag_entrada_saida", $this->categoria_flag_entrada_saida);
            $stmt->bindParam(":categoria_id", $this->categoria_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function excluirCategoria(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE categoria_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->categoria_id=htmlspecialchars(strip_tags($this->categoria_id));
        
            $stmt->bindParam(1, $this->categoria_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

