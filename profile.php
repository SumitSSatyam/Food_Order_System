<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>






    <?php include('config/constants.php'); ?>

    <html>

    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>






        <!-- Navbar Section Starts Here -->
        <section class="navbar">
            <div class="container">

                <div class="menu text-right">
                    <ul>
                        <li>
                            <a href="<?php echo SITEURL; ?>">Home</a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Navbar Section Ends Here -->

        <div class="login">
            <h1 class="text-center">User Login</h1>
            <br><br>

            <?php

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            if (isset($_SESSION['login'])) // Cheaking weather the session is add or not
            {
                echo $_SESSION['login']; // Displaying Session Massege if set
                unset($_SESSION['login']); // Removeing Session Massige
            
            }
            ?>
            <br><br>

            <!-- Login Form start here -->
            <form action="" method="POST" class="text-center">
                Email Id: <br>
                <input type="text" name="username" placeholder="Enter Email"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
                <p>We don't have Account</p> <a href="<?php echo SITEURL; ?>signup.php">signup Here </a>
                <br><br>
            </form>

            <!-- Login Form end here -->

            <p class="text-center">Created By - <a href="www.vijaythapa.com">Sumit Satyam</a></p>
        </div>

    </body>

    </html>

    <?php
    //Cheak weather the submit button is clicked or not
    if (isset($_POST['submit'])) {
        //process for login
        //1. Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2.SQL to cheak weather the user with username ans password is exist or not 
        $sql = "SELECT * FROM tblusers WHERE Emailid='$username' AND password='$password'";

        //Exicute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count roes to cheak weather the user exist or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //User available login success
            $_SESSION['login'] = "<div class='success text-center'>Login Sucessfully.</div>";
            $_SESSION['user'] = $username; //To cheak weather the user is logged in or not and logout will unset it
    
            //redirect to home page/Dashboard 
            header('location:' . SITEURL . '');
        } else {
            // user not available Fail
            $_SESSION['login'] = "<div class='error text-center'>username or password did not match.</div>";
            //redirect to home page/Dashboard 
            header('location:' . SITEURL . 'profile.php');
        }

    }
    ?>