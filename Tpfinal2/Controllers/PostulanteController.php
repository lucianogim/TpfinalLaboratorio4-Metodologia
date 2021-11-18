<?php
    namespace Controllers;

    use DAO\PostulanteDAO as PostulanteDAO;
    use Exception;
    use Models\Postulante as Postulante;
    use Models\Student as Student;
    use Controllers\StudentController as StudentController;

class PostulanteController
    {   
        
        private $postulanteDAO;

        public function __construct()
        {
            $this->postulanteDAO = new PostulanteDAO();
        }

        public function Index($alert = "")
        {
            require_once(VIEWS_PATH."inicio.php");
        }

        public function ViewCargaCV($alert="")
        {   
            require_once(VIEWS_PATH."carga-cv.php");
        }

        public function CargaCV($idJobOffer , $alert="")
        {
            require_once(VIEWS_PATH."carga-cv.php");
        }


        public function Add($cv)
        {       
            $alert="";
            $control=0;
            $student = $_SESSION["loggedUser"];
            $idJobOffer = $_SESSION["idjoboffer"];
            $maxpostulantes = 0;
    
            $name = $_FILES["cv"]["name"];
            $ruta = "Data/".date("m-d-y")."-".date("H-i-s")."-".$name;

            $postulanteList = $this->postulanteDAO->GetAll();

            $count = $this->postulanteDAO->ContarId($idJobOffer);

            try{
                $maxpostulantes = $this->postulanteDAO->BuscarMaxPostulantes($idJobOffer);
                    
            }
            catch(Exception $ex){
                echo $ex->getMessage();
            }
            
            if( $maxpostulantes <= $count )
            {
                $alert = "Max de postulantes alcanzado";
                $this->Index($alert);
            }
            else
            {
                foreach ($postulanteList as $clave => $valor)
                {
                    if( $valor->getIdStudent() == $student->getStudentId() )
                    {   if($valor->getActive() == 1 )
                        {
                            $control = 1;
                            $alert = "Ya se ah postulado";
                        }
                    }
                }

                if($control == 0 )
                {
                    try{
                        $postulante = new Postulante();
                        
                        $postulante->setIdJobOffer($idJobOffer);
                        $postulante->setIdStudent($student->getStudentId());
                        $postulante->setCv( $ruta );
                        $postulante->setActive(1);
                        
                        $this->postulanteDAO->Add($postulante);
                    
                    $alert = "postulante agregado";

                        move_uploaded_file($_FILES["cv"]["tmp_name"] ,$ruta);
                    
                    }
                    catch(Exception $ex){
                        $alert = $ex->getMessage();
                    }
                    finally{
                        $this->Index($alert);
                    }
                }
                else
                {   
                    $this->Index($alert);
                }     
            }
            
        }

        public function VerPostulantes($idJobOffer)
        {
            $alert ="";
            try
            {
                $postulanteList = array();
                $postulanteList = $this->postulanteDAO->BuscarXid($idJobOffer);
                $studentcontrolller = new StudentController();
                $studentList = array();

                foreach($postulanteList as $postulante)
                {   
                    $student = $studentcontrolller->BuscarXid($postulante->getIdStudent());
                    $student->setActive($postulante->getActive());
                    array_push($studentList , $student);

                }
                //var_dump($studentList);
            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
            finally{
                require_once(VIEWS_PATH."postulante-list.php");
            }
        }

        public function emailPostulantes($idJobOffer)
        {
            $alert ="";
            try
            {
                $postulanteList = array();
                $postulanteList = $this->postulanteDAO->BuscarXid($idJobOffer);
                $studentcontrolller = new StudentController();
                $emailList = array();

                foreach($postulanteList as $postulante)
                {   
                    $student = $studentcontrolller->BuscarXid($postulante->getIdStudent());

                    array_push($emailList , $student->getEmail());
                }
                //var_dump($studentList);
                return $emailList;
            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
        }



        public function Baja($idJobOffer)
        {
            try
            {
                $this->postulanteDAO->Baja($idJobOffer);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function BajaPostulante($idStudent)
        {
            $alert = "";
            try{
                $this->postulanteDAO->BajaPostulante($idStudent);
                $alert = "baja exitosa";
                $studentcontrolller = new StudentController();
                $email = "";
                  
                $student = $studentcontrolller->BuscarXid($idStudent);

                    $destinatario = $student->getEmail(); 
                    $asunto = "Este mensaje es de prueba"; 
                    $cuerpo = ' 
                    <html> 
                    <head> 
                    <title>Prueba de correo</title> 
                    </head> 
                    <body> 
                    <h1>Hola amigos!</h1> 
                    <p> 
                    <b>Su postulacion a sido declinada gracias. 
                    </p> 
                    </body> 
                    </html> 
                    '; 

                    $headers = "From:lucianogimeneztpfinal@gmail.com \r\n";
                    $headers .= "Cc:lucianogimeneztpfinal@gmail.com \r\n";
                    //para el envío en formato HTML 
                    $headers .= "MIME-Version: 1.0\r\n"; 
                    $headers .= "Content-type: text/html \r\n"; 


                    $mail = mail($destinatario,$asunto,$cuerpo,$headers); 
                   

            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
            finally
            {
                require_once(VIEWS_PATH."inicio-admin.php");
            }
        }

        public function GenerarPDF($studentList)
        {

            require_once(VIEWS_PATH."generar-pdf.php");

        }

        public function VerHistorial()
        {
            $alert ="";
            try
            {   
                $idStudent = $_SESSION["loggedUser"]->getStudentId();
                $postulanteList = array();
                $postulanteList = $this->postulanteDAO->Historial($idStudent);
                $studentcontrolller = new StudentController();
                
            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
            finally{
                require_once(VIEWS_PATH."historial-list.php");
            }
        }
       

    }

?>