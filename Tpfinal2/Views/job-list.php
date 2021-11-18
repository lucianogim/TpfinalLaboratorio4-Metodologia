<?php

use Models\JobOffer;

require_once('navAdmin.php');

    if (!isset($_SESSION["loggedAdmin"]))
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
               <h2 class="mb-4">Listado de Ofertas laborales</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Puesto</th>
                         <th>Fecha Inicio</th>
                         <th>Fecha finaliza</th>
                         <th>Descripcion</th>
                         <th>Requisitos</th>
                         <th>Max Postulantes</th>
                         <th>Modificar</th>
                         <th>Finalizar</th>
                         <th>Ver Postulantes</th>
                         <th>Borrar</th>
                         
                    </thead>
                    <tbody>
                         <?php
                              foreach($jobsOfferList as $jobsOffer)
                              {
                                   if($jobsOffer->getActive())
                                   {
                                   ?>
                                        <tr>
                                             <td><?php 
                                             foreach ($empresaList as $clave => $valor){
                                                if( $valor->getId() == $jobsOffer->getIdEmpresa() ){
                                                    echo $valor->getName() ;
                                                }
                                            }
                                             ?></td>
                                             <td><?php 
                                             foreach ($jobsList as $clave => $valor){
                                                if( $valor->getIdJobPosition() == $jobsOffer->getIdJobPosition() ){
                                                    echo $valor->getDescription() ;
                                                }
                                            }
                                             ?></td>
                                            <td><?php echo $jobsOffer->getInicio() ?></td>
                                            <td><?php echo $jobsOffer->getFinalizacion() ?></td>
                                            <td><?php echo $jobsOffer->getDescription() ?></td>
                                            <td><?php echo $jobsOffer->getRequisitos() ?></td>
                                            <td><?php echo $jobsOffer->getMaxPostulantes() ?></td>
                                         
                                             <td> <a href="<?php echo FRONT_ROOT ?>Jobs/ShowModView/?idJobOffer=<?php echo $jobsOffer->getJobOfferId() ?>" > <button type="button">Modificar</button></a></td>
                                             <td> <a href="<?php echo FRONT_ROOT ?>Jobs/Finalizar/?idJobOffer=<?php echo $jobsOffer->getJobOfferId() ?>" > <button type="button">Finalizar</button></a></td>
                                             <td> <a href="<?php echo FRONT_ROOT ?>Postulante/VerPostulantes/?idJobOffer=<?php echo $jobsOffer->getJobOfferId() ?>" > <button type="button">Ver Postulantes</button></a></td>
                                             <td> <a href="<?php echo FRONT_ROOT ?>Jobs/Borrar/?idJobOffer=<?php echo $jobsOffer->getJobOfferId() ?>" > <button type="button">Borrar</button></a></td>
                                        </tr>
                                   <?php 
                                   }   
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>