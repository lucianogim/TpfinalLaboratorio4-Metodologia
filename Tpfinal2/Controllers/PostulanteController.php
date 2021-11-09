<?php
    namespace Controllers;

    use DAO\PostulanteDAO as PostulanteDAO;
    use Exception;
    use Models\Postulante as Postulante;
    use Models\Student as Student;

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

        public function Add($idJobOffer)
        {   
            $alert="";
            $control=0;
            $student = $_SESSION["loggedUser"] ;

            $postulanteList = $this->postulanteDAO->GetAll();

            foreach ($postulanteList as $clave => $valor){
                if( $valor->getIdStudent() == $student->getStudentId() )
                {
                    $control = 1;
                    $alert = "Ya se ah postulado";
                }
            }
            if($control == 0 )
            {
                try{
                    $postulante = new Postulante();
                    
                    $postulante->setIdJobOffer($idJobOffer);
                    $postulante->setIdStudent($student->getStudentId());
                    $postulante->setActive(1);
                        
                    $this->postulanteDAO->Add($postulante);
                
                 $alert = "postulante agregado";
                
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

?>