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
               <h2 class="mb-4">Listado de Empresas</h2>
               <form action="<?php echo FRONT_ROOT ?>Empresa/Busqueda" method="post" class="bg-light-alpha p-2">
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
                         <th>Nombre</th>
                         <th>Ver Mas..</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($empresaList as $empresa)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $empresa->getName() ?></td>
                                             <td> <a href="<?php echo FRONT_ROOT ?>Empresa/ShowEmpresaView/?name=<?php echo $empresa->getName() ?>" > <button type="button">Ver mas</button></a></td>
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