<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
use Exception;
use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowInicioView($alert="")
        {
            require_once(VIEWS_PATH."inicio.php");
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }
        
        public function ShowPerfil()
        {
            require_once(VIEWS_PATH."perfil.php");
        }

        public function DestroySession()
        {
            session_destroy();
            $this->Index();
        }

        public function BuscarEmail($email)
        {  try{
            $studentDb =  $this->studentDAO->BuscarEmail($email);
            }
            catch(Exception $ex){
                throw $ex;
            }
            
            return $studentDb;
        }

        public function CargaDb(){

            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Student';

            $header = array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );

            curl_setopt($ch, CURLOPT_URL, $url );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            //var_dump($response);

            $arrayToDecode = json_decode($response , true );
            

            foreach( $arrayToDecode as $valuesArray ){
                foreach( $valuesArray as $arraykey => $arrayvalue){
                    //echo "$arraykey: $arrayvalue <br>";

                    $student = new Student();
                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setCareerid($valuesArray["careerId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setDni($valuesArray["dni"]);
                    $student->setFilenumber($valuesArray["fileNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthdate($valuesArray["birthDate"]);
                    $student->setEmail($valuesArray["email"]);
                    $student->setPhone($valuesArray["phoneNumber"]);
                    $student->setActive($valuesArray["active"]);

                    
                }
                  $this->studentDAO->Add($student);
            }

            $this->Index();
        }

        public function Add( $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber)
        {
            $student = new Student();
           
            $student->setCareerid($careerId);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $student->setDni($dni);
            $student->setFilenumber($fileNumber);
            $student->setGender($gender);
            $student->setBirthdate($birthDate);
            $student->setEmail($email);
            $student->setPhone($phoneNumber);
            $student->setActive(1);

            $this->studentDAO->Add($student);

            $this->ShowAddView();
        }

        public function BuscarXid($idstudent)
        {
            try{
                $student = new Student();

                $student = $this->studentDAO->BuscarXid($idstudent);
                
                return $student;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Login($email="")
        {
            $loggedUser = NULL;

            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Student';

            $header = array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );

            curl_setopt($ch, CURLOPT_URL, $url );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            //var_dump($response);

            $arrayToDecode = json_decode($response , true );
            

            foreach( $arrayToDecode as $valuesArray ){
                foreach( $valuesArray as $arraykey => $arrayvalue){
                    //echo "$arraykey: $arrayvalue <br>";
                
                }
                
                if($valuesArray["email"] == $email ){

                    $student = new Student();
                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setCareerid($valuesArray["careerId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setDni($valuesArray["dni"]);
                    $student->setFilenumber($valuesArray["fileNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthdate($valuesArray["birthDate"]);
                    $student->setEmail($valuesArray["email"]);
                    $student->setPhone($valuesArray["phoneNumber"]);
                    $student->setActive($valuesArray["active"]);
                    $loggedUser = $student;
                }
            }

            if($email == "admin@admin"){

                $loggedAdmin = 1;
            }

            if($loggedAdmin != 0 )
            {   
                $_SESSION["loggedAdmin"] = $loggedAdmin;
                //session_start();
                //header('Empresa/ShowListView');
                //$this->ShowListView();
            }
            elseif($loggedUser != NULL)
                {
                    //session_start();
                    $_SESSION['loggedUser'] = $loggedUser;
                    //header("location:../welcome.php");
                    $this->ShowInicioView();
                        
                }else
                {
                    echo "<script> if(confirm('Verifique que los datos ingresados sean correctos'));";
                    echo "window.location = '../index.php';
                        </script>";
                }
            
        }
    }
?>