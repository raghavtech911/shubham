<?php
 header("Access-Control-Allow-Origin: *");
define('SHOPIFY_APP_API_KEY', 'f1d9524348fa0383e9f946c47eb209b7');
define('SHOPIFY_APP_SHARED_SECRET', '897ff4d16f3df2f500e577147e9b8969');

// SHOPIFY_SITE_URL = your App main directory Url
define('SHOPIFY_SITE_URL', 'https://sketchthemes.com/tech-shopify/shubham/organizationinfo/');

 mysql_connect('localhost','sketcht_t-shop59','2L_$Tl+rm.*WN.d*v;') or die('Unable to connect');
 mysql_select_db('sketcht_tech-shopify5654')or die('Unable to select database');

// Create connection
// $conn = mysqli_connect('localhost','sketcht_t-shop59','2L_$Tl+rm.*WN.d*v;','sketcht_tech-shopify5654'); // host, username, pw, db-name

// // Check connection
// 	if (!$conn)
//     die("Connection failed: " . mysqli_connect_error());

?>
