<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            // Get the id of selected admin
             $id=$_GET['id']; 
             //create sql query to get the detail
             $sql = "SELECT * FROM tbl_admin WHERE id=$id";
             //Exicute the Query
             $res = mysqli_query($conn, $sql);
             // cheak weather the query is exicuted or not 
             if($res==TRUE)
             {
                 // count rows to cheak weather we have data in database or not
                 $count = mysqli_num_rows($res);// Function to get all the rows in database
                 //cheak we have admin data or not
                 if($count==1)
                 {
                    //get the detail
                    // echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['username'];

                 }
                 else
                 {
                    //Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                 }

             }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                     <td>Full Name</td>
                     <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                      <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php  
    //cheak weather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo "Button clicked";
        //get all the value from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a sql Query to Update Admin
        $sql="UPDATE tbl_admin SET
        full_name='$full_name',
        username='$username' 
        WHERE id='$id'
        ";

        //Exicute the Query
        $res=mysqli_query($conn,$sql);
        //cheak weather the query exicuted sucessfully or not
        if($res==true)
        {
            //Query exicuted and admin updated
            $_SESSION['update']= "<div class='success'>Admin Updated sucessfully.</div>";
            //Reditect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //fail to update admin
            $_SESSION['update']= "<div class='error'>Fail to delete Admin.</div>";
            //Reditect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>