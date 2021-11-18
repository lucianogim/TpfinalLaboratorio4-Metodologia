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
               <h2 class="mb-4">Agregar alumno</h2>
               <form action="<?php echo FRONT_ROOT ?>Student/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Carrera</label>
                                   <select class="form-select" aria-label="Career" name="careerId" required>
                                    <?php 
                                        foreach ($careerList as $clave => $valor){
                                            echo "<option value=".$valor->getCareerId().">".$valor->getDescription()."</option>" ;
                                        }    
                                    ?>
                                </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="firstName" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Apellido</label>
                                   <input type="text" name="lastName" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">DNI</label>
                                   <input type="text" name="dni" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Legajo</label>
                                   <input type="text" name="fileNumber" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Genero</label>
                                   <input type="text" name="gender" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cumpleanos</label>
                                   <input type="date" name="birthDate" value="" class="form-control" required> 
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Telefono</label>
                                   <input type="text" name="phoneNumber" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Alta</button>
               </form>
          </div>
     </section>
</main>