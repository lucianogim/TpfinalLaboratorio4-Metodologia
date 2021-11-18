<?php

require_once(VIEWS_PATH."navAdmin.php");

if (!isset($_SESSION['loggedAdmin']))
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
               <h2 class="mb-4">Listado</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
                         <th>Dni</th>
                         <th>Genero</th>
                         <th>Cumpleanos</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <th>Declinar</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($studentList as $student)
                        {
                            if( $student->getActive() )
                            {
                                
                        ?>
                            <tr>
                                <td><?php echo $student->getFilenumber() ?></td>
                                <td><?php echo $student->getLastName() ?></td>
                                <td><?php echo $student->getFirstName() ?></td>
                                <td><?php echo $student->getDni() ?></td>
                                <td><?php echo $student->getGender() ?></td>
                                <td><?php echo $student->getBirthdate() ?></td>
                                <td><?php echo $student->getEmail() ?></td>
                                <td><?php echo $student->getPhone() ?></td>
                                <td> <a href="<?php echo FRONT_ROOT ?>Postulante/BajaPostulante/?idStudent=<?php echo $student->getStudentId() ?>" > <button type="button">Declinar</button></a></td>
    
                            </tr>
                        <?php
                            }
                        } 
                        ?>
                     </tr>
                    </tbody>
               </table>
                    
                <form  action="<?php echo FRONT_ROOT ?>/generar-pdf.php" method="post" target="_blank">
                    <?php 

                        $arrayToEncode = array();
                        foreach($studentList as $student)
                        {   
                            $valuesArray["fileNumber"] = $student->getFileNumber();
                            $valuesArray["firstName"] = $student->getFirstName();
                            $valuesArray["lastName"] = $student->getLastName();
                            $valuesArray["dni"] = $student->getDni();
                            $valuesArray["gender"] = $student->getGender();
                            $valuesArray["birthdate"] = $student->getBirthdate(); 
                            $valuesArray["email"] = $student->getEmail(); 
                            $valuesArray["phone"] = $student->getPhone(); 

                            array_push($arrayToEncode, $valuesArray);
                        }

                        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
                    ?>
            
                    <input type="hidden" name="studentList" value="<?php $studentList ?>"> </input>
                    <button type="submit" target="_blank">Generar PDF</button>
                </form>
                
          </div>
     </section>
</main>