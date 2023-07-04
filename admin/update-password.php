<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="enter Current password">
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="enter new password">
                </td>
            </tr>
            <tr>
                <td>Conf. Password:</td>
                <td>
                    <input type="password" name="conform_password" placeholder="conform password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
<?php  
         if(isset($_POST['submit']))
         {
             //echo "Button clicked";
             $id=$_POST['id'];
             $current_password=md5($_POST['current_password']);
             $new_password=md5($_POST['new_password']);
             $conform_password=md5($_POST['conform_password']);
             // Cheak weather the user with current id and current password
             $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

              //Exicute the Query
              $res = mysqli_query($conn, $sql);
              
              if($res==TRUE)
              {
                  // cheak weather data in available in database or not
                  $count = mysqli_num_rows($res);// Function to get all the rows in database
                  //cheak we have admin data or not
                  if($count==1)
                  {
                     //user exist and password can be changed
                     //echo "user found";
                     //cheak weather the new password and conform password is match or not
                     if($new_password==$conform_password)
                     {
                        //update the password
                        //echo "password match";
                        $sql2="UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                        ";

                        //Exicute the Query
                        $res2=mysqli_query($conn,$sql2);
                        //cheak weather the query exicuted sucessfully or not
        if($res==true)
        {
            //display sucess
           //Redirect to manage admin page with a sucess msgmasage
           $_SESSION['change-pwd']="<div class='success'>password changed sucessfully</div>";
           //Redirect to manage admin page
           header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
           //display error
            //Redirect to manage admin page with error massage
            $_SESSION['change-pwd']="<div class='error'>Fail to Change Password</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
                     }
                     else
                     {
                        //Redirect to manage admin page with a masage
                        $_SESSION['pwd-not-match']="<div class='error'>password did not match</div>";
                        //Redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                     }
                  }
                  else
                  {
                     // User does not exist set massege and redirect
                     $_SESSION['user-not-found']="<div class='error'>user not Found</div>";
                     //Redirect to manage admin page
                     header('location:'.SITEURL.'admin/manage-admin.php');
                  }
                }

         }
?>


<?php include('partials/footer.php'); ?>