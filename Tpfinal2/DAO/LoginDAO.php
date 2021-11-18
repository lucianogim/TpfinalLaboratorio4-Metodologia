<?php
    namespace DAO;

    use \FFI\Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Company;

class LoginDAO 
    {   
        private $connection;
        private $tableName = "admin";
        //private $studentList = array();

        public function EmailAdmin()
        {
            try
            {
                $emaillist =  array();
                
                $query = "SELECT email FROM $this->tableName";
                //"SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
                    $email = $row["email"];

                    array_push($emaillist , $email);
                }
                
                return $emaillist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }


        }

        public function BuscarEmail($email)
        {
            
            try
            {
                $company = new Company();
                
                $query = "SELECT * FROM company WHERE email = :email ";
                //"SELECT * FROM ".$this->tableName;
                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {
                    $company->setId($row["id"]);
                    $company->setIdEmpresa($row["idEmpresa"]);
                    $company->setEmail($row["email"]);
                    $company->setActive($row["active"]);
                }
                return $company;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }

?>