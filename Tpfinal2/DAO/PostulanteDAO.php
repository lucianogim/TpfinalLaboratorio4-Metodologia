<?php
    namespace DAO;

    use \FFI\Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IPostulanteDAO as IPostulanteDAO;
    use Models\Postulante as Postulante;

    class PostulanteDAO implements IPostulanteDAO
    {   
        private $connection;
        private $tableName = "postulantes";
        //private $empresaList = array();

        public function Add(Postulante $postulante)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( idJobOffer, idStudent, active ) 
                                                            VALUES ( :idJobOffer, :idStudent, :active);";
                
                //$parameters["studentId"] = $student->getStudentId();
                $parameters["idJobOffer"] = $postulante->getIdJobOffer();
                $parameters["idStudent"] = $postulante->getIdStudent();
                $parameters["active"] = 1;
                
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
                    $postulante->setIdJobOffer($row["idJobOffer"]);
                    $postulante->setIdStudent($row["idStudent"]);
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

    }
?>