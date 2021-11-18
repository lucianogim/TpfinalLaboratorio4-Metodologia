<?php
    require_once(VIEWS_PATH."navAdmin.php");

     if (!isset($_SESSION["loggedAdmin"]))
     {
     //require_once(VIEWS_PATH."login.php");
     header("Location: Index");
     die();
     }

     //ini_set('date.timezone' , 'America/Argentina/Buenos_Aires');
     $time = date('Y-m-d' , time());

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificar Oferta</h2>
               <form action="<?php echo FRONT_ROOT ?>Jobs/Modificar" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                              <label for="">Empresa</label>
                                <select class="form-select" aria-label="Empresa" name="idEmpresa" required>
                                    <?php 
                                        foreach ($empresaList as $clave => $valor){
                                            if( $jobOfferOriginal->getIdEmpresa() == $valor->getId() ){
                                                echo "<option value=".$jobOfferOriginal->getIdEmpresa()." selected>".$valor->getName()."</option>";
                                            }
                                            echo "<option value=".$valor->getId().">".$valor->getName()."</option>" ;
                                        }    
                                    ?>
                                </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                              <label for="">Puesto de trabajo</label>
                                <select class="form-select" aria-label="Job Position" name="idJobPosition" required>
                                    <?php 
                                        foreach ($jobList as $clave => $valor){
                                            if( $jobOfferOriginal->getIdJobPosition() == $valor->getIdJobPosition() ){
                                                echo "<option value=".$jobOfferOriginal->getIdJobPosition()." selected>".$valor->getDescription()."</option>";
                                            }
                                            echo "<option value=".$valor->getIdJobPosition().">".$valor->getDescription()."</option>" ;
                                        }    
                                    ?>
                                </select>
                              </div>
                         </div>  
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha inicio</label>
                                   <?php echo $time; ?>
                                   <input type="date" name="inicio" value="<?php echo $jobOfferOriginal->getInicio() ?>" min="<?php echo $time; ?>" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha finalizacion</label>
                                   <input type="date" name="finalizacion" value="<?php echo $jobOfferOriginal->getFinalizacion() ?>" min="<?php echo $time; ?>" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Descripcion</label>
                                   <textarea id="description" name="description" class="form-control" required><?php echo $jobOfferOriginal->getDescription() ?></textarea>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Horas de trabajo</label>
                                   <input type="text" name="horas" value="<?php echo $jobOfferOriginal->getHoras() ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">requisitos</label>
                                   <input type="text" name="requisitos" value="<?php echo $jobOfferOriginal->getRequisitos() ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Max postulantes</label>
                                   <input type="text" name="maxPostulantes" value="<?php echo $jobOfferOriginal->getMaxPostulantes() ?>" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="idjoboffer" value="<?php echo $jobOfferOriginal->getJobOfferId() ?>"  class="btn btn-dark ml-auto d-block">Modificar</button>
                    <br>
               </form>
          
          </div>
     </section>
</main>