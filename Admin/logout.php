<!-- add the constants file -->
<?php include("../config/constants.php"); ?>

<!-- destroy a session -->
<?php 
    session_destroy();

    //Redirect to the login page
    header("location:" . SITEURL . "admin/login.php");
?>

