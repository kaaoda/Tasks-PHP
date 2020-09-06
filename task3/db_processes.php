<?php
    require_once("utility.php");
    error_reporting(0);
    class Database
    {
        //utility object
        private $util = NULL;
        private const HOST = "localhost";
        private $username;
        private $password;
        private $connection;
        private $dbname;

        public function __construct($name,$pass)
        {
            $this->util = new Utility();
            $this->username = $name;
            $this->password = $pass;
            $this->connection = new mysqli(self::HOST,$this->username,$this->password);
            if($err = $this->connection->connect_error):
                die($this->util->produceErrorMsg("Error when connect to database"));
            endif;
        }

        public function selectDB($name)
        {
            $this->dbname = $name;
            $this->connection->select_db($this->dbname);
        }

        public function createDB($name)
        {
            $command = "CREATE DATABASE IF NOT EXISTS ".$name.";";
            $result = $this->connection->query($command);
            if($result):
                $this->selectDB($name);
                $this->createTable();
            else:
                if($this->connection->error):
                    $this->util->produceErrorMsg("Error in server");
                endif;
            endif;
        }

        private function createTable()
        {
            $command = "
                CREATE TABLE IF NOT EXISTS thirdtask
                (
                    id INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    client_name varchar(225),
                    client_id int(16),
                    deal_name varchar(225),
                    deal_id int(16),
                    hour varchar(32),
                    accepted varchar(32),
                    refused varchar(32)
                );
            ";

            $result = $this->connection->query($command);
            if(!$result):
                $err = $this->connection->error;
                $this->util->produceErrorMsg("Error while manipulating data");
            endif;
        }


        public function insert($data,$table,array $fields)
        {
            $fieldsStr = implode(",",$fields);
            $this->connection->select_db($this->dbname);
            $command = "
                INSERT INTO ".$table."(".$fieldsStr.")
                VALUES (".$data.");
            ";
            $result = $this->connection->query($command);
            if(!$result):
                $err = $this->connection->error;
                $this->util->produceErrorMsg("Error when process record (".$data.")");
            endif;
        }


        public function getData($table)
        {
            if($this->connection->select_db($this->dbname) != FALSE):
                
                $command = "SELECT * FROM ".$table;

                $result = $this->connection->query($command);
                if($result):
                    if($result->num_rows >0):
                        return $result->fetch_all(MYSQLI_ASSOC);
                    else:
                        $this->util->produceWarning("There is no records in database");
                        return NULL;
                    endif;
                else:
                    $err = $this->connection->error;
                    $this->util->produceErrorMsg("Error when get Data");
                endif;

            else:
                $this->util->produceErrorMsg("There is no data!");
            endif;
        }

        

        public function resetDB()
        {
            $command = "DROP DATABASE ".$this->dbname;

            $result = $this->connection->query($command);
            if($result):
                $this->util->produceSuccessMsg("Database has been dropped and all it's data");
            else:
                $err = $this->connection->error;
                $this->util->produceErrorMsg("Error, can't drop database");
            endif;
        }
        
    }

?>