<?php include("Partials/menu.php") ?>

<!-- Get the data  -->
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>

<!-- Main content start here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <form action="" method="post">
            <table class="tbl-custom">
                <tr>
                    <td>Current Password : </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New password : </td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password : </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main content ends here -->

<!-- changing the password -->
<?php
//get the data from the form
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    // create sql query to check id and current password is same
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user is found
            //match the password
            if ($new_password == $confirm_password) {
                //password is matched
                //create a sql query to update password
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id = $id";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2) {
                    //if the query executed successfully
                    $_SESSION["Update-password"] = "<div class = 'success'>Password updated successfully</div>";
                    //redirect to admin pafe
                    header("location:" . SITEURL . "admin/manage-admin.php");
                } else {
                    //if the query is not executed successfully
                    $_SESSION["Update-password"] = "<div class = 'error'>Error updating password</div>";
                    //redirect to admin page
                    header("location:" . SITEURL . "admin/manage-admin.php");
                }
            } else {
                //password not matched
                $_SESSION["pwd-not-found"] = "<div class = 'error'>Password did not match</div>";
                //redirect to admin page
                header("location:" . SITEURL . "admin/manage-admin.php");
            }
        } else {
            //user doesn't exist
            $_SESSION["User-not-found"] = "<div class = 'error'>User not found</div>";
            //redirect to admin page
            header("location:" . SITEURL . "admin/manage-admin.php");
        }
    }
}
?>
<?php include("Partials/Footer.php") ?>