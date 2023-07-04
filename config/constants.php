<?php
//start session
session_start();

//3. Exicute Query and Save Data into Database
//Create constant to store non repeating value
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME); // Selecting Database
?>