<?php include("Partials/menu.php"); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id = $id";
    $res = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($res);
    $title = $row['title'];
    $description = $row['description'];
    $price = $row['price'];
    $current_image = $row['image_name'];
    $current_category = $row['category_id'];
    $featured = $row['featured'];
    $active = $row['active'];
    
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
                    <td><input type="text" name="title" value="<?php echo $title?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                    <?php 
                        if($current_image == ""){
                            echo "<div class = 'error'>Image not available</div>";
                        }else{
                            ?>
                            <img src = "<?php echo SITEURL; ?>images/Food/<?php echo $current_image?>" width="150px">
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
                                    <option <?php if($current_category == $category_id){echo "selected";}?> value="<?php echo $category_id ?>">
                                        <?php echo $category_title ?>
                                    </option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category added</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                        <input type="hidden" name="id" value="<?php echo $id?>" >
                        <input type="submit" name="submit" value="Update food" class = 'btn-success'>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("Partials/Footer.php"); ?>