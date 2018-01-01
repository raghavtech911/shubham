<?php 
$conn   = new mysqli("localhost", "root", "", "tech_db");
if(isset($_GET['tech_can_id'])){
  	$id = $_GET['tech_can_id'];		
	$sql= "UPDATE tech_candidates SET tech_can_status= '1' WHERE tech_can_id= '$id'";
	$result = $conn->query($sql);
}
?>

<h2>REJECTED !!!<h2>
<a href="reject_list.php"><h3>Show Rejected List</h3></a>

