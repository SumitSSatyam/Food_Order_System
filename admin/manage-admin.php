<?php include('partials/menu.php'); ?>

<!-- Main content section start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>



        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Displaying Session Massege
            unset($_SESSION['add']); // Removeing Session Massige
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; // Displaying Session Massege
            unset($_SESSION['delete']); // Removeing Session Massige
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // Displaying Session Massege
            unset($_SESSION['update']); // Removeing Session Massige
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; // Displaying Session Massege
            unset($_SESSION['user-not-found']); // Removeing Session Massige
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; // Displaying Session Massege
            unset($_SESSION['pwd-not-match']); // Removeing Session Massige
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; // Displaying Session Massege
            unset($_SESSION['change-pwd']); // Removeing Session Massige
        }
        ?>
        <br><br>

        <!-- Button to add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Ful Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
            //Query to get all admin 
            $sql = "SELECT * FROM tbl_admin";
            //Exicute the Query
            $res = mysqli_query($conn, $sql);
            // cheak weather the query is exicuted or not  
            if ($res == TRUE) {
                // count rows to cheak weather we have data in database or not
                $count = mysqli_num_rows($res); // Function to get all the rows in database
            
                $sn = 1; //create a variable and assign the value  
                //cheak the num of rows
                if ($count > 0) {
                    //we have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data from database
                        //and while loop will run as long as we have data in database
                        //get individual data 
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the value in our table
                        ?>

                        <tr>
                            <td>
                                <?php echo $sn++; ?>
                            </td>
                            <td>
                                <?php echo $full_name; ?>
                            </td>
                            <td>
                                <?php echo $username; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                                    class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                    class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                    class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // we do not have data in database
                }
            }

            ?>




        </table>

    </div>
</div>
<!-- Main content section end -->

<?php include('partials/footer.php'); ?>