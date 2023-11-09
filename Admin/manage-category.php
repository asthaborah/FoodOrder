<?php include("Partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <a href="<?php echo SITEURL ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br>
        <?php
        //if category is added successfully
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }
        //if image is failed to remove
        if (isset($_SESSION["remove"])) {
            echo $_SESSION["remove"];
            unset($_SESSION["remove"]);
        }

        //if category deleted successfully or failed to delete
        if (isset($_SESSION["delete"])) {
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }

        //if category updated successfully or failed to delete
        if (isset($_SESSION["update-category"])) {
            echo $_SESSION["update-category"];
            unset($_SESSION["update-category"]);
        }

        //if failed to remove the local image
        if (isset($_SESSION["no-image-remove"])) {
            echo $_SESSION["no-image-remove"];
            unset($_SESSION["no-image-remove"]);
        }

        //if failed to upload image
        if (isset($_SESSION["upload-image"])) {
            echo $_SESSION["upload-image"];
            unset($_SESSION["upload-image"]);
        }

        ?>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>title</th>
                <th>image_name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <!-- get the data from the table -->
            <?php
            //write a query to fetch data from the table
            $sql = "SELECT * FROM tbl_category";

            //execute the query
            $res = mysqli_query($conn, $sql);

            if ($res) {
                //query is executed
                $count = mysqli_num_rows($res);

                
                if ($count > 0) {
                    //data is there is the database
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td>
                                <?php echo $sn++ ?>
                            </td>
                            <td>
                                <?php echo $title ?>
                            </td>
                            <td>
                                <?php if ($image_name != "") {
                                    ?>
                                        <img src = "<?php echo SITEURL; ?>images/Category/<?php echo $image_name?>" width="100px">
                                    <?php
                                }else{
                                    echo "<div class = 'error'>No image added</div>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $featured ?>
                            </td>
                            <td>
                                <?php echo $active ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-success">Update category</a>
                                <a href="<?php echo SITEURL?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name?>" class="btn-danger">Delete category</a>
                            </td>

                        </tr>

                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">
                            <div class="error">No category added</div>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<?php include("Partials/Footer.php") ?>