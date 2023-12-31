<?php include("Partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>
        <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add food</a>

        <br><br><br>
        <?php
        //if the food is added or not
        if (isset($_SESSION['add-food'])) {
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }

        //session for delete food
        if (isset($_SESSION['delete-food'])) {
            echo $_SESSION['delete-food'];
            unset($_SESSION['delete-food']);
        }

        if (isset($_SESSION['Failed-food-image'])) {
            echo $_SESSION['Failed-food-image'];
            unset($_SESSION['Failed-food-image']);
        }

        //if the food image is not uploaded
        if(isset($_SESSION["failed-upload-food"])){
            echo $_SESSION["failed-upload-food"];
            unset($_SESSION["failed-upload-food"]);
        }

        //if the food is updated or not
        if(isset($_SESSION["updated-food"])){
            echo $_SESSION["updated-food"];
            unset($_SESSION["updated-food"]);
        }

        //if there is no category
        if(isset($_SESSION["no-food-found"])){
            echo $_SESSION["no-food-found"];
            unset($_SESSION["no-food-found"]);
        }

        //if the image is failed to remove
        if(isset($_SESSION["remove-failed"])){
            echo $_SESSION["remove-failed"];
            unset($_SESSION["remove-failed"]);
        }
        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        $image_name = $row['image_name'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php 
                                if($image_name == ""){
                                    echo "<div class = 'error'>No image added</div>";
                                }else{
                                    ?>
                                    <img src="../images/Food/<?php echo $image_name?>" width = 100px>
                                    <?php
                                }
                                ?>
                             </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id?>" class="btn-success">Update Food</a>
                                <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                            </td>

                        </tr>
                        <?php
                    }
                } else {
                    echo "<table><tr><td colspan = '7' class = 'error'>Food not added yet</td></tr></table>";
                }
            }
            ?>
        </table>
    </div>
</div>
<?php include("Partials/Footer.php") ?>