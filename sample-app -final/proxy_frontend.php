<?php
error_reporting(0);
session_start();
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
require __DIR__.'/conf.php';



//  Note :  This is mendatory code to make the $shopify object work currectly

    if(!empty($_SESSION['shop'])){
        $shop = $_SESSION['shop'];
      }
      else{
        $shop = $_SESSION['shop'] = $_GET['shop'];
      }
      // $shop = $_SESSION['shop']?:$_GET['shop'];

    if(!empty($_SESSION['oauth_token'])){
        $oauth_token = $_SESSION['oauth_token'];
      }
      else{
        $dir = split("/",getcwd());
        $config_table_name = "shopify_App_".end($dir);
       


            $sql = "SELECT * FROM $config_table_name WHERE shop ='$shop' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $oauth_token = $row['oauth_token'];
    }
} else {
    // echo "0 results";
}


      }
    

$shopify = shopify\client($shop, SHOPIFY_APP_API_KEY , $oauth_token);
?>

<!-- Your Html Which You Want to show on front end.You can write php code also -->

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://sdks.shopifycdn.com/polaris/1.0.2/polaris.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>     
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- ******************************************************* Started From Here **************************************************** -->


<div class="proxy-file" style="padding: 10px" > 



<div>