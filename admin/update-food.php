<?php include('partials/menu.php'); ?>
<?php
//cheak weather the id is set or not
if (isset($_GET['id'])) {
    //get all the detail
    $id = $_GET['id'];
    //create sql query to get the selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //exicute the query
    $res2 = mysqli_query($conn, $sql2);
    //get the value based on query exicuted
    $row2 = mysqli_fetch_assoc($res2);
    //get the indivisual value of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];

} else {
    //redirect to manage food
    header("location:" . SITEURL . 'admin/manage-food.php');
}

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
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
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="no image found"
                                width="100px">
                            <?php
                        } else {
                            // display the massege
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //query to get active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //exicute the query
                            $res = mysqli_query($conn, $sql);
                            //count the rows
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                //categiry available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    // echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if ($current_category == $category_id) {
                                        echo "selected";
                                    } ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?>
                                    </option>
                                    <?php
                                }
                            } else {
                                //category not available
                                echo "<option value='0'>Category not Available</option>";
                            }

                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="Yes"> Yes
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
                        } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>
        <?php
        //cheak weather the button is clicked or not 
        if (isset($_POST['submit'])) {
            // echo "clicked";
            //get all the value from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];




            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                //cheak weather image is available or not
                if ($image_name != "") {
                    //Auto rename our image
                    //Get the extension of our image (jpg,png,gif.etc) eg: "special1.food1.jpg"
        
                    $extn = pathinfo($image_name, PATHINFO_EXTENSION);
                    $randno = rand(0, 1000);
                    $rename = 'Upload' . date('ymd') . $randno;
                    $image_name = $rename . '.' . $extn;


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;

                    //upload the image 
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //cheak weather the image uploaded or not 
                    //And if the image is not uploded then we will stop the process and redirect with error massege
                    if ($upload == false) {
                        //set a session massige 
                        $_SESSION['upload'] = "<div class='error'>Fail to upload image.</div>";
                        //Reditect page to manage admin
                        header("location:" . SITEURL . 'admin/manage-food.php');
                        //stop the process
                        die();
                    }

                    //remove the current image
                    if ($current_image != "") {


                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);

                        //Redirect to manage category page
                        // header('location:' . SITEURL . 'admin/manage-food.php');
        

                        //If fail to remove image then add an error message and stop the process
                        if ($remove == false) {
                            // echo "remove not work";
                            //Set the session message
                            $_SESSION['sami'] = "<div class='error'>Fail TO Remove Current Image</div>";
                            //Redirect to manage category page
                            header('location:' . SITEURL . 'admin/manage-food.php');
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
            $sql3 = "UPDATE tbl_food SET 
             title='$title',
             description='$description',
             price=$price,
             image_name='$image_name',
             category_id='$category',
             featured='$featured',
             active='$active'
             WHERE id=$id
             ";

            //exicute the query
            $res3 = mysqli_query($conn, $sql3);

            //redirect to manage category with massege
            //cheak weather the query exicuted or not
            if ($res3 == true) {
                //Query exicuted and category updated
                $_SESSION['update'] = "<div class='success'>food Updated sucessfully.</div>";
                //Reditect page to manage category
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Fail to add category
                $_SESSION['update'] = "<div class='error'>Fail to Update food.</div>";
                //Reditect page to manage category
                header('location:' . SITEURL . 'admin/manage-food.php');
            }

        }

        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>