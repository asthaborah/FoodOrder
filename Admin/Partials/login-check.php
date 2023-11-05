<?php 
    //we will implement access control here
    //session for checking if user is logged in or not
    //this page will be accessible in all the pages so that if anyone tries to access without login then they have to login first
    if(!isset($_SESSION["user-login"])){
        $_SESSION["no-login"] = "<div class = 'error'>Please login first</div>"; 
        //redirect to login page
        header("location:" . SITEURL . "admin/login.php");
    }
?>