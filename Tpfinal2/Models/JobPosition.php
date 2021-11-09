<?php
    namespace Models;

    class Jobposition
    {
        private $idJobPosition;
        private $careerId;
        private $description;

        public function getIdJobPosition()
        {
            return $this->idJobPosition;
        }
        public function setIdJobPosition($id)
        {
            $this->idJobPosition = $id;
        }

        public function getCareerId()
        {
            return $this->careerId;
        }

        public function setCareerId($idCareer)
        {
            $this->careerId = $idCareer;
        }

        public function getDescription()
        {
            return $this->description;
        }
        
        public function setDescription($description)
        {
            $this->description = $description;
        }

    }

?>