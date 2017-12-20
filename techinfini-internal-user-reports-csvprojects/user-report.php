<?php
	$con = mysqli_connect("localhost","sketch_tsrepo","HN4CjQsx","sketch_tsrepo");
	if (mysqli_connect_errno())
	  	{
	  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		if(isset($_POST["export"])){
		$start_date = $_POST['startdate'];
		$end_date = $_POST['enddate'];
		$user = $_POST['user_select'];
		
		  	$fileName = $user.'_csv.csv';
		  	$num = 0;
		  	ob_end_clean();

	 			$fp = fopen('php://output', 'w');
	 			header('Content-Type: application/excel');
	 			header('Content-Disposition: attachment; filename="' . $fileName . '"');

  				fputcsv($fp, array('User:'.$user));
  				fputcsv($fp, array('From: '.$start_date.'  To: '.$end_date)); 
	 			// fputcsv($fp, array('ID','Project Name','Total Time in hr'));
	 			// foreach($prod as $product) {
		 			   // fputcsv($fp, $product);
					// }
			 	fclose($fp);
			 	exit(0); // to not get html in csv file
		}
?>
<!DOCTYPE html>
<html>
<head>

	<title>User Report</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<style type="text/css">
  			.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('giphy.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}

	select{
	   -webkit-appearance: button;
	   -webkit-border-radius: 2px;
	   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
	   -webkit-padding-end: 20px;
	   -webkit-padding-start: 2px;
	   -webkit-user-select: none;
	   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
	   background-position: 97% center;
	   background-repeat: no-repeat;
	   border: 1px solid #AAA;
	   color: #555;
	   font-size: inherit;
	   margin: 20px;
	   overflow: hidden;
	   padding: 5px 10px;
	   text-overflow: ellipsis;
	   white-space: nowrap;
	   width: 200px;
		}
  		</style>
	<script
  		src="https://code.jquery.com/jquery-3.2.1.js"
  		integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  		crossorigin="anonymous"></script>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  		<script type="text/javascript">
			$(window).load(function() {
    		$(".loader").fadeOut("slow");
		});
</script>
  		
</head>
<body>
<div class="loader"></div>
<div class="container" > 
	<div>
	<form action="" method="POST">
		<label>Start Date: </label> <input id="startdate" type="date" name="startdate" value="2017-06-18">
		<label>End Date: </label><input id="enddate" type="date" name="enddate" value="2017-06-30" style="margin-right: 36px;"> 
		<label>Select User: </label>
		<select id="user_select" name="user_select">
		<?php
			$query = "SELECT DISTINCT(user_name) 
					  FROM csv_info";
			if($r = mysqli_query($con, $query)){
				while ($row = mysqli_fetch_assoc($r)){
					echo '<option value="'. $row["user_name"] .'" >'. $row["user_name"] .'</option>';
				}
			} 
	?>	
		</select>
	<input class="btn btn-primary" name="submit" type="submit" value="submit"> 
	</div>
</div>
<?php
if(isset($_POST['submit'])){
	
	$things = array();
	$columns = array();
	$tasks = array();
	$kk = array();
	$totaltimearr = array();
	$totaltimearrforday = array();

	$start_date = $_POST['startdate'];
	$end_date = $_POST['enddate'];
	$user = $_POST['user_select'];

	$sql = "SELECT project, task, time, date
			FROM csv_info 
			WHERE user_name='".$user."' 
			AND date>= '".$start_date."' 
			AND date<= '".$end_date."' 
			ORDER BY date";

	if($result = mysqli_query($con, $sql)){
		echo "<div class='container-fluid'>";
		 	echo " From ".$start_date.""; 
		 	echo "  To ".$end_date ." </span>";
		 	echo "<input type='submit' name='export' value='Export To CSV' class='btn btn-info' style='float:right; margin-bottom: 7px;'> <br>";
		 	echo "
		 	<table width='100%' class='table table-bordered'>
		 	<col width='100px'>
		 	<tr bgcolor='#d5efef'>
		 	<th>Project</th>
		 	<th>Task</th>
		 	";

		 	#------- to get the dates as columns names
		 	$r = "SELECT distinct date, day FROM csv_info WHERE user_name='".$user."' AND date>= '".$start_date."' AND date<= '".$end_date."' ORDER BY date";

		 		if($re = mysqli_query($con, $r)){
		 			while($row1 = mysqli_fetch_assoc($re)){
		 				$dd = $row1['date']; 					#get date
						$newday =  date("D",strtotime($dd)); 	# get day as Mon
		 				$newdate = date("d/m",strtotime($dd));  # get date as 01/08
		 	 			echo "<th>".$newdate."<br />".$newday."</th>";
		 	 			$columns[]= $row1['date'];
		 	 		}
		 		}

		echo "<th>Total Time <small>In hours</small></th>
			 </tr>";

		while($row = mysqli_fetch_assoc($result)){
			  // echo "<pre>"; print_r($row); echo "</pre>";

			$things[$row['project']][$row['date']] = $row['time'];
			// $tasks[$row['project']] = $row['task'];

			$kk[$row['task']][$row['date']] = $row['time'];
			$thg[$row['project']][$row['task']] = $row['time'];
			$arrforpro[$row['task']] =  $row['project'];

			// $query = "SELECT SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 ) AS daytime FROM csv_info WHERE user_name='".$user."' AND date= '".$row['date']."'";
			$query = "SELECT SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 ) AS daytime FROM csv_info WHERE user_name='".$user."' AND date= '".$row['date']."'";
			if($re = mysqli_query($con, $query)){
		 			while($row1 = mysqli_fetch_assoc($re)){
		 				// echo "<pre>". print_r($row1). "</pre>";
		 				$sec = $row1['daytime'];
					 	$H = floor($sec / 3600);
					 	$i = ($sec / 60) % 60;
					 	$t = sprintf("%02d:%02d", $H, $i);
		 				$totaltimearrforday[$row['date']] = $t;
		 			}
		 		}

			// 	#-------To print the total time-------
		 		 	// $sql = "SELECT project, SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 ) AS totaltime FROM csv_info WHERE user_name='".$user."' 
		 		 	// 		AND date>= '".$start_date."'AND date<= '".$end_date."' AND project='".$row['project']."' ";
		 		 $sql = "SELECT task, SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 ) AS totaltime FROM csv_info WHERE user_name='".$user."' AND date>= '".$start_date."'AND date<= '".$end_date."'  AND task='".$row['task']."' ";

				   	if($re = mysqli_query($con, $sql)){
		 		 		while($roww = mysqli_fetch_assoc($re)){
					 	  	$seconds = $roww['totaltime'];
					 		$H = floor($seconds / 3600);
					 		$i = ($seconds / 60) % 60;
					 		$time = sprintf("%02d:%02d", $H, $i);
					 		$totaltimearr[$roww['task']] = $time;
				  		}
					 }
		}// end while loop

		// echo "<hr ><pre>"; print_r($totaltimearr); echo "</pre>";


					#-----Print the table--------------
		 			foreach($kk as $key=>$value){
					    echo "<tr>";

					    foreach ($arrforpro as $x => $y) {
					    	if($key == $x){
					    	echo "<td style=' width:280px;'>".$y."</td>";
					    	}
					    }

					    echo "<td>".$key."</td>"; // print task name
					    
					    // foreach ($tasks as $k=>$v) {
					    //  	if($key == $k)
					    //  	echo "<td>".$v."</td>"; // print the task
					    // }
					    foreach($columns as $column){
					        echo "<td>".(isset($value[$column]) ? $value[$column] : 0.0)."</td>"; // prints the time
					    }

					    foreach ($totaltimearr as $a => $b) {
					     	if($key == $a) 
					     	echo "<td>".$b."</td>";  // print total time
					    }
					    echo "</tr>";
					}
				 echo "<tr><td><strong>TOTAL</strong><small> in Hr</small></td><td></td>";

				foreach ($totaltimearrforday as $key => $value) {
					echo "<td><strong>".$value." </strong></td>";					
				}
				echo "</tr>";
		echo "</table></div>";
	}
	 
	 // echo "<pre>"; print_r($tasks); echo "</pre>";
}
?>
<script type="text/javascript">
	$(function(){
		document.getElementById('user_select').value = "<?php echo $_POST['user_select'];?>";
		document.getElementById('startdate').value = "<?php echo $_POST['startdate'];?>";
		document.getElementById('enddate').value = "<?php echo $_POST['enddate'];?>";
	});
</script> 