<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Contact Us</h2>

        <form action="#" class="order">

            <fieldset>
                <legend>Fill Details</legend>
                <div class="order-label">First Name</div>
                <input type="text" name="full-name" placeholder="E.g. Sumit" class="input-responsive" required>

                <div class="order-label">Last Name</div>
                <input type="text" name="full-name" placeholder="E.g. Satyam" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 72775444XX" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. sumitsatyam123@gmail.com" class="input-responsive"
                    required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <!-- <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary"> -->

                <input type="submit" name="submit" class="btn btn-primary">
                <input type="reset" name="reset" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>