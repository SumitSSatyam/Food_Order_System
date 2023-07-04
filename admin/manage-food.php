<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1><br><br>
        <!-- Button to add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>

        <?php
        if (isset($_SESSION['add'])) // Cheaking weather the session is add or not
        {
            echo $_SESSION['add']; // Displaying Session Massege if set
            unset($_SESSION['add']); // Removeing Session Massige
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['unautho'])) {
            echo $_SESSION['unautho'];
            unset($_SESSION['unautho']);
        }
        if (isset($_SESSION['updat'])) {
            echo $_SESSION['updat'];
            unset($_SESSION['updat']);
        }
        if (isset($_SESSION['sami'])) {
            echo $_SESSION['sami'];
            unset($_SESSION['sami']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
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
            //create sql query to get all the food 
            $sql = "SELECT * FROM tbl_food";
            //exicute the query
            $res = mysqli_query($conn, $sql);
            //count row cheak weather we have food or not
            $count = mysqli_num_rows($res);
            //create serial number variable and set default value as 1
            $sn = 1;
            if ($count > 0) {
                //we have food in database
                //get the food from database and display
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the value from individual column
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $sn++; ?>
                        </td>
                        <td>
                            <?php echo $title; ?>
                        </td>
                        <td>$
                            <?php echo $price; ?>
                        </td>
                        <td>
                            <?php
                            if ($image_name != "") {
                                // echo $image_name;
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="no image found"
                                    width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>No image Added.</div>";
                            }

                            ?>
                        </td>
                        <td>
                            <?php echo $featured; ?>
                        </td>
                        <td>
                            <?php echo $active; ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                                class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                class="btn-danger">Delete Food</a>
                        </td>
                    </tr>


                    <?php
                }
            } else {
                //food not added in database
                echo "<tr><td colspan='7' class='error'> Food not added yet</td></tr>";
            }

            ?>




        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>