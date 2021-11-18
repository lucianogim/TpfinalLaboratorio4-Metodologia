<?php
    require_once('navAdmin.php');

    if (!isset($_SESSION["loggedAdmin"]))
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