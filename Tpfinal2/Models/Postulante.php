<?php
    namespace Models;

    class Postulante
    {
        private $idJobOffer;
        private $idStudent;
        private $cv;
        private $active;
        
        public function setIdJobOffer($idJobOffer)
        {
            $this->idJobOffer = $idJobOffer;
        }

        public function getIdJobOffer()
        {
            return $this->idJobOffer;
        }

        public function setIdStudent($idStudent)
        {
            $this->idStudent = $idStudent;
        }

        public function getIdStudent()
        {
            return $this->idStudent;
        }

        public function getCv()
        {
            return $this->cv;
        }

        public function setCv($cv)
        {
            $this->cv = $cv;
        }

        public function setActive($active)
        {
            $this->active = $active;
        }
        
        public function getActive()
        {
            return $this->active;
        }
    }