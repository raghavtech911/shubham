<?php 
  session_start();
  error_reporting(1);
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
require __DIR__.'/conf.php';
//  Note :  This is mandatory code to make the $shopify object work correctly
    if(!empty($_SESSION['shop'])){
        $shop = $_SESSION['shop'];
    }
    else{
        $shop = $_SESSION['shop'] = $_GET['shop'];
    }    
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
        } 
    } 
 
    $shopify = shopify\client($shop, SHOPIFY_APP_API_KEY , $oauth_token);

  // to create the collect of product
    $collection = $_POST['coll_id']; // collection id
    $product = $_POST['prod_id'];   // product id

    $createCollection = array("collect"=> array("product_id"=> $product, "collection_id"=> $collection ));  
    $collectionList = $shopify('POST /admin/collects.json', array(), $createCollection); // insret the collection 
?>
