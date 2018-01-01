<?php 
session_start();
include('header.html');
include('top_nav.php');

include('sidebar.php');

include('db_connect.php');

$sql = "SELECT * FROM insert_data";
$result = $conn->query($sql);

if (!$result)
{
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

// echo "<table border='1px'>   
//             <thead>   
//                 <tr>  
//                     <th> ID </th>   
//                     <th> Name of file</th>
//                     <th> Size of file </th>   
//                     <th> Type of file </th>      
//                 </tr>";

// while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
// {
//     echo "<tr>";
//     echo "<td>" . $row['file_id']   . "</td>";
//     echo "<td>" . $row['file_name'] . "</td>";
//     echo "<td>" . $row['file_size'] . "</td>";
//     echo "<td>" . $row['file_type'] . "</td>";
//     echo "</tr>";
// }
// echo "</table>";

echo "<a href='send.php' class='btn btn-primary btn-large'>click to send the file</a>";
echo "
<div class='col-md-12 col-sm-12 col-xs-12'>
              <div class='x_panel'>
                <div class='x_title'>
                  <h2>List of Files <small>Hover over the rows</small></h2>
                  <div class='clearfix'></div>
                </div>
                <div class='x_content'>
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name of file</th>
                        <th>Size of File</th>
                        <th>Type of File</th>
                      </tr>
                    </thead>";

             while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>".$row['file_id']."</th>";
                        echo "<td>".$row['file_name']." </td>";
                        echo "<td>".$row['file_size']."</td>";
                        echo "<td>".$row['file_type']."</td>";
                        echo " </tr>";
                        echo "</tbody>";
                }

 echo "  </table>

                </div>
              </div>
            </div>";



 ?>


<?php
include('footer.html');
?>


            