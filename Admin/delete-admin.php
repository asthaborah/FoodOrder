<?php
//Include the constanst file for database connection
include("../config/constants.php");

//fetch the id from manage-admin
$id = $_GET['id'];

//query to delete from the table
$sql = "DELETE FROM tbl_admin WHERE id =$id";

//executing the query
$res = mysqli_query($conn, $sql);

//check if the query is executed or not

if ($res) {
    //if query is executed successfully
    $_SESSION['delete'] = "Admin deleted successfully";

    //redirect to manage admin page
    header("location:" . SITEURL . "admin/manage-admin.php");
} else {
    //if query is not executed successfully
    $_SESSION['delete'] = "Error deleting admin";

    //redirect to manage admin page
    header("location:" . SITEURL . "admin/manage-admin.php");
}
?>