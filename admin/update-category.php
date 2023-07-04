<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        //cheak weather the id is set or not
        if (isset($_GET['id'])) {
            //Get the id and all other details
            // echo "get daat";
            $id = $_GET['id'];
            //create sql query to get all other detail
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            //exicute the query
            $res = mysqli_query($conn, $sql);
            //count the rows to cheak weather the id is valid or not 
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            } else {
                //redirect to manage category with session massege
                $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
                //Reditect page to manage category
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        } else {
            //redirec to manage category
            header("location:" . SITEURL . 'admin/manage-category.php');

        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //display the image
                            // echo "image hai";
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"
                                alt="no image found" width="100px">
                            <?php
                        } else {
                            // display the massege
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="Yes">
                        Yes

                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes">
                        Yes

                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No">
                        No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        //cheak weather the button is clicked or not 
        if (isset($_POST['submit'])) {
            // echo "button clicked";
            //get all the value from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //updating new image if selected
            //cheak weather the image is selected or not
            if (isset($_FILES['image']['name'])) {
                //get the image detail
                $image_name = $_FILES['image']['name'];
                //cheak weather image is available or not
                if ($image_name != "") {
                    //image is available
                    //upload the new image
        
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
                        //Reditect page to manage admin
                        header("location:" . SITEURL . 'admin/manage-category.php');
                        //stop the process
                        die();
                    }

                    //remove the current image
                    if ($current_image != "") {


                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        //If fail to remove image then add an error message and stop the process
                        if ($remove == false) {
                            // echo "remove not work";
                            //Set the session message
                            $_SESSION['failed-remove'] = "<div class='error'>Fail TO Remove Current Image</div>";
                            //Redirect to manage category page
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            //Stop the process
                            die();

                        }
                    }


                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //update the databae
            $sql2 = "UPDATE tbl_category SET 
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id=$id
            
            ";

            //exicute the query
            $res2 = mysqli_query($conn, $sql2);

            //redirect to manage category with massege
            //cheak weather the query exicuted or not
            if ($res2 == true) {
                //Query exicuted and category updated
                $_SESSION['update'] = "<div class='success'>Category Updated sucessfully.</div>";
                //Reditect page to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //Fail to add category
                $_SESSION['update'] = "<div class='error'>Fail to Update category.</div>";
                //Reditect page to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            }

        }
        ?>


    </div>
</div>


<?php include('partials/footer.php'); ?>