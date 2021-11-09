<?php
    namespace DAO;

    use Models\Career as Career;
    use Models\Jobposition as JobPosition;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    interface IJobsDAO
    {
        function AddJobposition(JobPosition $jobposition);
        function AddCareer(Career $career);
        function GetAllJobPosition();
        function GetAllCareer();
        function Borrar($idJobOffer);
        //function Modificar($id , $name , $descripcion);
    }
?>