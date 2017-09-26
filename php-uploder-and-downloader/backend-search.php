<?php
require 'db_connect.php';

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
                     <div class='clearfix'></div>
                    <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name of file</th>
                        <th>Size of File</th>
                        <th>Type of File</th>
                        <th>Get File</th>
                      </tr>
                    </thead>
<?php
  
// Escape user inputs for security
$term = mysqli_real_escape_string($conn, $_REQUEST['term']);
if(isset($term)){
    // Attempt select query execution
    $sql = "SELECT * FROM insert_data WHERE file_name LIKE '%" . $term . "%'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $nameoffile =$row['file_name'];
                echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>".$row['file_id']."</th>";
                        echo "<td>".$row['file_name']." </td>";
                        echo "<td>".$row['file_size']."</td>";
                        echo "<td>".$row['file_type']."</td>";
                        echo "<td><a href='send.php?name=".$nameoffile."' class='btn btn-primary btn-large'>Get URL</a></td>";
                        echo " </tr>";
                        echo "</tbody>";
                    }
                 echo "</table></div></div></div>";

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
