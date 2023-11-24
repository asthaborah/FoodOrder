<?php include("Partials/menu.php"); ?>
<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header("location:" . SITEURL . "admin/manage-food.php");
    }
?>
<?php include("Partials/Footer.php"); ?>