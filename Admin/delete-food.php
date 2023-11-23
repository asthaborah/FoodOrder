<?php include("../config/constants.php")?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        //redirect to manage page if button not pressed
        header("location:" . SITEURL . "admin/manage-food.php");
    }

?>