<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>
        <table class ="tbl-custom">
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
                    <td>Full Name : </td>
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

<?php include("partials/footer.php");?>