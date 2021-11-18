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
               <h2 class="mb-4">Info Empresa</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Descripcion</th>
                    </thead>
                    <tbody> 
                         <tr>
                            <td><?php echo $empresaList["$indice"]->getName() ?></td>
                            <td><?php echo $empresaList["$indice"]->getDescripcion() ?></td>
                        </tr>
                     </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>