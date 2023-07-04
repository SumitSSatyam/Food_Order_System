<?php
//Include constant file
include('../config/constants.php');
// echo "yes"; 
// Cheak weather the id and image_name value is set or not 
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //Get the value and delete
    // echo "Get value And Delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical if available
    if ($image_name != "") {
        //Image Available So remove it
        $path = "../images/Food/" . $image_name;
        //Remove the image 
        $remove = unlink($path);

        //If fail to remove image then add an error message and stop the process
        if ($remove == false) {
            // echo "remove not work";
            //Set the session message
            $_SESSION['remove'] = "<div class='error'>Fail TO Remove food Image</div>";
            //Redirect to manage food page
            header('location:' . SITEURL . 'admin/manage-Food.php');
            //Stop the process
            die();

        }
    }
    //Delete data from database
    //Sql query to delete data from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //Exeicute the Query
    $res = mysqli_query($conn, $sql);

    //Cheak weather the data is deleted from database or not 
    if ($res == true) {
        //set success message and redirect 
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfuly</div>";
        //Redirect to manage food
        header('location:' . SITEURL . 'admin/manage-Food.php');
    } else {
        //set success message and redirect 
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food</div>";
        //Redirect to manage food
        header('location:' . SITEURL . 'admin/manage-Food.php');
    }


} else {
    $_SESSION['unautho'] = "<div class='error'>Unauthorised access</div>";
    //Redirect to manage food page
    header('location:' . SITEURL . 'admin/manage-food.php');
}

?>