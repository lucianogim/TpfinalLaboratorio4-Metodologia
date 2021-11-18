<?php
    namespace Controllers;

    use DAO\JobsDAO as JobsDAO;
    use Exception;
    use Models\Jobposition as Jobposition;
    use Models\Career as Career;
    use Models\JobOffer as JobOffer;
    use Models\Empresa as Empresa;
    use Controllers\EmpresaController as EmpresaController;
    use Controllers\PostulanteController as PostulanteController;
    use Models\Postulantes as Postulantes;

    class JobsController{

        private $jobsDAO;

        public function __construct()
        {
            $this->jobsDAO = new JobsDAO();
        }

        public function Index( $message="" )
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function ShowAddView($empresaList , $jobList)
        {   
            require_once(VIEWS_PATH."job-add.php");
        }

        public function ShowListView($alert="")
        {   
            $empresaController = new EmpresaController();
            $jobsOfferList = $this->jobsDAO->GetAll();
            $jobsList = $this->jobsDAO->GetAllJobPosition();
            $empresaList = $empresaController->getAllempresas();


            require_once(VIEWS_PATH."job-list.php");
        }

        public function ShowListViewStudent($alert="")
        {
            $empresaController = new EmpresaController();
            $jobsOfferList = $this->jobsDAO->GetAll();
            $jobsList = $this->jobsDAO->GetAllJobPosition();
            $empresaList = $empresaController->getAllempresas();
            

            require_once(VIEWS_PATH."job-list-students.php");
        }

        public function FormAddView($alert="")
        {   
            $empresaController = new EmpresaController();
            $empresaList = $empresaController->getAllempresas();

            $jobList = $this->jobsDAO->GetAllJobPosition();

            //var_dump($empresaList);
            
            $this->ShowAddView($empresaList , $jobList);

        }
        
        public function FormAddViewCompany($alert="")
        {   
            try{
                 $jobList = $this->jobsDAO->GetAllJobPosition();
            }
           catch(Exception $ex){
               $alert = $ex->getMessage();
           }
           finally{
               require_once(VIEWS_PATH."job-add-company.php");
           }

        }

        public function Add($idEmpresa , $idJobPosition , $inicio , $finalizacion, $description, $horas, $requisitos, $maxPostulantes)
        {
            try{
                $jobOffer = new JobOffer();
                
                $jobOffer->setIdEmpresa($idEmpresa);
                $jobOffer->setIdJobPosition($idJobPosition);
                $jobOffer->setInicio($inicio);
                $jobOffer->setFinalizacion($finalizacion);
                $jobOffer->setHoras($horas);
                $jobOffer->setDescription($description);
                $jobOffer->setRequisitos($requisitos);
                $jobOffer->setMaxPostulantes($maxPostulantes);
                $jobOffer->setActive(1);
                    
                $this->jobsDAO->Add($jobOffer);
            
             $alert = "oferta creada";
            
            }
            catch(Exception $ex){
                $alert = $ex->getMessage();
            }
            finally{
                $this->FormAddView($alert);
            }
        }

        public function ShowModView($idJobOffer)
        {
            try{
                $empresaController = new EmpresaController();
                $empresaList = $empresaController->getAllempresas();
                $jobsOfferList = $this->jobsDAO->GetAll();
                $jobList = $this->jobsDAO->GetAllJobPosition();

                $jobOfferOriginal = new JobOffer();
            
                foreach ($jobsOfferList as $clave => $valor)
                {
                    if($valor->getJobOfferId() == $idJobOffer )
                    {
                        $jobOfferOriginal = $valor;
                    }

                }  
            }
            catch(Exception $ex){
                $alert = $ex->getMessage();
            }
               
            require_once(VIEWS_PATH."job-mod.php");
        }

        public function AddStudent()
        {
            try{
                $careerList = $this->jobsDAO->GetAllCareer();
                
            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
            
            require_once(VIEWS_PATH."student-add.php");
        }

        public function Modificar($idjoboffer, $idEmpresa , $idJobPosition , $inicio , $finalizacion, $description, $horas, $requisitos, $maxPostulantes)
        {
            try{
                $this->jobsDAO->Modificar( $idjoboffer, $idEmpresa, $idJobPosition, $inicio, $finalizacion, $description, $horas, $requisitos, $maxPostulantes);
                $alert = "Modificacion exitosa";
            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
            finally
            {
                $this->ShowListView($alert);
            } 
        }

        public function Borrar($idJobOffer)
        {
            $alert="";

                try{
                    $this->jobsDAO->Borrar($idJobOffer);
                    $alert = "Oferta Eliminada con exito.";
                }
                catch(Exception $ex)
                {
                    $alert = $ex->getMessage();
                }
                finally
                {
                    $this->ShowListView($alert);
                }    

        }

        public function Busqueda($busqueda)
        {
            $empresaController = new EmpresaController();
            $jobsOfferList = $this->jobsDAO->GetAll();
            $jobsList = $this->jobsDAO->GetAllJobPosition();
            $empresaList = $empresaController->getAllempresas();
            $listafiltrada = array();
            $alert="";
            //$indice=NULL;

            //$posicion_coincidencia = ;
 
            //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
            //if ($posicion_coincidencia === false)

            foreach ($jobsOfferList as $clave => $valor){

                foreach ($jobsList as $clave2 => $valor2){
                    if( $valor2->getIdJobPosition() == $valor->getIdJobPosition() ){
                        
                        $posicion_coincidencia = strrpos(strtolower($valor2->getDescription()) ,strtolower($busqueda)  );
                        
                        if( is_numeric($posicion_coincidencia) ){
                            //$indice = $clave;
                            array_push($listafiltrada , $valor );
                        }
                        $posicion_coincidencia = false;
                    }
                }     
            }
            
            require_once(VIEWS_PATH."job-list-filt.php");
        }

        public function Finalizar($idJobOffer)
        {
            $alert="";
            $postulantes = new PostulanteController();
            try
            {
                $emailList = array();
                $this->jobsDAO->Baja($idJobOffer);
                $postulantes->Baja($idJobOffer);
                $emailList = $postulantes->emailPostulantes($idJobOffer);
                //array_push($emailList , "lucho_gimenez98@hotmail.com.ar");

                //var_dump($emailList);
                foreach($emailList as $email)
                {   
                    
                    $destinatario = $email; 
                    $asunto = "Este mensaje es de prueba"; 
                    $cuerpo = ' 
                    <html> 
                    <head> 
                    <title>Prueba de correo</title> 
                    </head> 
                    <body> 
                    <h1>Hola amigos!</h1> 
                    <p> 
                    <b>Bienvenidos a mi correo electrónico de prueba</b>. Gracias por participar de la prueba del sistema la oferta laboral ah finalizado. 
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

                $alert="Baja exitosa";
                
            }
            catch(Exception $ex)
            {
                $alert = $ex->getMessage();
            }
            finally
            {
                $this->ShowListView($alert);
            }

        }
        

        public function CargaJobsCarrers()
        {
            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Career';

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

                    $career = new Career();
                    $career->setCareerid($valuesArray["careerId"]);
                    $career->setDescription($valuesArray["description"]);
                    if( $valuesArray['active'] == true )
                    {
                        $career->setActive(1);
                    }
                    else
                    {
                        $career->setActive(0);
                    }

                }

                $this->jobsDAO->AddCareer($career);
            }


            $url = 'https://utn-students-api.herokuapp.com/api/JobPosition';

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

                    $jobPosition = new Jobposition();
                    $jobPosition->setIdJobPosition($valuesArray["jobPositionId"]);
                    $jobPosition->setCareerid($valuesArray["careerId"]);
                    $jobPosition->setDescription($valuesArray["description"]);   

                }

                $this->jobsDAO->AddJobposition($jobPosition);
            }


            $this->Index();
        }
    }

?>