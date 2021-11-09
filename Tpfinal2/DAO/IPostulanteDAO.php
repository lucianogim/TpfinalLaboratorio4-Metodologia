<?php
    namespace DAO;

    use Models\Postulante as Postulante;
    use DAO\Connection as Connection;

    interface IPostulanteDAO
    {
        function Add(Postulante $postulantes);
        function GetAll();
        //function Borrar($name);
        //function Modificar($id , $name , $descripcion);
    }
?>