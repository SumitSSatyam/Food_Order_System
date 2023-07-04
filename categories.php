<?php include('partials-front/menu.php'); ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //display all the categories that are active 
        //create sql query
        $sql = "SELECT *FROM tbl_category WHERE active='Yes'";
        //exicute the query
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        //cheak weather tha category is available or not
        if ($count > 0) {
            //catagories available
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">


                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>image not available</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"
                                class="img-responsive img-curve">

                            <?php
                        }
                        ?>


                        <h3 class="float-text text-white">
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </a>

                <?php
            }
        } else {
            //categories not available
            echo "<div class='error'>Category not found</div>";
        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>