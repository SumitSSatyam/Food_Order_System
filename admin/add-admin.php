<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) // Cheaking weather the session is add or not
        {
            echo $_SESSION['add']; // Displaying Session Massege if set
            unset($_SESSION['add']); // Removeing Session Massige
        
        }
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="your username">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php
//process the value from form and save into database
//cheak weather the submit button is clickid or not
if (isset($_POST['submit'])) {

    // echo "Button clicked";
    //1.get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password Encripton with md5

    //2.SQL Query to save the data into database
    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username= '$username',
            password= '$password'
        ";

    //3.Exicuting cuery and saving data in to database
    $res = mysqli_query($conn, $sql);
    //4.Cheak weather the (Query is executed) data is inserted or not and display apporopriate massege
    if ($res == TRUE) {
        //data inserted
        // echo "data inserted";
        //create a session variable to display massege
        $_SESSION['add'] = "<div class='success'>Admin Added sucessfully.</div>";
        //Reditect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //failed to insert the data
        // echo "failed to insert the data"; 
        //create a session variable to display massege
        $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
        //Reditect page to add admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }

}
?>