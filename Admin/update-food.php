<?php include("Partials/menu.php"); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
                    <td><input type="text" name="title" value=""></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value=""></td>
                </tr>
                <tr>
                    <td>Current Image:</td>

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
                            $res = mysqli_query($conn, $sql2);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    ?>
                                    <option value="<?php echo $category_id ?>">
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
            </table>
        </form>
    </div>
</div>
<?php include("Partials/Footer.php"); ?>