<?php
    namespace DAO;

    use Models\Empresa as Empresa;
    use DAO\Connection as Connection;

    interface IEmpresaDAO
    {
        function Add(Empresa $empresa);
        function GetAll();
        function Borrar($name);
        function Modificar($id , $name , $descripcion);
    }
?>