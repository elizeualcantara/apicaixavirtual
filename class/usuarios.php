<?php
    class Usuario{

        private $conn;

        private $db_table = "usuario";

        public $usuario_id;
        public $usuario_caixa_id;
        public $usuario_login;
        public $usuario_senha;
        public $usuario_email;
        public $usuario_nome;
        public $usuario_primeiro_nome;
        public $usuario_ativo;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listarUsuarios($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        usuario_id,
                        usuario_caixa_id,
                        usuario_login,
                        usuario_senha,
                        usuario_email,
                        usuario_nome,
                        usuario_primeiro_nome,
                        usuario_ativo
                        FROM " . $this->db_table . "
                        WHERE usuario_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function criarUsuario($ambiente_caixa_logado){
        
            $sqlusuario  = " SELECT usuario_id";
            $sqlusuario .= " FROM usuario";
            $sqlusuario .= " WHERE usuario_login = '".trim($this->usuario_login)."' ";

            $sql = $this->conn->prepare($sqlusuario);
            $sql->execute();

            $usuario_existe = $sql->fetch();

            // CHECK SE JA EXISTE COM ESTE LOGIN

            if ($usuario_existe=="") {

                $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                            SET
                            usuario_caixa_id = :usuario_caixa_id,
                            usuario_login = :usuario_login,
                            usuario_senha = :usuario_senha,
                            usuario_email = :usuario_email,
                            usuario_nome = :usuario_nome,
                            usuario_primeiro_nome = :usuario_primeiro_nome";

                $stmt = $this->conn->prepare($sqlQuery);

                $this->usuario_caixa_id=htmlspecialchars(strip_tags($this->usuario_caixa_id));
                $this->usuario_login=htmlspecialchars(strip_tags($this->usuario_login));
                $this->usuario_senha=htmlspecialchars(strip_tags($this->usuario_senha));
                $this->usuario_email=htmlspecialchars(strip_tags($this->usuario_email));
                $this->usuario_nome=htmlspecialchars(strip_tags($this->usuario_nome));
                $this->usuario_primeiro_nome=htmlspecialchars(strip_tags($this->usuario_primeiro_nome));

                $stmt->bindParam(":usuario_caixa_id", $ambiente_caixa_logado);

                $stmt->bindParam(":usuario_login", $this->usuario_login);
                $stmt->bindParam(":usuario_senha", $this->usuario_senha);
                $stmt->bindParam(":usuario_email", $this->usuario_email);
                $stmt->bindParam(":usuario_nome", $this->usuario_nome);
                $stmt->bindParam(":usuario_primeiro_nome", $this->usuario_primeiro_nome);

                if($stmt->execute()){
                   return true;
                }
                return false;


            } else {
              return false;
            }
            
        }

        public function consultaUsuario($ambiente_caixa_logado){
            $sqlQuery = "SELECT
                        usuario_id,
                        usuario_caixa_id,
                        usuario_login,
                        usuario_senha,
                        usuario_email,
                        usuario_nome,
                        usuario_primeiro_nome,
                        usuario_ativo
                        FROM
                        ". $this->db_table ."
                        WHERE
                        usuario_id = ?
                        AND usuario_caixa_id =".$ambiente_caixa_logado."
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->usuario_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->usuario_id = $dataRow['usuario_id'];
            $this->usuario_caixa_id = $dataRow['usuario_caixa_id'];
            $this->usuario_login = $dataRow['usuario_login'];
            $this->usuario_senha = $dataRow['usuario_senha'];
            $this->usuario_email = $dataRow['usuario_email'];
            $this->usuario_nome = $dataRow['usuario_nome'];
            $this->usuario_primeiro_nome = $dataRow['usuario_primeiro_nome'];
            $this->usuario_ativo = $dataRow['usuario_ativo'];
        }        

        public function atualizarUsuario($ambiente_caixa_logado){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        usuario_login = :usuario_login,
                        usuario_senha = :usuario_senha,
                        usuario_email = :usuario_email,
                        usuario_nome = :usuario_nome,
                        usuario_primeiro_nome = :usuario_primeiro_nome,
                        usuario_ativo = :usuario_ativo
                        WHERE
                        usuario_id = :usuario_id
                        AND usuario_caixa_id = :usuario_caixa_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->usuario_caixa_id=htmlspecialchars(strip_tags($this->usuario_caixa_id));
            $this->usuario_login=htmlspecialchars(strip_tags($this->usuario_login));
            $this->usuario_senha=htmlspecialchars(strip_tags($this->usuario_senha));
            $this->usuario_email=htmlspecialchars(strip_tags($this->usuario_email));
            $this->usuario_nome=htmlspecialchars(strip_tags($this->usuario_nome));
            $this->usuario_primeiro_nome=htmlspecialchars(strip_tags($this->usuario_primeiro_nome));
            $this->usuario_ativo=htmlspecialchars(strip_tags($this->usuario_ativo));

            $stmt->bindParam(":usuario_caixa_id", $ambiente_caixa_logado);
            
            $stmt->bindParam(":usuario_login", $this->usuario_login);
            $stmt->bindParam(":usuario_senha", $this->usuario_senha);
            $stmt->bindParam(":usuario_email", $this->usuario_email);
            $stmt->bindParam(":usuario_nome", $this->usuario_nome);
            $stmt->bindParam(":usuario_primeiro_nome", $this->usuario_primeiro_nome);
            $stmt->bindParam(":usuario_ativo", $this->usuario_ativo);
            $stmt->bindParam(":usuario_id", $this->usuario_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function excluirUsuario($ambiente_caixa_logado){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE usuario_id = ? AND usuario_caixa_id =".$ambiente_caixa_logado;
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->usuario_id=htmlspecialchars(strip_tags($this->usuario_id));
        
            $stmt->bindParam(1, $this->usuario_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

