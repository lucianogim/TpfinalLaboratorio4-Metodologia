<?php
    namespace DAO;

    use Models\Career as Career;
    use Models\Jobposition as JobPosition;
    use Models\JobOffer as JobOffer;
    use models\Postulantes as Postulantes;
    use DAO\Connection as Connection;
    use \FFI\Exception as Exception;
    use DAO\IJobsDAO as IJobsDAO;

    class JobsDAO implements IJobsDAO
    {

        private $connection;
        private $tableName = "joboffer";

        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( idJobposition, idEmpresa, inicio , finalizacion, horas, description, requisitos, maxpostulantes, active ) 
                                                            VALUES ( :idJobposition, :idEmpresa, :inicio, :finalizacion, :horas, :description, :requisitos, :maxpostulantes, :active);";
                
                $parameters["idJobposition"] = $jobOffer->getIdJobPosition();
                $parameters["idEmpresa"] = $jobOffer->getIdEmpresa();
                $parameters["inicio"] = $jobOffer->getInicio();
                $parameters["finalizacion"] = $jobOffer->getFinalizacion();
                $parameters["horas"] = $jobOffer->getHoras();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["requisitos"] = $jobOffer->getRequisitos();
                $parameters["maxpostulantes"] = $jobOffer->getMaxPostulantes();
                $parameters["active"] = $jobOffer->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function AddJobposition(JobPosition $jobposition)
        {
            try
            {
                $query = "INSERT INTO jobposition ( JobPositionId, careerId ,  description ) 
                                                            VALUES ( :jobPositionId, :careerId, :description);";
                
                //$parameters["studentId"] = $student->getStudentId();
                $parameters["jobPositionId"] = $jobposition->getIdJobPosition();
                $parameters["careerId"] = $jobposition->getCareerId();
                $parameters["description"] = $jobposition->getDescription();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function AddCareer(Career $career){
            try
            {
                $query = "INSERT INTO career ( careerId, description , active ) 
                                                            VALUES ( :careerId, :description , :active);";
                
                //$parameters["studentId"] = $student->getStudentId();
                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();
                
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
                $jobList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setIdJobOffer($row["idJobOffer"]);
                    $jobOffer->setIdJobPosition($row["idJobposition"]);
                    $jobOffer->setIdEmpresa($row["idEmpresa"]);
                    $jobOffer->setInicio($row["inicio"]);
                    $jobOffer->setFinalizacion($row["finalizacion"]);
                    $jobOffer->setHoras($row["horas"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setRequisitos($row["requisitos"]);
                    $jobOffer->setMaxPostulantes($row["maxpostulantes"]);
                    $jobOffer->setActive($row["active"]);
                    
                    array_push($jobList, $jobOffer);
                }

                return $jobList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function GetAllJobPosition(){

            try
            {
                $jobPositionList = array();

                $query = "SELECT * FROM jobposition";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobposition = new JobPosition();
                    $jobposition->setIdJobPosition($row["jobPositionId"]);
                    $jobposition->setCareerId($row["careerId"]);
                    $jobposition->setDescription($row["description"]);
                    
                    array_push($jobPositionList, $jobposition);
                }

                return $jobPositionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }
        public function GetAllCareer(){
            try
            {
                $careerList = array();

                $query = "SELECT * FROM career";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $career = new Career();
                    $career->setCareerId($row["careerId"]);
                    $career->setDescription($row["description"]);
                    $career->setActive($row["active"]);
                    
                    array_push($careerList, $career);
                }

                return $careerList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Borrar($idJobOffer)
        {
            try
            {
                $jobOffer= new JobOffer();
                
                $query = "DELETE FROM joboffer WHERE idJobOffer= :idJobOffer ";
                
                $parameters['idJobOffer'] = $idJobOffer;
                
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function Modificar( $idjoboffer, $idEmpresa, $idJobPosition, $inicio, $finalizacion, $description, $horas, $requisitos, $maxPostulantes)
        {
            try
            {
                $jobOffer = new JobOffer();
                
                $query = "UPDATE joboffer SET idJobposition = :idJobposition, idEmpresa = :idEmpresa, inicio = :inicio, finalizacion = :finalizacion, horas = :horas, description = :description, maxpostulantes = :maxpostulantes, requisitos = :requisitos  WHERE idjobOffer = $idjoboffer ";
                
                $parameters['idJobposition'] = $idJobPosition;
                $parameters['idEmpresa'] = $idEmpresa;
                $parameters['inicio'] = $inicio;
                $parameters['finalizacion'] = $finalizacion;
                $parameters['horas'] = $horas;
                $parameters['description']= $description;
                $parameters['requisitos'] = $requisitos;
                $parameters['maxpostulantes'] = $maxPostulantes;
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }


        }

        public function Baja($idJobOffer)
        {
            try
            {
                $query = "UPDATE joboffer SET  active = :active  WHERE idjobOffer = $idJobOffer ";
                
                $parameters['active'] = 0;
                 
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }
    }
?>