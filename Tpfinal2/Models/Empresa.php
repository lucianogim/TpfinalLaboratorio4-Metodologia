<?php
    namespace Models;

    class Empresa
    {
        private $name;
        private $descripcion;
        private $id;

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getDescripcion()
        {
            return $this->descripcion;
        }

        function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        function getId()
        {
            return $this->id;
        }
        function setId($id)
        {
            $this->id = $id;
        }

    }


?>