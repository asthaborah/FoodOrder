<?php include("Partials/menu.php") ?>

<div class="menu-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br>

        <?php
        //if the category is failed to get added
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }

        //if the image is failed to upload
        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }
        ?>

        <br>
        <!-- Form for category start here -->
        <form action="" method="post" enctype="multipart/form-data"> <!-- This allows us to upload image -->
            <table class="tbl-custom">
                <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>
                        Select image:
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        Featured:
                    </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        Active:
                    </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Form for category ends here -->

    <?php
    //check if the button is pressed or not
    if (isset($_POST['submit'])) {
        //get the data from the form
        $title = $_POST['title'];

        //check whether the image is selected or not 
        // print_r($_FILES['image']);
        // die();
        //how image is selected , Array ( [name] => maggi masala.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpADEF.tmp [error] => 0 [size] => 140922 )
    
        if (isset($_FILES['image']['name'])) { //This method only check if button is pressed or not there are changes where user go for upload but cancels it
            //it will check if the image is selected or not with image name
            //now check if image is uploaded or not
            $image_name = $_FILES['image']['name'];

            //check whether the image is uploaded or not
            if ($image_name != "") {
                //we don't want if the image has same name then it will overwrite the image to prevent this we will randomly assign value
                $ext = explode('.', $image_name);
                $extension = end($ext);

                //set the random value
                $image_name = "Food_category" . rand(000, 999) . '.' . $extension;

                //to upload image we need image name , destination path and source path
                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/Category/" . $image_name; //destination where image will get uploaded in local machine
    
                $upload = move_uploaded_file($source_path, $destination_path);
                //check if image is uploaded or not
    
                //if the image upload is successfull it will get uploaded to your files where you have set the path
                if ($upload == false) {
                    //if the image is not uploaded 
                    //set the error session
    
                    $_SESSION['upload'] = "<div class = 'error'>image not uploaded</div>";

                    //Redirect to the add-category page again and end the process so that data don't get uploaded in the database
    
                    header("location:" . SITEURL . "admin/add-category.php");

                    die();
                }

            }else{
                $image_name = "";
            }

        } else {
            //didn't upload images that's why set the image name as blank
            $image_name = "";
        }


        if (isset($_POST['featured'])) {
            //if the radio button is pressed
            $featured = $_POST['featured'];
        } else {
            //set the featured as default
            $featured = "No";
        }

        if (isset($_POST['active'])) {
            //if the radio button is pressed
            $active = $_POST['active'];
        } else {
            //set the featured as default
            $active = "No";
        }

        //create the sql query
        $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed or not
        if ($res) {
            //query is executed
            $_SESSION["add"] = "<div class = 'success'>Category added successfully</div>";

            //redirect to the manage-category page
            header("location:" . SITEURL . "admin/manage-category.php");
        } else {
            //query is executed
            $_SESSION["add"] = "<div class = 'error'>Failed to add category</div>";

            //redirect to the manage-category page
            header("location:" . SITEURL . "admin/add-category.php");
        }
    }
    ?>
</div>

<?php include("Partials/footer.php") ?>