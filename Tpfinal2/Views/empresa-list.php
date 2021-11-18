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
          <?php if($alert != ""){
                    ?>
                    <div class="alert alert-info" role="alert">
                    <?php echo $alert; ?>
                    </div><?php
               }?>
               <h2 class="mb-4">Listado de Empresas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Descripcion</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($empresaList as $empresa)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $empresa->getName() ?></td>
                                             <td><?php echo $empresa->getDescripcion() ?></td>
                                             <td> <a href="<?php echo FRONT_ROOT ?>Empresa/ShowModView/?name=<?php echo $empresa->getName() ?>" > <button type="button">Modificar</button></a></td>
                                             <td> <a href="<?php echo FRONT_ROOT ?>Empresa/Borrar/?name=<?php echo $empresa->getName() ?>" > <button type="button">Borrar</button></a></td>
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