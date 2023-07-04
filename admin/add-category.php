<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) // Cheaking weather the session is add or not
        {
            echo $_SESSION['add']; // Displaying Session Massege if set
            unset($_SESSION['add']); // Removeing Session Massige
        }

        if (isset($_SESSION['upload'])) // Cheaking weather the session is add or not
        {
            echo $_SESSION['upload']; // Displaying Session Massege if set
            unset($_SESSION['upload']); // Removeing Session Massige
        }
        ?>
        <br><br>
        <!-- Add Category Form Start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Category Form End -->

        <?php
        //Cheak the submit button is clicked or not 
        if (isset($_POST['submit'])) {
            // echo "clicked";
            //Get the value from caregoyr form
            $title = $_POST['title'];
            //For radio input type we need to cheak wether the button is sselected  or not
            if (isset($_POST['featured'])) {
                //get the value from form 
                $featured = $_POST['featured'];
            } else {
                //set the default value
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                //get the value from form 
                $active = $_POST['active'];
            } else {
                //set the default value
                $active = "No";
            }
            //weather the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);
            // die();
            if (isset($_FILES['image']['name'])) {

                //upload the image 
                //To upload image name and source path and destinetion path
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {

                    //Auto rename our image
                    //Get the extension of our image (jpg,png,gif.etc) eg: "special1.food1.jpg"
        
                    $extn = pathinfo($image_name, PATHINFO_EXTENSION);
                    $randno = rand(0, 1000);
                    $rename = 'Upload' . date('ymd') . $randno;
                    $image_name = $rename . '.' . $extn;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    //upload the image 
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //cheak weather the image uploaded or not 
                    //And if the image is not uploded then we will stop the process and redirect with error massege
                    if ($upload == false) {
                        //set a session massige 
                        $_SESSION['upload'] = "<div class='error'>Fail to upload image.</div>";
                        //Reditect page to add category
                        header("location:" . SITEURL . 'admin/add-category.php');
                        //stop the process
                        die();
                    }

                }

            } else {
                //do not upload image and set the image name value as blank
                $image_name = "";

            }
            // create sql query to insert category into database
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'

            ";
            //Exicute the cuery and save in database
            $res = mysqli_query($conn, $sql);
            //cheak weather the query exicuted or not and data added or not 
            if ($res == true) {
                //Query exicuted and category added
                $_SESSION['add'] = "<div class='success'>Category Added sucessfully.</div>";
                //Reditect page to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //Fail to add category
                $_SESSION['add'] = "<div class='error'>Fail to add category.</div>";
                //Reditect page to manage category
                header('location:' . SITEURL . 'admin/add-category.php');
            }


        }

        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>