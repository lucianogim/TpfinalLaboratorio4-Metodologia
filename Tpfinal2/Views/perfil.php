<?php
use Models\Student as Student;

require_once(VIEWS_PATH."nav.php");

if (!isset($_SESSION['loggedUser']))
{
    //require_once(VIEWS_PATH."login.php");
    header("Location: Index");
    die();
}
else{
    $student = $_SESSION['loggedUser'];
}

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Perfil</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
                         <th>Dni</th>
                         <th>Genero</th>
                         <th>Cumpleanos</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <th>Activo</th>
                    </thead>
                    <tbody> 
                         <tr>
                            <td><?php echo $student->getFilenumber() ?></td>
                            <td><?php echo $student->getLastName() ?></td>
                            <td><?php echo $student->getFirstName() ?></td>
                            <td><?php echo $student->getDni() ?></td>
                            <td><?php echo $student->getGender() ?></td>
                            <td><?php echo $student->getBirthdate() ?></td>
                            <td><?php echo $student->getEmail() ?></td>
                            <td><?php echo $student->getPhone() ?></td>
                            <td><?php echo $student->getActive() ?></td>
                        </tr>
                     </tr>
                    </tbody>
                    <td> <a href="<?php echo FRONT_ROOT ?>Postulante/VerHistorial" > <button type="button">Ver Historial</button></a></td>
               </table>
          </div>
     </section>
</main>