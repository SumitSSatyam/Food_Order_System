<?php 
    //include constant .php file hare
    include('../config/constants.php');

    //1.get the id of admin to be deleted 
    $id = $_GET['id'];

    //2.Create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Exicute the query
    $res = mysqli_query($conn, $sql);

    //Cheak weather the query exicuted sucessfully or not
    if($res==true)
    {
        //Query exicute sucessfully And admin Deleted
        // echo "Admin Deleted";
        //create session variable to delete masage
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Sucessfully.</div>";
        //redirect to manage aadmin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Fail to delete Admin
       // echo "Fail to delete Admin";
       $_SESSION['delete'] = "<div class='error'>Fail to Delete Admin Try Again Latter.</div>";
        //redirect to manage aadmin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3.Redirect to manage admin page with massege (Sucess , Error)


?>