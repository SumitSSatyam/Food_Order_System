<?php 
    //include constants.php for siteurl
    include ('../config/constants.php'); 
    //1.Destroy the session
    session_destroy(); //Unset $_SESSION['uder']

    //2.Redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>