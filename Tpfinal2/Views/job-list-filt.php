<?php
use Models\Student as Student;
use Controllers\EmpresaController as EmpresaController;
use Models\Empresa as Empresa;

require_once(VIEWS_PATH."nav.php");

if (isset($_SESSION['loggedUser']))
{
    //var_dump($_SESSION['loggedUser']);
    $empresaController = new EmpresaController(); 
    $empresaList = $empresaController->EmpresaList();
}
else{
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
               <form action="<?php echo FRONT_ROOT ?>Jobs/Busqueda" method="post" class="bg-light-alpha p-2">
                    <div class="row">                         
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Buscar</label>
                                   <input type="text" name="busqueda" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">buscar</button>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Empresa</th>
                         <th>Puesto</th>
                         <th>Fecha Inicio</th>
                         <th>Fecha finaliza</th>
                         <th>Descripcion</th>
                         <th>Requisitos</th>
                         <th>Max Postulantes</th>
                         <th>Postularse</th>
                         
                    </thead>
                    <tbody>
                         <?php
                              foreach($listafiltrada as $jobsOffer)
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
                                         
                                             <td> <a href="<?php echo FRONT_ROOT ?>Postulante/CargaCV/?idJobOffer=<?php echo $jobsOffer->getJobOfferId() ?>" > <button type="button">Postularse</button></a></td>
    
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