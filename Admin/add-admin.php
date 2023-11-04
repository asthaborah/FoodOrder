<?php include("partials/menu.php");?>
<!-- Main menu starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>
        <table class ="tbl-custom">
            <!-- creating a form -->
            <form action = "" method="post">
                <tr>
                    <td>Full Name : </td>
                    <td><input type = "text" , name = "full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username : </td>
                    <td><input type = "text" , name = "username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password : </td>
                    <td><input type = "password" , name = "password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type = "submit" , name = "submit" value="Add Admin" class = "btn-success"> 
                    </td>
                </tr>
            </form>
        </table>
    </div>
</div>

<!-- Main menu ends here -->
<?php include("partials/footer.php");?>

<!-- Inserting data when we add the admin -->
<?php

    if(isset($_POST["submit"])){  //to check post method in submit
        //means button is clicked
       
        //1.get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //to encrypt the password

        //2.Write the query for inserting data
        $sql = "INSERT INTO `tbl_admin` SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";
        
        //3. executing the query 
        $res = mysqli_query($conn , $sql) or die(mysqli_error($conn));

        //4.check if the quey is executed successfully
        if($res){
            echo "Data is inserted";
        }else{
            echo "Data is not inserted";
        }

    }
?>