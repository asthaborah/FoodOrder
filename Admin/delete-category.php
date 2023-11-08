<?php include("../config/constants.php");?>

<?php 
    //security measures 
    //anyone can go to delete-admin page easily without pressing the button 
    //to prevent we check if id and image-name is passed or not 

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //if the button is pressed
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //we have to delete image from the local file
        if($image_name != ""){
            //image is available 
            $path = "../images/category/" . $image_name;

            $remove = unlink($path);
            if(!$remove){
                //if failed to remove then throw a error message
                $_SESSION["remove"] = "Failed to remove the image";

                //redirect to the category page
                header("location:" . SITEURL . "admin/manage-category.php");

                die();
            }
        }

        //run query to delete from the database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        $res = mysqli_query($conn , $sql);

        if($res){
            $_SESSION['delete'] = "<div class = 'success'>Category deleted succesfully</div>";

            header("location:" . SITEURL . "admin/manage-category.php");
        }else{
            $_SESSION['delete'] = "<div class = 'error'>Failed to delete category</div>";

            header("location:" . SITEURL . "admin/manage-category.php");
        }

    }else{
        //button is not pressed
        //redirect to manage-category page
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
?>