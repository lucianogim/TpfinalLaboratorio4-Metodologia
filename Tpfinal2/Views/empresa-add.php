<?php
    require_once(VIEWS_PATH."navAdmin.php");

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
               <h2 class="mb-4">Agregar Empresa</h2>
               <form action="<?php echo FRONT_ROOT ?>Empresa/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Descripcion</label>
                                   <textarea id="bio" name="descripcion" class="form-control"></textarea>
                              </div>
                         </div>
                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Agregar</button>
                    <br>
               <?php 
               if($alert != ""){
                    ?>
                    <div class="alert alert-info" role="alert">
                    <?php echo $alert; ?>
                    </div><?php
               }?>
               </form>
               
          </div>
     </section>
</main>