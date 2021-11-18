<?php
    namespace DAO;

    use \FFI\Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {   
        private $connection;
        private $tableName = "student";
        //private $studentList = array();

        public function Add(Student $student)
        {
           
            try
            {   
                $active=0;
                $query = "INSERT INTO ".$this->tableName." ( careerId, firstName, lastName, dni, fileNumber, 
                                                            gender, birthdate, email, phone, active ) 
                                                            VALUES ( :careerId, :firstName, :lastName, :dni, :fileNumber, :gender,
                                                             :birthdate, :email, :phone, :active);";
                
                //$parameters["studentId"] = $student->getStudentId();
                $parameters["careerId"] = $student->getCareerid();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["dni"] = $student->getDni();
                $parameters["fileNumber"] = $student->getFilenumber();
                $parameters["gender"] = $student->getGender();
                $parameters["birthdate"] = $student->getBirthdate();
                $parameters["email"] = $student->getEmail();
                $parameters["phone"] = $student->getPhone();
                if(  $student->getActive())
                    $active = 1;
                else
                    $active = 0;

                $parameters["active"] = $active;


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
                $studentList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setStudentId($row["studentId"]);
                    $student->setCareerid($row["careerID"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFilenumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthdate($row["birthdate"]);
                    $student->setEmail($row["email"]);
                    $student->setPhone($row["phoneNumber"]);
                    $student->setActive($row["active"]);

                    array_push($studentList, $student);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function BuscarXid($idstudent)
        { 
            try
            {
                $student = new Student();

                $query = "SELECT * FROM $this->tableName WHERE studentId = :studentId";

                $parameters['studentId'] = $idstudent; 

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setStudentId($row["studentId"]);
                    $student->setCareerid($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFilenumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthdate($row["birthdate"]);
                    $student->setEmail($row["email"]);
                    $student->setPhone($row["phone"]);
                    $student->setActive($row["active"]);

                }
                return $student;
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
                $student = new Student();
                
                $query = "SELECT * FROM student WHERE email = :email ";
                //"SELECT * FROM ".$this->tableName;
                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {
                    $student->setStudentId($row["studentId"]);
                    $student->setCareerid($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFilenumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthdate($row["birthdate"]);
                    $student->setEmail($row["email"]);
                    $student->setPhone($row["phone"]);
                    $student->setActive($row["active"]);
                }
                return $student;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        // private function SaveData()
        // {
        //     $arrayToEncode = array();

        //     foreach($this->studentList as $student)
        //     {
        //         $valuesArray["studentId"] = $student->getStudentId();
        //         $valuesArray["careerId"] = $student->getCareerid();
        //         $valuesArray["firstName"] = $student->getFirstName();
        //         $valuesArray["lastName"] = $student->getLastName();
        //         $valuesArray["dni"] = $student->getDni();
        //         $valuesArray["fileNumber"] = $student->getFilenumber();
        //         $valuesArray["gender"] = $student->getGender();
        //         $valuesArray["birthDate"] = $student->getBirthdate();
        //         $valuesArray["email"] = $student->getEmail();
        //         $valuesArray["phoneNumber"] = $student->getPhone();
        //         $valuesArray["active"] = $student->getActive();

        //         array_push($arrayToEncode, $valuesArray);
        //     }

        //     $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
        //     file_put_contents('Data/students.json', $jsonContent);
        // }

        // private function RetrieveData()
        // {
        //     $this->studentList = array();

        //     if(file_exists('Data/students.json'))
        //     {
        //         $jsonContent = file_get_contents('Data/students.json');

        //         $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        //         foreach($arrayToDecode as $valuesArray)
        //         {
        //             $student = new Student();
        //             $student->setStudentId($valuesArray["studentId"]);
        //             $student->setCareerid($valuesArray["careerId"]);
        //             $student->setFirstName($valuesArray["firstName"]);
        //             $student->setLastName($valuesArray["lastName"]);
        //             $student->setDni($valuesArray["dni"]);
        //             $student->setFilenumber($valuesArray["fileNumber"]);
        //             $student->setGender($valuesArray["gender"]);
        //             $student->setBirthdate($valuesArray["birthDate"]);
        //             $student->setEmail($valuesArray["email"]);
        //             $student->setPhone($valuesArray["phoneNumber"]);
        //             $student->setActive($valuesArray["active"]);
                    
        //             array_push($this->studentList, $student);
        //         }
        //     }
        // }

    }
?>