<?php  
//Authorization or Access control
// Cheak weather the user logged in or not
if(!isset($_SESSION['user'])) //if user session is not set
{
    //user is not logged in
    //Redirect to login page with messege
    $_SESSION['no-login-message']="<div class='error text-center'>Please Login to access Admin Panel.</div>";
    // Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
}

?>