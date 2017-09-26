<?php
require 'db_connect.php';

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$term = mysqli_real_escape_string($conn, $_REQUEST['term']);
if(isset($term)){
    // Attempt select query execution
    $sql = "SELECT * FROM insert_data WHERE file_name LIKE '%" . $term . "%'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                        echo "<p>".$row['file_name']."</p>";
                       // echo "  ";
                      // echo "<a href='send.php?name=".$row['file_name']."' class='btn btn-primary btn-large'>Get URL</a>";
                     //   echo "<br>";
                    }

            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}
 
// close connection
mysqli_close($conn);
?>

