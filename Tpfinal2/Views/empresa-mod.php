<?php
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
               <h2 class="mb-4">Modificar Empresa</h2>
               <form action="<?php echo FRONT_ROOT ?>Empresa/Modificar" method="post" class="bg-light-alpha p-5">
                    <div class="row">                        
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" value="<?php echo $empresa->getName() ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Descripcion</label>
                                   <textarea  name="descripcion" class="form-control"><?php echo $empresa->getDescripcion() ?></textarea>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="id" value="<?php echo $empresa->getId() ?>"  class="btn btn-dark ml-auto d-block">Modificar</button>
               </form>
          </div>
     </section>
</main>