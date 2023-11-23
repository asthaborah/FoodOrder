<?php include("../config/constants.php")?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //delete the image from the folder also
        if($image_name != ""){
           $path = "../images/Food/" . $image_name;

           $remove = unlink($path);
           if(!$remove){
            //if failed to delete image
            $_SESSION["Failed-food-image"] = "<div class = 'error'>Failed to delete the image</div>";
            header("location:" . SITEURL . "admin/manage-food.php");
            die();
            //end the process
           }
        }

        $sql = "DELETE FROM tbl_food WHERE id = $id";
        $res = mysqli_query($conn , $sql);

        if($res){
            $_SESSION["delete-food"] = "<div class = 'success'>Food has been deleted successfully</div>";
            header("location:" . SITEURL . "admin/manage-food.php");
        }else{
            $_SESSION["delete-food"] = "<div class = 'success'>Failed to delete food</div>";
            header("location:" . SITEURL . "admin/manage-food.php");
        }
    }else{
        //redirect to manage page if button not pressed
        header("location:" . SITEURL . "admin/manage-food.php");
    }

?>