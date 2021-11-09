<?php
    namespace Controllers;

    use DAO\EmpresaDAO as EmpresaDAO;
    use Exception;
    use Models\Empresa as Empresa;

use function PHPSTORM_META\type;

class EmpresaController
    {   
        
        private $empresaDAO;

        public function __construct()
        {
            $this->empresaDAO = new EmpresaDAO();
        }

        public function ShowLoginView()
        {
            require_once(VIEWS_PATH."login-admin.php");
        }

        public function ShowAddView($alert="")
        {
            require_once(VIEWS_PATH."empresa-add.php");
        }

        public function ShowListView($alert="")
        {
            $empresaList = $this->empresaDAO->GetAll();

            require_once(VIEWS_PATH."empresa-list.php");
        }

        public function EmpresaList()
        {
            $empresaList = $this->empresaDAO->GetAll();
            
            return $empresaList;
        }

        public function ShowModView($name )
        {
            // $empresaList = $this->empresaDAO->GetAll();
            
            // $indice=NULL;

            // foreach ($empresaList as $clave => $valor){
            //     if( $valor->getName() == $name){
            //         $indice = $clave;
            //     }
            // }
            $empresa = $this->empresaDAO->BuscarName($name);

            require_once(VIEWS_PATH."empresa-mod.php");
        }

        public function ShowEmpresaView($name)
        {
            $empresaList = $this->empresaDAO->GetAll();
            
            $indice=NULL;

            foreach ($empresaList as $clave => $valor){
                if( $valor->getName() == $name){
                    $indice = $clave;
                }
            }
            
            require_once(VIEWS_PATH."empresa-info.php");
        }

        public function Busqueda($busqueda)
        {
            $empresaList = $this->empresaDAO->GetAll();
            $listafiltrada = array();
            //$indice=NULL;

            //$posicion_coincidencia = ;
 
            //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
            //if ($posicion_coincidencia === false)

            foreach ($empresaList as $clave => $valor){
                
                $posicion_coincidencia = strrpos(strtolower($valor->getName()) , strtolower($busqueda) );
                
                if( is_numeric($posicion_coincidencia) ){
                    //$indice = $clave;
                    array_push($listafiltrada , $valor );
                }
                $posicion_coincidencia = false;
            }
            
            require_once(VIEWS_PATH."empresa-list-filt.php");
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function DestroySession()
        {
            session_destroy();
            $this->Index();
        }

        public function Add($name, $descripcion)
        {   
            $alert="";
            $control=0;

            if($name=="" || $descripcion == ""){
                $control = 1; 
                $alert = "ingrese los datos correspondientes";
            }
            
            $empresaList = $this->empresaDAO->GetAll();

            foreach ($empresaList as $clave => $valor){
                if( $valor->getName() == $name){
                    $control = 1;
                    $alert = "Ya existe una empresa con ese nombre";
                }
            }
            if($control == 0 )
            {
                try{
                    $empresa = new Empresa();
                    
                    $empresa->setName($name);
                    $empresa->setDescripcion($descripcion);

                        
                    $this->empresaDAO->Add($empresa);
                
                 $alert = "empresa agregada";
                
                }
                catch(Exception $ex){
                    $alert = $ex->getMessage();
                }
                finally{
                    $this->ShowAddView($alert);
                }
            }
            else
            {   
                $this->ShowAddView($alert);
            }
            
            
        }

        public function Modificar($id , $name , $descripcion){
            $alert="";
            $control=0;

            $empresaList = $this->empresaDAO->GetAll();

            foreach ($empresaList as $clave => $valor){
                if( $valor->getName() == $name){
                    if($valor->getId() != $id ){
                        $control = 1;
                    }
                }
            }

            if($control == 0)
            {
                try{
                    $this->empresaDAO->Modificar( $id , $name , $descripcion);
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
            else{
                $alert = "Ingrese otro nombre de empresa";
                $this->ShowListView($alert);
            }
            
        }

        public function Borrar($name)
        {
            $alert="";

                try{
                    $this->empresaDAO->Borrar($name);
                    $alert = "empresa Eliminada con exito.";
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

        public function getAllempresas(){

            $empresaList = $this->empresaDAO->GetAll();
            
            return $empresaList;
        }


        // public function Login($email=""){

        //     $loggedAdmin = 0;


        //     if($email == "admin@admin"){

        //         $loggedAdmin = 1;
        //     }

        //     if($loggedAdmin != 0 )
        //     {   
        //         $_SESSION["loggedAdmin"] = $loggedAdmin;
        //         //session_start();
        //         //header("location:../welcome.php");

        //         $this->ShowListView();
        //     }
        //     else
        //     {
        //         echo "<script> if(confirm('Verifique que los datos ingresados sean correctos'));";
        //         echo "window.location = '../index.php';
        //                 </script>";
        //     }
        // }
    }
?>