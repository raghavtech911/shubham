<?php 
require_once('dbconnection.php');
$q = $_REQUEST["q"];
$hint = ""; 

if($q !== ""){
	$q = strtolower($q);
	$sql = "SELECT tech_can_email FROM tech_candidates";
	$result = $conn->query($sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		if($q == $row["tech_can_email"]){
			$hint = "Email Already Exists in Database.";
		}else{
			$hint = "";
		}
	}
}

echo $hint;
 ?>