<?php include("Partials/menu.php"); ?>
<!-- Set data in form -->
<?php
//1. Getting the id passed from the update button
$id = $_GET['id'];

//2. Query to display the data
$sql = "SELECT * FROM tbl_admin WHERE id = $id";

//3. Execute the query
$res = mysqli_query($conn, $sql);

//4. Check whether the query is executed or not
if ($res) {
    //Query is executed successfully
    $count = mysqli_num_rows($res);
    if ($count == 1) { //data is available  //point to be noted : security issue url is passed with id and already existing id is available in database then will open the page
        $row = mysqli_fetch_assoc($res); //fetching the row
        $full_name = $row['full_name']; //fetching the data from the table
        $username = $row['username'];
    } else { // data not available
        header("location:" . SITEURL . "admin/manage-admin.php");
    }
}
?>

<!-- Update form starts here -->
<div class="menu-content">
    <div class="wrapper">
        <form action="" method="post">
            <table class="tbl-custom">
                <tr>
                    <td>Full Name : </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username : </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Update form ends here -->

<!-- Update the data -->
<?php
//check if button is clicked or not
if (isset($_POST["submit"])) {
    //button is clicked
    $id = $_POST['id']; // getting data through post method //typecasting as the value we get is a string
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //query to update the data
    $sql ="UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id = $id
        ";

        //in query when we receive something as string then we have to put quote or else it will work without quote

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check if query is executed or not
    if ($res) {
        //query is executed
        //create a session to pass success message
        $_SESSION['update'] = "<div class = 'success'>Admin updated successfully</div>";

        //Redirect to the admin page
        header("location:" . SITEURL . "admin/manage-admin.php");
    } else {
        //button is not clicked
        //when query is not executed successfully
        //create a session to pass success message
        $_SESSION['update'] = "<div class = 'error'>Failed to update admin</div>";

        //Redirect to the admin page
        header("location:" . SITEURL . "admin/manage-admin.php");
    }
}
?>