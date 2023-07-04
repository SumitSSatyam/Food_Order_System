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
        <h1 class="text-center">User SignUp</h1><br>
        <!-- Login Form start here -->
        <form action="" method="POST" class="text-center">
            Full name: <br>
            <input type="text" name="FullName" placeholder="Enter name"><br><br>

            Email id: <br>
            <input type="email" name="Emailid" placeholder="Enter email"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br><br>

            Contact No: <br>
            <input type="tel" name="ContactNo" placeholder="Enter contact No"><br><br>

            Address: <br>
            <textarea name="Address" cols="30" rows="10"></textarea>

            <input type="submit" name="submit" value="Sign Up" class="btn-primary"><br><br>

        </form>
        <?php
        //cheak weather the submit button is clickid or not
        if (isset($_POST['submit'])) {
            //get the data from form
            $customer_name = $_POST['FullName'];
            $customer_email = $_POST['Emailid'];
            $customer_contact = $_POST['ContactNo'];
            $password = md5($_POST['password']);
            $customer_address = $_POST['Address'];

            //2.SQL Query to save the data into database
            $sql = "INSERT INTO tblusers SET
                FullName='$customer_name',
                Emailid='$customer_email',
                ContactNo='$customer_contact',
                Password='$password',
                Address='$customer_address'
                ";

            //3.Exicuting cuery and saving data in to database
            $res = mysqli_query($conn, $sql);

            //4.Cheak weather the (Query is executed) data is inserted or not and display apporopriate massege
            if ($res == TRUE) {
                echo "data inserted";
            }
        }


        ?>

        <!-- Login Form end here -->

        <p class="text-center">Created By - <a href="www.vijaythapa.com">Sumit Satyam</a></p>
    </div>
</body>

</html>