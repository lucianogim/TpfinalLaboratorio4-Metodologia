<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Exception;
    use Models\Company as Company;
    use DAO\EmpresaDAO as EmpresaDAO;
    use Models\Empresa as Empresa;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddCompany()
        {
            $empresaController = new EmpresaController();
            $empresaList = $empresaController->getAllempresas();

            require_once(VIEWS_PATH."company-add.php");
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

        public function Index($alert = "")
        {
            require_once(VIEWS_PATH."inicio-admin.php");
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

        public function Add( $idEmpresa, $email )
        {   
            $alert="";
            $company = new Company();
            $company->setIdEmpresa($idEmpresa);
            $company->setEmail($email);
            $company->setActive(1);

            try
            {
                $this->companyDAO->Add($company);
                $alert = "Company agregado";
            }
            catch(Exception $ex){
                $alert = $ex->getMessage();
            }
            finally{
                $this->Index($alert);
            }

            //$this->ShowAddView();
        }
    }
?>