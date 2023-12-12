<?php include("Partials/menu.php"); ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $featured = $row['featured'];
            $active = $row['active'];
        }else{
            $_SESSION["no-food-found"] = "<div class = 'error'>Food is not found</div>";

            header("location:" . SITEURL . "admin/manage-food.php");
        }
    } else {
        header("location:" . SITEURL . "admin/manage-food.php");
    }

} else {
    header("location:" . SITEURL . "admin/manage-food.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-custom">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description ?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class = 'error'>Image not available</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $current_image ?>" width="150px">
                            <?php
                        }
                        ?>
                    </td>


                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><select name="category">
                            <?php
                            $sql2 = "SELECT * FROM tbl_category where active = 'Yes'";
                            $res2 = mysqli_query($conn, $sql2);
                            $count = mysqli_num_rows($res2);
                            if ($count > 0) {
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $category_id = $row2['id'];
                                    $category_title = $row2['title'];
                                    ?>
                                    <option <?php if ($current_category == $category_id){echo "selected";} ?>value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                                    <?php
                                }
                            } else {
    
                                echo "<option value='0'>No category added</option>";
                    
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active== "No") {echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update food" class='btn-success'>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $current_image = $_POST['current_image'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //check if the new image button is been pressed or not
    if (isset($_FILES['image']['name'])) { // this process doesn't guarentee if the image is uploaded or not
        $image_name = $_FILES['image']['name']; // this will store the image in that variable if not uploaded then empty string will be stored

        //now check if the image is uploaded or not
        if ($image_name != "") {
            $ext = explode(".", $image_name); //split the image according to the dot
            $extension = end($ext); // only fetch the extension of the image file

            //renaming the image
            $image_name = 'Food-category' . rand(0000, 9999) . '.' . $extension;

            //set the source path
            $source_path = $_FILES['image']['tmp_name'];

            //set the destination path
            $destination_path = "../images/Food/" .$image_name;

            //upload the image

            $upload = move_uploaded_file($source_path, $destination_path);

            if (!$upload) {
                $_SESSION["failed-upload-food"] = "<div class = 'error'>Failed to upload image</div>";

                header("location:" . SITEURL . "admin/manage-food.php");

                die();
            }

            if($current_image != ""){
                $remove_path = "../images/Food/" . $current_image;
                $remove = unlink($remove_path);

                //check whether the image is removed or not
                if($remove == false){
                    //failed to remove current image
                    $_SESSION["remove-failed"] = "<div class = 'error'>Failed to remove current image</div>";

                    header("location:" . SITEURL . "admin/manage-food.php");

                    die();
                }
            }
        }
    } else {
        $image_name = $current_image; // if the image is not selected then set the original image
    }

    //write sql query to update
    $sql3 = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            image_name = '$image_name',
            price = $price,
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id = $id";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3) {
        //query has executed successfully
        $_SESSION["updated-food"] = "<div class = 'success'>Category updated succesfully</div>";
        header("location:" . SITEURL . "admin/manage-food.php");
    } else {
        //query has failed to execute

        $_SESSION["updated-food"] = "<div class='error'>Failed to update</div>";
        header("location:" . SITEURL . "admin/manage-food.php");

        //redirect to manage-food page
    }

}
?>
<?php include("Partials/Footer.php"); ?>