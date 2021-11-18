<?php

require_once(VIEWS_PATH."nav.php");

if (!isset($_SESSION['loggedUser']))
{
    //require_once(VIEWS_PATH."login.php");
    header("Location: Index");
    die();
}


?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <?php if($alert != ""){
                    ?>
                    <div class="alert alert-info" role="alert">
                    <?php echo $alert; ?>
                    </div><?php
               }?>
               <h2 class="mb-4">Listado</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>id trabajo</th>
                         <th>Cv</th>
                         <th>Activo</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($postulanteList as $student)
                        {
                        ?>
                            <tr>
                                <td><?php echo $student->getIdJobOffer() ?></td>
                                <td><?php echo $student->getCv() ?></td>
                                <td><?php echo $student->getActive() ?></td>
                            </tr>
                        <?php
                        } 
                        ?>
                     </tr>
                    </tbody>
               </table>              
          </div>
     </section>
</main>