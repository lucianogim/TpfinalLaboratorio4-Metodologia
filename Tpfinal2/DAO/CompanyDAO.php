<?php
    namespace DAO;

    use \FFI\Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Company as Company;

    class CompanyDAO 
    {   
        private $connection;
        private $tableName = "company";
        //private $studentList = array();

        public function Add(Company $company)
        {
           
            try
            {   
                $query = "INSERT INTO ".$this->tableName." ( email, idEmpresa, active ) 
                                                            VALUES ( :email, :idEmpresa, :active)";
                
                $parameters["email"] = $company->getEmail();
                $parameters["idEmpresa"] = $company->getIdEmpresa();
                $parameters["active"] = $company->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            
            try
            {
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setId($row["id"]);
                    $company->setEmail($row["email"]);
                    $company->setIdEmpresa($row["idEmpresa"]);
                    $company->setActive($row["active"]);

                    array_push($companyList, $company);
                }

                return $companyList;
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
                $student = new Company();
                
                $query = "SELECT * FROM student WHERE email = :email ";
                //"SELECT * FROM ".$this->tableName;
                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {
                    // $student->setStudentId($row["studentId"]);
                    // $student->setCareerid($row["careerId"]);
                    // $student->setFirstName($row["firstName"]);
                    // $student->setLastName($row["lastName"]);
                    // $student->setDni($row["dni"]);
                    // $student->setFilenumber($row["fileNumber"]);
                    // $student->setGender($row["gender"]);
                    // $student->setBirthdate($row["birthdate"]);
                    // $student->setEmail($row["email"]);
                    // $student->setPhone($row["phone"]);
                    // $student->setActive($row["active"]);
                }
                return $student;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>