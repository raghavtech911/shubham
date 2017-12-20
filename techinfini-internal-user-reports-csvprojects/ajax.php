<?php

$con = mysqli_connect("localhost","root","","csv_db");
if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$project_name = $_POST['data'];
 // echo $project_name;

$main_arr = [];
$s = "SELECT * FROM csv_info WHERE project='".$project_name."'";
if ($result = mysqli_query($con, $s)){
	  while ($data = mysqli_fetch_assoc($result)){
	  array_push($main_arr, $data);
	  }
}
echo json_encode($main_arr);
?>
