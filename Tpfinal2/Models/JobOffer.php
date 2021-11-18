<?php
    namespace Models;

    class JobOffer
    {
        private $idJobOffer;
        private $idJobPosition;
        private $idEmpresa;
        private $inicio;
        private $finalizacion;
        private $horas;
        private $description;
        private $requisitos;
        private $maxPostulantes;
        private $active;

        public function setIdJobOffer($idJobOffer)
        {
            $this->idJobOffer = $idJobOffer;
        }

        public function getJobOfferId()
        {
            return $this->idJobOffer;
        }

        public function setIdJobPosition($idJobPosition)
        {
            $this->idJobPosition = $idJobPosition;
        }

        public function getIdJobPosition()
        {
            return $this->idJobPosition;
        }

        public function setIdEmpresa($idEmpresa)
        {
            $this->idEmpresa = $idEmpresa;
        }

        public function getIdEmpresa()
        {
            return $this->idEmpresa;
        }

        public function setInicio($inicio)
        {
            $this->inicio = $inicio;
        }

        public function getInicio()
        {
            return $this->inicio;
        }

        public function setFinalizacion($finalizacion)
        {
            $this->finalizacion = $finalizacion;
        }

        public function getFinalizacion()
        {
            return $this->finalizacion;
        }

        public function setHoras($horas)
        {
            $this->horas = $horas;
        }

        public function getHoras()
        {
            return $this->horas;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setRequisitos($requisitos)
        {
            $this->requisitos = $requisitos;
        }

        public function getRequisitos()
        {
            return $this->requisitos;
        }

        public function setMaxPostulantes($maxPostulantes)
        {
            $this->maxPostulantes = $maxPostulantes;
        }

        public function getMaxPostulantes()
        {
            return $this->maxPostulantes;
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

?>