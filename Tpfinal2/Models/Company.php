<?php
    namespace Models;

    class Company
    {   
        private $id;
        private $email;
        private $idEmpresa;
        private $active;

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getIdEmpresa()
        {
            return $this->idEmpresa;
        }

        public function setIdEmpresa($idEmpresa)
        {
            $this->idEmpresa = $idEmpresa;
        }

        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
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