<?php
    //starting a session
    session_start();
    //creating constants to store values in database
    define("SITEURL" , "http://localhost:8080/FoodOrder/"); //url for the homepage
    define("LOCALHOST" , "localhost");
    define("DB_USERNAME" , "root");
    define("DB_PASSWORD" , "");
    define("DB_NAME" , "foodorder");
    $conn = mysqli_connect(LOCALHOST , DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //essential credetial for connecting with a database
    $db_select = mysqli_select_db($conn , DB_NAME) or die(mysqli_error($conn)); //connecting with the database
?>