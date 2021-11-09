<?php
    namespace Models;

    class Career
    {
        private $careerId;
        private $description;
        private $active;

        public function setCareerId($id)
        {
            $this->careerId = $id;
        }

        public function getCareerId()
        {
            return $this->careerId;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function getDescription()
        {
            return $this->description;
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

