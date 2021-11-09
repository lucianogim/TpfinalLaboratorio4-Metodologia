<?php

namespace Controllers;

    use Controllers\EmpresaController as EmpresaController;
    use Controllers\StudentController as StudentController;
    use Models\Student as Student;

    class LoginController
    {
        private $empresaDAO;
        private $studentDAO;

        public function __construct()
        {
            $this->empresaDAO = new EmpresaController();
            $this->studentDAO = new StudentController();
        }
        
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function Login($email="")
        {
            

            $loggedUser = NULL;
            $loggedAdmin = NULL;

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
                    // $student->setStudentId($valuesArray["studentId"]);
                    // $student->setCareerid($valuesArray["careerId"]);
                    // $student->setFirstName($valuesArray["firstName"]);
                    // $student->setLastName($valuesArray["lastName"]);
                    // $student->setDni($valuesArray["dni"]);
                    // $student->setFilenumber($valuesArray["fileNumber"]);
                    // $student->setGender($valuesArray["gender"]);
                    // $student->setBirthdate($valuesArray["birthDate"]);
                    // $student->setEmail($valuesArray["email"]);
                    // $student->setPhone($valuesArray["phoneNumber"]);
                    // $student->setActive($valuesArray["active"]);

                   
                    $student = $this->studentDAO->BuscarEmail($email);
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
                $this->empresaDAO->ShowListView();
            }
            elseif($loggedUser != NULL )
                {   
                    //session_start();
                    $_SESSION['loggedUser'] = $loggedUser;
                    //header("location:../welcome.php");
                    $this->studentDAO->ShowInicioView();
                        
                }else
                {
                    echo "<script> if(confirm('Verifique que los datos ingresados sean correctos'));";
                    echo "window.location = '../index.php';
                        </script>";
                }
            
        }

    }


?>