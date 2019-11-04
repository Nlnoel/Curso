<?php

    class Conexao{

        private $objConn;

        function __construct(){
            
            $host   = "mysql:host=localhost";
            $db     = "";
            $pass   = "";
            $user   = "root";


            try{

                $this->objConn = new PDO("$host;dbname=$db", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
            } catch(Exception $e){

                throw new Exception("Erro ao tentar conectar com o banco de dados", 1);
                
            }

        }

        public function run($strSql, $arrVal = array()){

			if (!empty($arrVal)) {

				$stm = $this->objConn->prepare($strSql);

				if (!$stm->execute($arrVal)) {

					$arrError = $stm->errorInfo();

					throw new Exception($arrError[2], 1);
					
				}

				return $stm;

			}
			else{

				if ($stm = $this->objConn->query($strSql)) {
                    return $stm;
                    
				}

				$arrError = $this->objConn->errorInfo();

				throw new Exception($arrError[2], 1);
				
			}	

		}

    }