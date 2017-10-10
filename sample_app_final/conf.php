<?php
 header("Access-Control-Allow-Origin: *");
define('SHOPIFY_APP_API_KEY', '6f0774979ab51ff483916baf4f02a776');
define('SHOPIFY_APP_SHARED_SECRET', '9ee2c5b2cdb964177b357781f44aa7f4');

// SHOPIFY_SITE_URL = your App main directory Url
define('SHOPIFY_SITE_URL', 'https://venus.ourgoogle.in/shopify/shubham/sample_app_final/');

// Create connection
$conn = mysqli_connect('localhost','venus_shopify','RyU9fhoP','venus_shopify');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
