<?php
	$con = mysqli_connect("localhost","sketch_tsrepo","HN4CjQsx","sketch_tsrepo");
	if (mysqli_connect_errno())
	  	{
	  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Full Report</title>
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

	th, td { text-align: center; }

  		</style>
	<script
  		src="https://code.jquery.com/jquery-3.2.1.js"
  		integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  		crossorigin="anonymous"></script>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  		<script type="text/javascript"> $(window).load(function() { $(".loader").fadeOut("slow"); });
</script>
  		
</head>
<body>
<div class="loader"></div>
	<div class="container" > 
	<div>
	<form action="" method="POST">
		<label> Start Date: </label> <input id="startdate" type="date" name="startdate" value="2017-11-15">
		<label> End Date: 	</label> <input id="enddate"   type="date" name="enddate"   value="2017-12-03" style="margin-right: 36px;"> 
		<label> Select User:</label>
		<select id="user_select" name="user_select">
		<?php
		# to get the Users name in dropdown
			$query = "SELECT DISTINCT user_name, user_id 
					  FROM csv_info ORDER BY user_name";
			
			if($r = mysqli_query($con, $query)){
				while ($row = mysqli_fetch_assoc($r)){
					echo '<option value="'. $row["user_id"] .'" >'. $row["user_name"] .'</option>';
				}
			} 
	?>	
		</select>
	<input class="btn btn-primary" name="submit" type="submit" value="submit"> 
	</div>
</div>
<?php
if(isset($_POST['submit'])){
	
	$things 			= 	array();
	$columns 			= 	array();
	$kk 				= 	array();
	$tasks 				= 	array();
	$totaltimearr 		= 	array();
	$totaltimearrforday = 	array();
	$countduration 		= 	0;

	$start_date 		=  	$_POST['startdate'];
	$end_date 			= 	$_POST['enddate'];
	$user 				= 	$_POST['user_select'];

	$sql = "SELECT project, task, time, date
			FROM csv_info 
			WHERE user_id='".$user."' 
			AND date>= '".$start_date."' 
			AND date<= '".$end_date."' 
			ORDER BY date";

	if($result = mysqli_query($con, $sql)){
		echo "<div class='container-fluid'>";
		 	echo " From ".$start_date.""; 
		 	echo "  To ".$end_date ." </span>";
		 	// echo "<input type='submit' name='export' value='Export To CSV' class='btn btn-info' style='float:right; margin-bottom: 7px;'> <br>";
		 	// echo "<table width='100%' class='table table-bordered'>";
		 	echo "<table border='1' width='100%'>";
		 	echo"
		 	<col width='100px'>
		 	<tr bgcolor = '#d5efef'>
		 	<th rowspan = '2'>Project</th>
		 	<th rowspan = '2'>Task</th>
		 	";

		 	#------- to get the dates from the csv_info table as columns names---------
		 	$r = "SELECT distinct date, day 
		 		  FROM csv_info 
		 		  WHERE user_id='".$user."' 
		 		  AND date>= '".$start_date."' 
		 		  AND date<= '".$end_date."' 
		 		  ORDER BY date";

		 		if($re = mysqli_query($con, $r)){
		 			while($row1 = mysqli_fetch_assoc($re)){
		 				$dd 	   = 	$row1['date']; 					#get date
						$newday    = 	date("D",strtotime($dd)); 		# get day as Mon
		 				$newdate   = 	date("d/m",strtotime($dd));  	# get date as 01/08
		 	 			echo "<th colspan='2'>".$newdate."<br />".$newday."</th>";
		 	 			$columns[] = 	$row1['date'];
		 	 		}
		 		}

		 	/*
		 	#------- to get the all dates as columns names---------
		 	$begin = new DateTime( $start_date );
			$end   = new DateTime( $end_date );

			for($i = $begin; $i <= $end; $i->modify('+1 day')){
				echo "<th colspan='2'>".$i->format("Y-m-d")."</th>";
				$columns[] = $i->format("Y-m-d");
			}*/

		echo "<th rowspan='2'>Total Time <small>In hours</small></th>
			  <th rowspan='2'>Total Time to do <small></small></th>
			</tr>";
			 
		echo "<tr>";
		if($re = mysqli_query($con, $r)){
			while($row1 = mysqli_fetch_assoc($re)){
		 // for($i = $begin; $i <= $end; $i->modify('+1 day')){
            	 echo "<th bgcolor = '#d5efef'>Done</th>";
             	echo "<th bgcolor = '#d5efef'>To do</th>";
              // }
        	}
        }
          echo "</tr>";

		while($row = mysqli_fetch_assoc($result)){

			$things[$row['project']][$row['date']] 	= 	$row['time'];
			$kk[$row['task']][$row['date']] 		= 	$row['time'];
			$thg[$row['project']][$row['task']] 	= 	$row['time'];
			$arrforpro[$row['task']] 				=  	$row['project'];

			$query = "SELECT SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 ) AS daytime 
					  FROM csv_info 
					  WHERE user_id='".$user."' 
					  AND date= '".$row['date']."'";

			if($re = mysqli_query($con, $query)){
	 			while($row1 =  mysqli_fetch_assoc($re)){
	 				$sec 	=  $row1['daytime'];
				 	$H 		=  floor($sec / 3600);
				 	$i 		=  ($sec / 60) % 60;
				 	$t 		=  sprintf("%02d:%02d", $H, $i);
	 				$totaltimearrforday[$row['date']] = $t;
	 			}
		 	}

			#-------To print the total time------
		 		 $sql = "SELECT task, SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 ) AS totaltime 
		 		 		 FROM csv_info 
		 		 		 WHERE user_id='".$user."' 
		 		 		 AND date>= '".$start_date."'
		 		 		 AND date<= '".$end_date."'  
		 		 		 AND task='".$row['task']."' ";

				   	if($re = mysqli_query($con, $sql)){
		 		 		while($roww 	= 	mysqli_fetch_assoc($re)){
					 	  	$seconds 	=	$roww['totaltime'];
					 		$H  		= 	floor($seconds / 3600);
					 		$i 			= 	($seconds / 60) % 60;
					 		$time 		= 	sprintf("%02d:%02d", $H, $i);
					 		$totaltimearr[$roww['task']] = $time;
				  		}
					 }
		}

					#-----Print the table--------------
		 			foreach($kk as $key=>$value){
					    echo "<tr>";

					    foreach ($arrforpro as $x => $y) {
					    	if($key == $x){
					    	echo "<td style=' width:280px;'>".$y."</td>"; # print project name
					    	$current_project = $y;
					    	}
					    }

					    echo "<td>".$key."</td>"; # print task name
					 
					    foreach($columns as $column){
					        echo "<td>".(isset($value[$column]) ? $value[$column] : 0.0)."</td>"; # prints the time in right column of dates
					         $arr =get_data($con, $user, $column);
					     
					     	if($arr['projectname'] == $current_project){
					         echo "<td bgcolor='#CCCCCC'> <strong style='color:red;'>";
					         
					        	if(isset($arr['durationofit'])){
					         		echo $arr['durationofit'];
					         		$countduration += $arr['durationofit'];
					         	// var_dump($countduration);
					     		}
					        echo "</strong> </td>";
					     	}else{
					     		 echo "<td bgcolor='#CCCCCC'> 0 </td>";
					     	 }
					    }

					    foreach ($totaltimearr as $a => $b) {
					     	if($key == $a): 
					     	echo "<td>".$b."</td>"; # print total time
					     	endif;  
					    }
					    
					    echo "<td><strong>".$countduration."</strong></td>"; # print the total of Hour to do
					    $countduration = 0;
					    echo "</tr>";
					}
				 echo "<tr><td><strong>TOTAL</strong><small> in Hr</small></td><td></td>";

				foreach ($totaltimearrforday as $key => $value) {
					echo "<td><strong>".$value." </strong></td>";
					echo "<td></td>";					
				}
				echo "</tr>";
		echo "</table></div>";
	}
}

#----------------------------------Function--------------------------------------------
function get_data($con, $user, $startdate){
		# Check if given date falls between the status and Availability time
		$sql2 = "SELECT * FROM intrnt_st_mng WHERE user_id = '".$user."' AND status_date <= '".$startdate."' AND availability_time>='".$startdate."' " ;
		if($result2 = mysqli_query($con, $sql2)){
			if (mysqli_num_rows($result2)) {
    				
			while ($row2 = mysqli_fetch_assoc($result2) ) {
				$datetime 				= explode(" ",$row2['availability_time']);
				$availability_time 		= $datetime[0];
				$availability_duration 	= $datetime[1];

				# check if availability time is same as the selected date and status date
				if($startdate == $availability_time && $startdate == $row2['status_date']){ 
						
						$arr_both_date_avl['projectname'] 	= 	$row2['projects'];
						$arr_both_date_avl['durationofit'] 	= 	$row2['duration'];
						return $arr_both_date_avl;

						# check if availability time is same as the selected date
				 }else if($startdate == $availability_time){ 

					$datetime1 	= 	new DateTime('11:30:00');
					$datetime2 	=	new DateTime($availability_duration);
					$interval 	= 	$datetime1->diff($datetime2);
					$difference =  	$interval->format('%h:%i');

					$arr_both_date_avl['projectname'] 	=	 $row2['projects'];
					$arr_both_date_avl['durationofit'] 	= 	$difference;
					return $arr_both_date_avl;

					# check if status_date is same as the selected date
				}else if($startdate == $row2['status_date']){ 
					if($row2['duration'] <= 8){
						$arr_both_date_avl['projectname'] 	= 	$row2['projects'];
						$arr_both_date_avl['durationofit'] 	= 	(float)$row2['duration'];
						return $arr_both_date_avl;
					}else{
						$arr_both_date_avl['projectname'] 	= 	$row2['projects'];
						$arr_both_date_avl['durationofit'] 	= 	'8.00';
						return $arr_both_date_avl;
						}
				}else{
					
					$selecteddatewithtime	 			= 	$startdate." 10:30:00"; 
					$arr_both_date_avl['projectname'] 	= 	$row2['projects'];
					$arr_both_date_avl['durationofit'] 	= 	'8.00';
					return $arr_both_date_avl;
				}
			}
		}else{
			// echo "NO Data Available";
			$arr_both_date_avl['projectname'] = "No data";
			return $arr_both_date_avl;
			}
	}
}
?>
<script type="text/javascript">
	$(function(){
		document.getElementById('user_select').value =  "<?php echo $_POST['user_select'];?>";
		document.getElementById('startdate').value   =  "<?php echo $_POST['startdate'];?>";
		document.getElementById('enddate').value     =  "<?php echo $_POST['enddate'];?>";
	});
</script> 