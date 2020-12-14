<?php 

    //include_once '../config/autenticacao_jwt.php';
    
    // DEBUG: TESTE DESENVOLVIMENTO - SEM AUTENTICACAO JWT  (COMENTA ACIMA E DESCOMENTA ABAIXO)
    $ambiente_caixa_logado = "10";

    class Database {

        private $host;
        private $database_name;
        private $username;
        private $password;
        public $conn;

        public function __construct()
        {
            if ($_SERVER['SERVER_NAME'] == "localhost")
            {
                 $this->host = "localhost";
                 $this->database_name = "tecnospeed";
                 $this->username = "root";
                 $this->password = "secret";
            }
            else
            {
                 $this->host = "localhost";
                 $this->database_name = "elizeuco_tecno";
                 $this->username = "elizeuco_tecno";
                 $this->password = "YySc70;FrdE;";
            }
        }




        public function conexao(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Banco nao conectado: " . $exception->getMessage();
            }
            return $this->conn;
        }
        
        public function host() {
            return  $this->host;
        }

        public function db() {
            return  $this->database_name;
        }

        public function user() {
            return  $this->username;
        }

        public function pass() {
            return  $this->password;
        }
    }  
    



?>