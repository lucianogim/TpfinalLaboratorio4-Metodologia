<?php

    require_once('nav.php');

    if (!isset($_SESSION['loggedUser']))
{
    //require_once(VIEWS_PATH."login.php");
    header("Location: Index");
    die();
}
else{
    $student = $_SESSION['loggedUser'];
}

$_SESSION["idjoboffer"] = $idJobOffer; 

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Cargue su CV</h2>
               <form action="<?php echo FRONT_ROOT ?>Postulante/Add" method="post" enctype="multipart/form-data" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">id job</label>
                                   <input type="text" name="idJobOffer" value="<?php echo $idJobOffer ?>" class="form-control" disabled>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="for-group">
                                <input type="file" name="cv" value="" required>
                            </div>
                        </div> 
                    </div>                 
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Enviar</button>
               </form>
          </div>
     </section>
</main>