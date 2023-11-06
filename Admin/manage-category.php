<?php include("Partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <a href="<?php echo SITEURL?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br>
        <?php 
        //if category is added successfully
            if(isset($_SESSION["add"])) {
                echo $_SESSION["add"];
                unset($_SESSION["add"]);
            }
        ?>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>UserName</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Astha Borah</td>
                <td>asthaborah1</td>
                <td>
                    <a href="#" class="btn-success">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>

            </tr>
            <tr>
                <td>2.</td>
                <td>Pranay Jain</td>
                <td>PranayJain09</td>
                <td>
                    <a href="#" class="btn-success">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>

            </tr>
            <tr>
                <td>3.</td>
                <td>Prachi shirsale</td>
                <td>shirsalePrachi1</td>
                <td>
                    <a href="#" class="btn-success">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>

            </tr>
        </table>
    </div>
</div>
<?php include("Partials/Footer.php") ?>