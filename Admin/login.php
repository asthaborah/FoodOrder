<?php include("../config/constants.php"); ?>
<html>

<head>
    <title>FoodOrder Login's page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body style="background-color: #ff7d59;background-image: linear-gradient(319deg, #ff7d59 0%, #ff583a 37%, #f4a698 100%);">
<!-- login form starts here -->
    <div class="login">
        <h1 class = "text-align">Login</h1>
        <form action = "" method="post" class = "text-align">
            <br>

            <?php if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            } ?>
            <br>
            Username
            <br>
            <input type ="text" name = "username" placeholder="Enter your username"> <br><br>
            Password
            <br>
            <input type ="password" name = "password" placeholder="Enter your password"> <br><br>

            <input type ="submit" name = "submit" value="Login" class = "btn-primary"><br><br>
        </form>
        <p class = "text-align">Created by : <a href="https://asthaborah.github.io/Asthaborah/">Astha Borah</a></p>
    </div>
<!-- login form ends here -->

<?php 
    if(isset($_POST["submit"])){
        //check if the button is clicked or not
        //retrieve data from the form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //run a query to check if the data exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //execute the query
        $res = mysqli_query($conn , $sql);

        // check if the query is executed or not
        if($res){
            $count = mysqli_num_rows($res);
            if($count == 1){
                //user exist
                $_SESSION["login"] = "<div class = 'success'>Login successfully</div>";

                //Redirect to the home admin page
                header("location:" . SITEURL . "admin/");
            }else{
                //user exist
                $_SESSION["login"] = "<div class = 'error text-align' >Admin doesn't exist</div>";

                //Redirect to the home admin page
                header("location:" . SITEURL . "admin/login.php");
            }
        }
    }
?>
</body>

</html>