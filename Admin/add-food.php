<?php include("Partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <form action="" method="post">
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
</div>
<?php include("Partials/footer.php"); ?>