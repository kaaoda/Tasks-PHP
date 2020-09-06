<?php
    error_reporting(0);
    class Database
    {
        private const HOST = "sql209.eb2a.com";
        private const NAME = "eb2a_26636227";
        private const PASSWORD = "asemasem99";
        private $connection;
        private $dbname;

        public function __construct($dbname)
        {
            $this->dbname = $dbname;
            $this->connection = new mysqli(self::HOST,self::NAME,self::PASSWORD,$this->dbname);
            if($this->connection->connect_error) :
                echo("Error when connect to database");
            endif;
        }



        public function insert(array $data)
        {
            $getUserData = $this->getData($data["email"]);
            if($getUserData != NULL && $getUserData['email'] == $data["email"]):
                return "Member already registerd";
            else:
                $command = $this->connection->prepare("INSERT INTO users(name,email,pass,phone,addr)VALUES (?,?,?,?,?)");
                if($command !== FALSE):
                    $command->bind_param("sssss"
                                        ,$this->connection->real_escape_string($data['name'])
                                        ,$this->connection->real_escape_string($data['email'])
                                        ,$this->connection->real_escape_string($data['pass'])
                                        ,$this->connection->real_escape_string($data['phone'])
                                        ,$this->connection->real_escape_string($data['addr'])
                                        );
                    $result = $command->execute();
                    if($result === FALSE):
                        return "Can't signup, Error when connecting to server";
                    else:
                        return "Done, Thank you";
                    endif;
                else:
                    return "Can't signup, Error when connecting to server";
                endif;
            endif;
        }


        public function getData($email)
        {
            $command = "SELECT email FROM users WHERE email = '$email'";
            $result = $this->connection->query($command);
            if($result):
                if($result->num_rows > 0):
                    return $result->fetch_assoc();
                else:
                    return NULL;
                endif;
            else:
                return NULL;
            endif;
        }

        public function login($email,$pass)
        {
            $command = 
            "SELECT name
             FROM users 
             WHERE email='$email' 
             AND pass='$pass';";
            $result = $this->connection->query($command);
            if($result):
                if($result->num_rows > 0):
                    $data = $result->fetch_assoc();
                    return $data['name'];
                else:
                    return "Error, There is no member with this data or the data you entered is wrong";
                endif;
            else:
                return "Error when connecting to server";
            endif;
        }

        

    }

?>