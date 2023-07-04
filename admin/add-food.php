<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) // Cheaking weather the session is add or not
        {
            echo $_SESSION['upload']; // Displaying Session Massege if set
            unset($_SESSION['upload']); // Removeing Session Massige
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"
                            placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            // create php code to display category from database
                            //create sql to get all acive category from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //exicuting the query
                            $res = mysqli_query($conn, $sql);
                            //count row to cheak weather we have category or not
                            $count = mysqli_num_rows($res);
                            //if count is grater then 0 then we have categories else we do not have categories
                            if ($count > 0) {
                                //we have categories 
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details of categori
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                //we do not have categories
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }

                            //display on dropdown
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <?php
        //cheak weather the submit button is clickid or not
        if (isset($_POST['submit'])) {
            //add the food in database
            // echo "click";
            //get the data from form 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            //cheak weather radio button for featured and active are cheaked or not 
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
                    $destination_path = "../images/food/" . $image_name;

                    //upload the image 
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //cheak weather the image uploaded or not 
                    //And if the image is not uploded then we will stop the process and redirect with error massege
                    if ($upload == false) {
                        //set a session massige 
                        $_SESSION['upload'] = "<div class='error'>Fail to upload image.</div>";
                        //Reditect page to add category
                        header("location:" . SITEURL . 'admin/add-food.php');
                        //stop the process
                        die();
                    }

                }

            } else {
                //do not upload image and set the image name value as blank
                $image_name = "";

            }
            //insert into database
            //create a sql query to save or add food
            $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
            ";
            //exicute the query
        

            //Exicute the cuery and save in database
            $res2 = mysqli_query($conn, $sql2);
            //cheak weather the query exicuted or not and data added or not 
            if ($res2 == true) {
                //redirect with massege to manage food page
                //Query exicuted and food added
                $_SESSION['add'] = "<div class='success'>Food Added sucessfully.</div>";
                //Reditect page to manage food
                header('location:' . SITEURL . 'admin/manage-Food.php');
            } else {
                //Fail to add food
                $_SESSION['add'] = "<div class='error'>Fail to add Food.</div>";
                //Reditect page to manage food
                header('location:' . SITEURL . 'admin/add-Food.php');
            }

        }
        ?>

    </div>
</div>




<?php include('partials/footer.php'); ?>