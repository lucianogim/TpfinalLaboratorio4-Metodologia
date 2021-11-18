<?php
    require_once('nav-company.php');

    if (!isset($_SESSION["loggedCompany"]))
    {
    //require_once(VIEWS_PATH."login.php");
    header("Location: Index");
    die();
    }
?>
<?php if($alert != ""){
                    ?>
                    <div class="alert alert-info" role="alert">
                    <?php echo $alert; ?>
                    </div><?php
               }?>