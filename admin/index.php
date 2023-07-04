<?php include('partials/menu.php'); ?>

<!-- Main content section start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);

        }
        ?>
        <br><br>

        <div class="col-4">
            <?php
            $sql = "SELECT *FROM tbl_category";
            //exicute query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            ?>
            <h1>
                <?php echo $count; ?>
            </h1><br>
            Catagories
        </div>
        <div class="col-4">

            <?php
            $sql2 = "SELECT *FROM tbl_food";
            //exicute query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1>
                <?php echo $count2; ?>
            </h1><br>
            Foods
        </div>
        <div class="col-4">

            <?php
            $sql3 = "SELECT *FROM tbl_order";
            //exicute query
            $res3 = mysqli_query($conn, $sql3);
            //count rows
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1>
                <?php echo $count3; ?>
            </h1><br>
            Total Orders
        </div>
        <div class="col-4">

            <?php
            //sql query to get total revineue Genereted
            //agrigate function in sql
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
            //exicute the query
            $res4 = mysqli_query($conn, $sql4);
            //get the value
            $row4 = mysqli_fetch_assoc($res4);
            //get the total revinew
            $total_revenue = $row4['Total'];

            ?>
            <h1>Rs.
                <?php echo $total_revenue; ?>
            </h1><br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main content section end -->

<?php include('partials/footer.php') ?>