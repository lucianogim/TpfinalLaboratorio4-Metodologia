<?php
    namespace DAO;

    use \FFI\Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IPostulanteDAO as IPostulanteDAO;
use Models\Career;
use Models\Postulante as Postulante;

    class PostulanteDAO implements IPostulanteDAO
    {   
        private $connection;
        private $tableName = "postulante";
        //private $empresaList = array();

        public function Add(Postulante $postulante)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( idjoboffer, idstudent, rutacv, active ) 
                                                            VALUES ( :idjoboffer, :idstudent, :rutacv, :active);";
                
                $parameters["idjoboffer"] = $postulante->getIdJobOffer();
                $parameters["idstudent"] = $postulante->getIdStudent();
                $parameters["rutacv"] = $postulante->getCv();
                $parameters["active"] = $postulante->getActive();
                
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
                $postulanteList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $postulante = new Postulante();
                    $postulante->setIdJobOffer($row["idjoboffer"]);
                    $postulante->setIdStudent($row["idstudent"]);
                    $postulante->setCv($row["rutacv"]);
                    $postulante->setActive($row["active"]);
                    
                    array_push($postulanteList, $postulante);
                }

                return $postulanteList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function BuscarName($name)
        {
            try
            {
                $empresa = new Postulante();
                
                $query = "SELECT * FROM empresa WHERE name = :name ";
                
                $parameters['name'] = $name;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {
                    // $empresa->setId($row["id"]);
                    // $empresa->setName($row["name"]);
                    // $empresa->setDescripcion($row["description"]);
                    
                }
                return $empresa;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Modificar( $id, $name, $descripcion)
        {
            try
            {
                $empresa = new Postulante();
                
                $query = "UPDATE empresa SET name = :name , description = :description  WHERE id = $id ";
                
                $parameters['name'] = $name;
                $parameters['description']=$descripcion;
                
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                return $empresa;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
        }

        public function Borrar($name)
        {
            try
            {
                $empresa = new Postulante();
                
                $query = "DELETE FROM empresa WHERE name = :name ";
                
                $parameters['name'] = $name;
                
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function ContarId($idjoboffer)
        {
            try
            {
                $count = 0;
                $query = "SELECT COUNT(idjoboffer) FROM postulante WHERE idjoboffer = :idjoboffer AND active = 1";

                $parameters['idjoboffer'] = $idjoboffer;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                $res = current($resultSet);

                $count = $res["COUNT(idjoboffer)"];

                return $count;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function BuscarMaxPostulantes($idjoboffer)
        {
            try{
                $postulantes = 0;
                $query = "SELECT maxpostulantes FROM joboffer WHERE idJobOffer = :idjoboffer";

                $parameters['idjoboffer'] = $idjoboffer;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                $res = current($resultSet);

                $postulantes = $res["maxpostulantes"];

                return $postulantes;

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
        }

        public function BuscarXid($idjoboffer)
        { 
            try
            {
                $postulanteList = array();

                $query = "SELECT * FROM $this->tableName WHERE idjoboffer = :idjoboffer";

                $parameters['idjoboffer'] = $idjoboffer; 

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $postulante = new Postulante();
                    $postulante->setIdJobOffer($row["idjoboffer"]);
                    $postulante->setIdStudent($row["idstudent"]);
                    $postulante->setCv($row["rutacv"]);
                    $postulante->setActive($row["active"]);
                    
                    array_push($postulanteList, $postulante);
                }

                return $postulanteList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Historial($idstudent)
        {
            try
            {
                $postulanteList = array();

                $query = "SELECT * FROM $this->tableName WHERE idstudent = :idstudent";

                $parameters['idstudent'] = $idstudent; 

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $postulante = new Postulante();
                    $postulante->setIdJobOffer($row["idjoboffer"]);
                    $postulante->setIdStudent($row["idstudent"]);
                    $postulante->setCv($row["rutacv"]);
                    $postulante->setActive($row["active"]);
                    
                    array_push($postulanteList, $postulante);
                }

                return $postulanteList;
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
                $query = "UPDATE $this->tableName SET  active = :active  WHERE idjobOffer = $idJobOffer ";
                
                $parameters['active'] = 0;
                 
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function BajaPostulante($idstudent)
        {
            try
            {
                $query = "UPDATE $this->tableName SET  active = :active  WHERE idstudent = $idstudent ";
                
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