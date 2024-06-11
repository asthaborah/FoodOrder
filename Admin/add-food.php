<?php 
    // Start output buffering
    ob_start();
    include("Partials/menu.php"); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br><br>
        <?php 
            //if image is failed to uploaded
            if(isset($_SESSION['failed-upload-image'])){
                echo $_SESSION['failed-upload-image'];
                unset($_SESSION['failed-upload-image']);
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl_custom">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5"
                            placeholder="Description of the food"></textarea></td>
                </tr>
                <tr>
                    <td>price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><select name="category">
                            <?php
                            //query to show data from the category
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                            $res = mysqli_query($conn, $sql);

                            //count to see if category is there or not
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                //to fetch the data from the database
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id ?>">
                                        <?php echo $title ?>
                                    </option>

                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php 
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                $featured = 'No';
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = 'No';
            }

            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];
                if($image_name != ""){
                    $ext = explode("." , $image_name);
                    $extension = end($ext);

                    //set the image name
                    $image_name = "Food-Name-" . rand(0000,9999) . "." . $extension;
                    $src = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/Food/" . $image_name;

                    $upload = move_uploaded_file($src , $destination_path);

                    if(!$upload){
                        $_SESSION['failed-upload-image'] = "<div class = 'error>Failed to upload image</div>";
                        header("location:" . SITEURL . "admin/add-food.php");
                        ob_end_flush(); // Ensure output buffer is flushed before redirect
                        die();
                    }
                }else{
                    $image_name = "";
                }
            }

            //query to insert into table

            $sql3 = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";

            $res2 = mysqli_query($conn , $sql3);

            if($res2){
                $_SESSION["add-food"] = "<div class = 'success'>Food added successfully</div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            }else{
                $_SESSION["add-food"] = "<div class = 'error'>Failed to add food</div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            }
            ob_end_flush(); // Ensure output buffer is flushed before redirect
        }
    ?>
</div>
<?php include("Partials/footer.php"); ?>