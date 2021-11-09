<?php
    namespace DAO;

    use \FFI\Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IEmpresaDAO as IEmpresaDAO;
    use Models\Empresa as Empresa;

    class EmpresaDAO implements IEmpresaDAO
    {   
        private $connection;
        private $tableName = "empresa";
        //private $empresaList = array();

        public function Add(Empresa $empresa)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( name, description ) 
                                                            VALUES ( :name, :description);";
                
                //$parameters["studentId"] = $student->getStudentId();
                $parameters["name"] = $empresa->getName();
                $parameters["description"] = $empresa->getDescripcion();
                
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
                $empresaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $empresa = new Empresa();
                    $empresa->setId($row["id"]);
                    $empresa->setName($row["name"]);
                    $empresa->setDescripcion($row["description"]);
                    
                    array_push($empresaList, $empresa);
                }

                return $empresaList;
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
                $empresa = new Empresa();
                
                $query = "SELECT * FROM empresa WHERE name = :name ";
                
                $parameters['name'] = $name;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);
                
                foreach ($resultSet as $row)
                {
                    $empresa->setId($row["id"]);
                    $empresa->setName($row["name"]);
                    $empresa->setDescripcion($row["description"]);
                    
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
                $empresa = new Empresa();
                
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
                $empresa = new Empresa();
                
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

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->empresaList as $empresa)
            {
                $valuesArray["name"] = $empresa->getName();
                $valuesArray["descripcion"] = $empresa->getDescripcion();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/empresas.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->empresaList = array();

            if(file_exists('Data/empresas.json'))
            {
                $jsonContent = file_get_contents('Data/empresas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $empresa = new Empresa();
                    $empresa->setName($valuesArray["name"]);
                    $empresa->setDescripcion($valuesArray["descripcion"]);

                    array_push($this->empresaList, $empresa);
                }
            }
        }
    }
?>