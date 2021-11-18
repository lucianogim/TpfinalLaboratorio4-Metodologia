<?php
    require_once(VIEWS_PATH."navAdmin.php");

     if (!isset($_SESSION["loggedAdmin"]))
     {
     
     header("Location: Index");
     die();
     }

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Company</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                              <label for="">Empresa</label>
                                <select class="form-select" aria-label="Empresa" name="idEmpresa" required>
                                    <?php 
                                        foreach ($empresaList as $clave => $valor){
                                            echo "<option value=".$valor->getId().">".$valor->getName()."</option>" ;
                                        }    
                                    ?>
                                </select>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Agregar</button>
                
               </form>
               
          </div>
     </section>
</main>