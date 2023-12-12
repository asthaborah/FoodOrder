<?php include("Partials/menu.php"); ?>

<!-- Main content start here -->

<?php
//check if the button is pressed or not for update category
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //query to take out the details from the tables 
    $sql = "SELECT * FROM tbl_category WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        //take out the count for the rows
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //The count is only 1 as id is unique
            $row = mysqli_fetch_array($res);
            //fetch the details from the row
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            $_SESSION["no-category-found"] = "<div class = 'error'>Category is not found</div>";

            header("location:" . SITEURL . "admin/manage-category.php");
        }
    }
} else {
    header("location:" . SITEURL . "admin/manage-category.php");
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl_custom">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != '') {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/Category/<?php echo $current_image ?>" width="150px">
                            <?php
                        } else {
                            echo "<div class = 'error'>No image added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="Yes">Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active"
                            value="Yes">Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update category" class="btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- updating the data -->
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    $current_image = $_POST['current_image'];


    //now update the image and remove the existing image
    if (isset($_FILES['image']['name'])) { //this checks only if the button is pressed or not but doesn't guarentee the upload
        $image_name = $_FILES['image']['name'];
        //this will check if the image is uploaded or cancelled by user
        if ($image_name != "") {

            $ext = explode(".", $image_name);

            $extension = end($ext);

            $image_name = 'Food_category' . rand(000, 999) . '.' . $extension;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/Category/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if (!$upload) {
                $_SESSION['upload-image'] = "<div class = 'error'>image not uploaded</div>";

                //Redirect to the add-category page again and end the process so that data don't get uploaded in the database

                header("location:" . SITEURL . "admin/update-category.php");

                die();
            }
            //remove the current image if available
            if ($current_image != "") {
                $path = "../images/Category/" . $current_image;
                $remove = unlink($path);

                if (!$remove) {
                    $_SESSION["no-image-remove"] = "<div class = 'error'>Failed to remove image</div>";
                    header("location:" . SITEURL . "admin/manage-category.php");

                    die();
                }
            }

        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }
    //query to update the data
    $sql2 = "UPDATE tbl_category SET
    featured = '$featured',
    active = '$active',
    title = '$title',
    image_name = '$image_name'
    WHERE id = $id
    ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2) {
        $_SESSION["update-category"] = "<div class = 'success'>Category updated succesfully</div>";

        header("location:" .SITEURL. "admin/manage-category.php");
    } else {
        $_SESSION["update-category"] = "<div class = 'error'>Failed to update category</div>";

        header("location:" . SITEURL . "admin/manage-category.php");
    }
}
?>

<!-- Main content ends here -->
<?php include("Partials/footer.php"); ?>