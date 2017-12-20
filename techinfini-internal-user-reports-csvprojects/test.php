<?php
$con =  mysqli_connect('localhost', 'root', '', 'csv_db');
// $con = mysqli_connect("localhost","sketch_tsrepo","HN4CjQsx","sketch_tsrepo");
if (mysqli_connect_errno())
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>
<!DOCTYPE html>
<html>
<head>

	<title>User Report</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script
  		src="https://code.jquery.com/jquery-3.2.1.js"
  		integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  		crossorigin="anonymous"></script>
	</head>
<body>
	<form method="POST" action="">
		<label>start date: </label>
		<input type="date" name="startdate" id="startdate" value="2017-11-24">
		<label>end date: </label>
		<input type="date" name="enddate" value="2017-12-01"> 
		<label>Select User: </label>
		<select id="user_select" name="user_select">
		<?php
			$query = "SELECT DISTINCT user_id, user_name FROM intrnt_st_mng";
			if($r = mysqli_query($con, $query)){
				while ($row = mysqli_fetch_assoc($r)){
					echo '<option value="'. $row["user_id"] .'" >'. $row["user_name"] .'</option>';
				}
			}
	?>	
		 </select> 
		 <input type="submit" name="submit" value="submit" class="btn btn-info">
	</form>

<?php
	$Main_Array = array(); 
	$array_all_dates = array();

	$arr_both_date_avl = array();
	// $user = 53;

	if(isset($_POST['submit'])){
		$startdate = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$user = $_POST['user_select'];
		echo "Given date:".$startdate."<br>";
		echo "USER: ".$user." <br>";

		$begin = new DateTime( $startdate );
		$end   = new DateTime( $enddate );

		for($i = $begin; $i <= $end; $i->modify('+1 day')){
		    $looped_date = $i->format("Y-m-d");
		    echo "<br><br>";
		    echo $looped_date;
		    echo "<br>";
		    get_data($con, $user, $looped_date);
		}	

		// get_data($con, $user, $startdate);
}

# ------------------------------------------Functions------------------------------------------------------------
function get_data($con, $user, $startdate){
	/*$sql = "SELECT * FROM intrnt_st_mng WHERE user_id = '".$user."'";

	if($result = mysqli_query($con, $sql)){
		while ($row = mysqli_fetch_assoc($result) ) {		
			// $Main_Array[$row['projects']][$row['availability_time']] = $row['duration'];
			$Main_Array[$row['status_date']][$row['projects']] = $row['duration'];
			// array_push($Main_Array, $row['projects'], $row['availability_time'], $row['status_date'], $row['duration']);
		}
	}

	// echo "<pre>"; print_r($Main_Array); echo "</pre>";
*/
		#----------- Check if given date falls between the status and Availability time----------
		$sql2 = "SELECT * FROM intrnt_st_mng WHERE user_id = '".$user."' AND status_date <= '".$startdate."' AND availability_time>='".$startdate."' " ;
		if($result2 = mysqli_query($con, $sql2)){
			if (mysqli_num_rows($result2)) {
    				
			while ($row2 = mysqli_fetch_assoc($result2) ) {
				echo "<br><br>";
				// echo "<pre>"; print_r($row2); echo "</pre>";
				echo "falls between dates ";
				$datetime = explode(" ",$row2['availability_time']);
				$availability_time = $datetime[0];
				$availability_duration = $datetime[1];

				# check if availability time is same as the selected date and status date
				if($startdate == $availability_time && $startdate == $row2['status_date']){ 
						echo "<br> date is same as availability time and status time";
						echo "<br> Project is:  ".$row2['projects'];
						echo "<br> Duration is:  ".$row2['duration']." Hours";
						$arr_both_date_avl[$row2['projects']] = $row2['duration'];

				 }else if($startdate == $availability_time){ # check if availability time is same as the selected date
					echo "<br> date is same as availability time";
					echo "<br> Project is:  ".$row2['projects'];

					$datetime1 = new DateTime('11:30:00');
					$datetime2 = new DateTime($availability_duration);
					$interval = $datetime1->diff($datetime2);
					$difference =  $interval->format('%h:%i')." Hr";
					echo "<br> Duration is:  ".$difference;

				}else if($startdate == $row2['status_date']){ # check if status_date is same as the selected date
					echo "<br> date is same as status time";
					if($row2['duration']<= 8){
						echo "<br> Project is:  ".$row2['projects'];
						echo "<br> Duration is:  ".$row2['duration']." Hours";
					}else{
							echo "<br> Project is:  ".$row2['projects'];
							echo "<br> Duration is: 8 hours";
						}
				}else{
					echo "<br> date is NOT same as status time and availability time";
					echo "<br> Project is:  ".$row2['projects'];
					$selecteddatewithtime = $startdate." 10:30:00"; 
					/*
					$t1 = StrToTime ( $row2['availability_time'] );
					$t2 = StrToTime ( $selecteddatewithtime );
					$diff = $t1 - $t2;
					$duration = $diff / ( 60 * 60 ); 
					echo "<br> Duration is:  ".$duration." Hours";
					*/
					echo "<br> Duration is: 8 hours";
				}
			}
		}else{
			echo "NO Data Available";
			}
	}
}
?>
<script type="text/javascript">
	$(function(){
		document.getElementById('user_select').value = "<?php echo $_POST['user_select'];?>";
		document.getElementById('startdate').value = "<?php echo $_POST['startdate'];?>";
		document.getElementById('enddate').value = "<?php echo $_POST['enddate'];?>";
	});
</script>