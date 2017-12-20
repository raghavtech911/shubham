<?php
	// $con = mysqli_connect("localhost","sketch_tsrepo","HN4CjQsx","sketch_tsrepo");
	$con = mysqli_connect("localhost","root","","csv_db");
	$arry = array();
	$MonthArr = array();
	if (mysqli_connect_errno())
	  	{
	  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
?>

<!DOCTYPE html>
<html>
<head>

	<title>Reports</title>
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
		<label>Start Date</label> <input id="startdate" type="date" name="startdate" value="2017-09-01">
		<label>End Date</label><input id="enddate" type="date" name="enddate" value="2017-10-31" style="margin-right: 36px;"> 
	<label>Select Project</label>
	<select>
	<?php
	$query = "SELECT project FROM csv_info";
	if($r = mysqli_query($con, $query)){
		while ($row = mysqli_fetch_assoc($r)){
			echo '<option value="'. $row["project"] .'" >'. $row["project"] .'</option>';
		}
	} 
	?>	
		</select>

	<label>Select Format</label>
		<select name="format_select" id="format_select" style="margin-right: 76px;">
			<option value="none">None</option>
			<option value="week">Weekly</option>
			<option value="month">Monthly</option>
		</select>
		
	<input class="btn btn-primary" name="submit" type="submit" value="submit"> 
	</div>
</div>

<?php
	if(isset($_POST['submit'])){
		$start_date = $_POST['startdate'];
		$end_date = $_POST['enddate'];
		$format = $_POST['format_select'];
		

#------------------------------------------FOR NONE VIEW -----------------------------

	if($_POST['format_select'] == 'none'){

		 $sql = "SELECT id, project, user_name, date,client, type , SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 )AS time FROM csv_info WHERE date>= '".$start_date."' AND date<= '".$end_date."' GROUP BY project";
		 
			if ($result = mysqli_query($con, $sql)){
		 	echo "
		 	<hr />
		 	<div class='container'>
		 	<span id='dates'>";
		 	echo " From ";
		 	echo "".$start_date.""; 
		 	echo "  To  ";
		 	echo "".$end_date ." </span>";
		 	echo "<input type='submit' name='nonebtn' value='Export To CSV' class='btn btn-info' style='float:right; margin-bottom: 7px;'> <br>";
		 	echo "
		 	<table width='50%' class='table table-bordered'>
		 	<tr bgcolor='#d5efef'>
		 	<th>More</th>
		 	<th>ID</th>
		 	<th>Project name</th>
			<th>Total Time <small>In hours</small></th>
			</tr>";

			  while ($row = mysqli_fetch_assoc($result))
			    {
		    		// echo "<pre> ".print_r($row)." </pre>";
				  	echo "<tr>";
				  	echo "<td> <input class='btn btn-primary' type='button' value='More' name='showmore' id='show_more' data-project='".$row['project']."'> </td>";
				  	echo "<td>".$row['id']."</td>";
				  	echo "<td>" . $row['project'] . "</td>";

				  	$seconds = $row['time'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$time = sprintf("%02d:%02d", $H, $i);
				  	echo "<td>" . $time . "</td>";
				  	echo "</tr>";

					echo "<tr class='slidedown'>";
				  	$query = "SELECT * FROM csv_info WHERE project='".$row['project']."'AND date>= '".$start_date."' AND date<= '".$end_date."'";
				  	if ($res = mysqli_query($con, $query)){
				  		echo "<td colspan='4'><table width='100%' bgcolor='#c0edea'>";
				  		echo "<tr bgcolor='#6b98e0'>
				  		<th>Date</th>
				 		<th>User</th>
				 		<th>Type</th>
				 		<th>Time</th>
				 		</tr>";
							while ($r = mysqli_fetch_assoc($res)){
								echo "<tr>";
								echo "<td>".$r['date']."</td>";
								echo "<td>".$r['user_name']."</td>";
								echo "<td>".$r['type']."</td>";
								echo "<td>".$r['time']."</td>";
								echo "</tr>";
							}	  	
						echo "</table></td>";
				  	}
				  		echo "</tr>";
		    	}
		    echo "</table>";
		  	echo "</div>";
		 }
	}

#--------------------------------------------- FOR WEEKLY VIEW----------------------------

	if($_POST['format_select'] == 'week'){
		$d = date_parse_from_format("Y-m-d", $start_date);
		$start_month = $d["month"];

		$d = date_parse_from_format("Y-m-d", $end_date);
		$end_month = $d["month"];

		# get the number of weeks in between of start date and end date
		$p = new DatePeriod(
 			new DateTime($start_date), 
			new DateInterval('P1W'), 
			new DateTime($end_date)
		);
			foreach ($p as $w) {
			    array_push($arry, $w->format('W'));
			} # $arry has the week numbers 

		$sql= "SELECT project,
			MAX(IF(WEEK(date)= 1,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week01,
			MAX(IF(WEEK(date)= 2,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week02,
			MAX(IF(WEEK(date)= 3,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week03,
			MAX(IF(WEEK(date)= 4,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week04,
			MAX(IF(WEEK(date)= 5,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week05,
			MAX(IF(WEEK(date)= 6,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week06,
			MAX(IF(WEEK(date)= 7,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week07,
			MAX(IF(WEEK(date)= 8,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week08,
			MAX(IF(WEEK(date)= 9,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week09,
			MAX(IF(WEEK(date)= 10, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week10,
			MAX(IF(WEEK(date)= 11, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week11,
			MAX(IF(WEEK(date)= 12, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week12,
			MAX(IF(WEEK(date)= 13, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week13,
			MAX(IF(WEEK(date)= 14, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week14,
			MAX(IF(WEEK(date)= 15, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week15,
			MAX(IF(WEEK(date)= 16, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week16,
			MAX(IF(WEEK(date)= 17, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week17,
			MAX(IF(WEEK(date)= 18, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week18,
			MAX(IF(WEEK(date)= 19, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week19,
			MAX(IF(WEEK(date)= 20, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week20,
			MAX(IF(WEEK(date)= 21, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week21,
			MAX(IF(WEEK(date)= 22, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week22,
			MAX(IF(WEEK(date)= 23, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week23,
			MAX(IF(WEEK(date)= 24, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week24,
			MAX(IF(WEEK(date)= 25, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week25,
			MAX(IF(WEEK(date)= 26, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week26,
			MAX(IF(WEEK(date)= 27, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week27,
			MAX(IF(WEEK(date)= 28, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week28,
			MAX(IF(WEEK(date)= 29, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week29,
			MAX(IF(WEEK(date)= 30, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week30,
			MAX(IF(WEEK(date)= 31, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week31,
			MAX(IF(WEEK(date)= 32, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week32,
			MAX(IF(WEEK(date)= 33, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week33,
			MAX(IF(WEEK(date)= 34, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week34,
  			MAX(IF(WEEK(date)= 35, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week35,
    		MAX(IF(WEEK(date)= 36, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week36,
    		MAX(IF(WEEK(date)= 37, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week37,
    		MAX(IF(WEEK(date)= 38, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week38,
    		MAX(IF(WEEK(date)= 39, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week39,
    		MAX(IF(WEEK(date)= 40, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week40,
    		MAX(IF(WEEK(date)= 41, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week41,
    		MAX(IF(WEEK(date)= 42, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week42,
    		MAX(IF(WEEK(date)= 43, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week43,
    		MAX(IF(WEEK(date)= 44, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week44,
    		MAX(IF(WEEK(date)= 45, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week45,
    		MAX(IF(WEEK(date)= 46, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week46,
    		MAX(IF(WEEK(date)= 47, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week47,
    		MAX(IF(WEEK(date)= 48, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week48,
    		MAX(IF(WEEK(date)= 49, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week49,
    		MAX(IF(WEEK(date)= 50, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week50,
    		MAX(IF(WEEK(date)= 51, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week51,
    		MAX(IF(WEEK(date)= 52, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week52,
    		MAX(IF(WEEK(date)= 53, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week53,
    		sum(Left(time,2) * 3600 + substring(time, 4,2) * 60) as totaltime
		    FROM csv_info 
		   	WHERE date>= '".$start_date."' AND date<= '".$end_date."'
		    GROUP BY project
		    ORDER BY date";

		if ($result = mysqli_query($con, $sql)){
			echo "
			<hr />
		 	<div class='container-fluid'>
		 		<span id='dates'> From ";
					echo $start_date;
					echo "  To  ";
					echo $end_date;
					echo "<input type='submit' name='weekbtn' value='Export To CSV' class='btn btn-info' style='float:right; margin-bottom: 7px;'> <br>";
					
			echo "<table width='50%' class='table table-bordered' id='mytable'>
			<thead>
				<tr bgcolor='#d5efef'> 
					<th> More </th>
					<th> project </th>";
					$year=date("Y",strtotime($end_date));
					for($i=1;$i<=53;$i++) {
					    $r=getWeek($i,$year);
					    echo "<th> <span style=''>Week".$i."</span> <br><hr />".$r['start']."<br> to <br> ".$r['end']."</th>";
					}
					echo"
					<th> TotalTime </th>
		   		</tr>
		   </thead>";

			while ($row = mysqli_fetch_assoc($result)){
					echo '<tr>';
					// echo "<pre>".print_r($row)." </pre>";
					echo "<td> <input class='btn btn-primary' type='button' value='More' name='showmore' id='show_more' data-project='".$row['project']."'> </td>";
					echo "<td>" . $row['project'] . " </td>";

					$seconds = $row['week01'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week01 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week01 . " </td>";

					$seconds = $row['week02'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week02 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week02 . " </td>";

					$seconds = $row['week03'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week03 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week03 . " </td>";

					$seconds = $row['week04'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week04 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week04 . " </td>";

					$seconds = $row['week05'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week05 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week05 . " </td>";

					$seconds = $row['week06'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week06 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week06 . " </td>";

					$seconds = $row['week07'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week07 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week07 . " </td>";

					$seconds = $row['week08'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week08 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week08 . " </td>";

					$seconds = $row['week09'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week09 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week09 . " </td>";

					$seconds = $row['week10'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week10 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week10 . " </td>";

					$seconds = $row['week11'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week11 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week11 . " </td>";

					$seconds = $row['week12'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week12 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week12 . " </td>";

					$seconds = $row['week13'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week13 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week13 . " </td>";

					$seconds = $row['week14'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week14 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week14 . " </td>";

					$seconds = $row['week15'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week15 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week15 . " </td>";

					$seconds = $row['week16'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week16 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week16 . " </td>";

					$seconds = $row['week17'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week17 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week17 . " </td>";

					$seconds = $row['week18'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week18 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week18 . " </td>";

					$seconds = $row['week19'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week19 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week19 . " </td>";

					$seconds = $row['week20'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week20 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week20 . " </td>";

					$seconds = $row['week21'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week21 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week21 . " </td>";

					$seconds = $row['week22'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week22 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week22 . " </td>";

					$seconds = $row['week23'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week23 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week23 . " </td>";

					$seconds = $row['week24'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week24 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week24 . " </td>";

					$seconds = $row['week25'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week25 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week25 . " </td>";

					$seconds = $row['week26'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week26 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week26 . " </td>";

					$seconds = $row['week27'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week27 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week27 . " </td>";

					$seconds = $row['week28'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week28 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week28 . " </td>";

					$seconds = $row['week29'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week29 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week29 . " </td>";

					$seconds = $row['week30'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week30 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week30 . " </td>";

					$seconds = $row['week31'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week31 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week31 . " </td>";

					$seconds = $row['week32'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week32 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week32 . " </td>";

					$seconds = $row['week33'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week33 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week33 . " </td>";

					$seconds = $row['week34'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week34 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week34 . " </td>";

					$seconds = $row['week35'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week35 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week35 . " </td>";

					$seconds = $row['week36'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week36 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week36 . " </td>";

					$seconds = $row['week37'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week37 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week37 . " </td>";

					$seconds = $row['week38'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week38 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week38 . " </td>";

					$seconds = $row['week39'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week39 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week39 . " </td>";

					$seconds = $row['week40'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week40 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week40 . " </td>";

					$seconds = $row['week41'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week41 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week41 . " </td>";

					$seconds = $row['week42'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week42 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week42 . " </td>";

					$seconds = $row['week43'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week43 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week43 . " </td>";

					$seconds = $row['week44'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week44 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week44 . " </td>";

					$seconds = $row['week45'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week45 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week45 . " </td>";

					$seconds = $row['week46'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week46 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week46 . " </td>";

					$seconds = $row['week47'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week47 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week47 . " </td>";

					$seconds = $row['week48'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week48 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week48 . " </td>";

					$seconds = $row['week49'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week49 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week49 . " </td>";

					$seconds = $row['week50'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week50 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week50 . " </td>";

					$seconds = $row['week51'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week51 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week51 . " </td>";

					$seconds = $row['week52'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week52 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week52 . " </td>";

					$seconds = $row['week53'];
					$H = floor($seconds / 3600);
					$i = ($seconds / 60) % 60;
					$week53 = sprintf("%02d:%02d", $H, $i);
					echo "<td>" . $week53 . " </td>";

				  	$HH = floor($row['totaltime'] / 3600);
				 	$ii = ($row['totaltime'] / 60) % 60;
				  	$time = sprintf("%02d:%02d", $HH, $ii);
				  	echo "<td>" . $time . " Hr</td>";
					echo '</tr>';

					echo "<tr class='slidedown'>";
				  	$query = "SELECT * FROM csv_info WHERE project='".$row['project']."'AND date>= '".$start_date."' AND date<= '".$end_date."'";
				  	if ($res = mysqli_query($con, $query)){
				  		echo "<td colspan='8'><table width='100%' bgcolor='#c0edea'>";
				  		echo "<tr bgcolor='#6b98e0'>
				  		<th>Date</th>
				 		<th>User</th>
				 		<th>Type</th>
				 		<th>Time</th>
				 		</tr>";
							while ($r = mysqli_fetch_assoc($res)){
								echo "<tr>";
								echo "<td>".$r['date']."</td>";
								echo "<td>".$r['user_name']."</td>";
								echo "<td>".$r['type']."</td>";
								echo "<td>".$r['time']."</td>";
								echo "</tr>";
							}	  	
						echo "</table></td>";
				  	}
				  		echo "</tr>";
				}
			echo "</table>";
		}
	}

#----------------------------------------------FOR MONTHLY ----------------------------------

	if($_POST['format_select'] == 'month'){
		$d = date_parse_from_format("Y-m-d", $start_date);
		$start_month = $d["month"];

		$d = date_parse_from_format("Y-m-d", $end_date);
		$end_month = $d["month"];

	 	 $sql = "SELECT project,
					SUM(IF(MONTH(date) = 1, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS jan,
				    SUM(IF(MONTH(date) = 2, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS feb,
				    SUM(IF(MONTH(date) = 3, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS mar,
				    SUM(IF(MONTH(date) = 4, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS april,
				    SUM(IF(MONTH(date) = 5, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS may,
				    SUM(IF(MONTH(date) = 6, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS jun,
				    SUM(IF(MONTH(date) = 7, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS jul,
				    SUM(IF(MONTH(date) = 8, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS aug,
					SUM(IF(MONTH(date) = 9, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS sept,
				    SUM(IF(MONTH(date) = 10, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS oct,
				    SUM(IF(MONTH(date) = 11, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS nov,
				    SUM(IF(MONTH(date) = 12, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS december,
				    SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60)AS total
				    FROM csv_info 
				    WHERE date>= '".$start_date."' AND date<= '".$end_date."'
				    GROUP BY project";

				    if ($result = mysqli_query($con, $sql)){
				    	echo "<hr />";
				    	echo "<div class='container-fluid'>";
				    	echo " From ";
						echo $start_date; 
						echo "  To  ";
						echo $end_date;
						for($i=$start_month; $i<=$end_month; $i++){
								array_push($MonthArr, $i);
						}
						echo '<input type="submit" name="monthbtn" value="Export To CSV" style="float:right; margin-bottom: 7px;" class="btn btn-info">';
				    	echo "
							<table border='1' width='50%' class='table table-bordered' id='monthtable'>
							<thead>
							<tr bgcolor='#d5efef'>
							<th>More</th>
							<th>Project</th>
							<th id='1'><small style='opacity: 0.0;'>1</small> Jan <br><small>In hours</small></th>
							<th id='2'><small style='opacity: 0.0;'>2</small> Feb <br><small>In hours</small></th>
							<th id='3'><small style='opacity: 0.0;'>3</small> Mar <br><small>In hours</small></th>
							<th id='4'><small style='opacity: 0.0;'>4</small> April <br><small>In hours</small></th>
							<th id='5'><small style='opacity: 0.0;'>5</small> May <br><small>In hours</small></th>
							<th id='6'><small style='opacity: 0.0;'>6</small> Jun <br><small>In hours</small></th>
							<th id='7'><small style='opacity: 0.0;'>7</small> Jul <br><small>In hours</small></th>
							<th id='8'><small style='opacity: 0.0;'>8</small> Aug <br><small>In hours</small></th>
							<th id='9'><small style='opacity: 0.0;'>9</small> Sept <br><small>In hours</small></th>
							<th id='10'><small style='opacity: 0.0;'>10</small> Oct <br><small>In hours</small></th>
							<th id='11'><small style='opacity: 0.0;'>11</small> Nov <br><small>In hours</small></th>
							<th id='12'><small style='opacity: 0.0;'>12</small> Des <br><small>In hours</small></th>
							<th>Total <br><small>In hours</small></th>
							</thead></tr>";


				    	while ($row = mysqli_fetch_assoc($result)){
				    		// echo "<pre>".print_r($row)." </pre>";
				    		echo '<tr>';
				    		echo "<td> <input <input class='btn btn-primary' type='button' value='More' name='show_more' id='show_more'> </td>";
		  					echo "<td>" . $row['project'] . "</td>";

		  					$HH = floor($row['jan'] / 3600);
							$ii = ($row['jan'] / 60) % 60;
							$jan = sprintf("%02d:%02d", $HH, $ii);
		  					echo "<td>" . $jan . " </td>";

		  					$seconds = $row['feb'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$feb = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $feb . "</td>";

		  					$seconds = $row['mar'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$mar = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $mar . "</td>";

		  					$seconds = $row['april'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$ap = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $ap . "</td>";

		  					$seconds = $row['may'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$may = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $may . "</td>";

		  					$seconds = $row['jun'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$jun = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $jun . " </td>";

		  					$seconds = $row['jul'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$jul = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $jul . "</td>";

		  					$seconds = $row['aug'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$aug = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $aug . " </td>";

		  					$HH = floor($row['sept'] / 3600);
							$ii = ($row['sept'] / 60) % 60;
							$sept = sprintf("%02d:%02d", $HH, $ii);
		  					echo "<td>" . $sept . " </td>";

							$seconds = $row['oct'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$oct = sprintf("%02d:%02d", $H, $i);		  					
		  					echo "<td>" . $oct . "</td>";

		  					$seconds = $row['nov'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$nov = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $nov . "</td>";

		  					$seconds = $row['december'];
							$H = floor($seconds / 3600);
							$i = ($seconds / 60) % 60;
							$december = sprintf("%02d:%02d", $H, $i);
		  					echo "<td>" . $december . " </td>";

							$HH = floor($row['total'] / 3600);
							$ii = ($row['total'] / 60) % 60;
							$tm = sprintf("%02d:%02d", $HH, $ii);
							echo "<td>" . $tm . "</td>";
							echo "</tr>";

						echo "<tr class='slidedown'>";
						$query = "SELECT * FROM csv_info WHERE project='".$row['project']."'AND date>= '".$start_date."' AND date<= '".$end_date."'";
						if($res = mysqli_query($con, $query)){
							echo "<td colspan='15'><table width='100%' bgcolor='#c0edea'>";
		  					echo "<tr bgcolor='#6b98e0'> <th>Date</th> <th>User</th> <th>Type</th> <th>Task</th> <th>Time <small> in Hr</small></th> </tr>";
									while ($r = mysqli_fetch_assoc($res)){
										echo "<tr>";
										echo "<td>".$r['date']."</td>";
										echo "<td>".$r['user_name']."</td>";
										echo "<td>".$r['type']."</td>";
										echo "<td>".$r['task']."</td>";
										echo "<td>".$r['time']."</td>";
										echo "</tr>";
								}	 
								echo "</table></td>"; 	
						  }
		  		echo "</tr>";
			}
				echo "</table>";
		}
	}
}

function getWeek($week, $year) {
					  $dto = new DateTime();
					  $result['start'] = $dto->setISODate($year, $week, 0)->format('Y-m-d');
					  $result['end'] = $dto->setISODate($year, $week, 6)->format('Y-m-d');
					  return $result;
					}

#-------------------------- To get the csv file of None view---------------------------------

	if(isset($_POST['nonebtn'])){	
		$start_date = $_POST['startdate'];
		$end_date = $_POST['enddate'];

		$sql = "SELECT id, project, user_name, date,client, type , SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60 )AS time 
				FROM csv_info 
				WHERE date>= '".$start_date."' AND date<= '".$end_date."' 
				GROUP BY project";

		if ($result = mysqli_query($con, $sql)){
		  	$fileName = 'example.csv';
		  	$num = 0;
		  	ob_end_clean();
				
		  	while ($row = mysqli_fetch_assoc($result)){
		  		$prod[$num]['id']        = $row['id'];
				$prod[$num]['project']   = $row['project'];
				        
				$seconds = $row['time'];
				$H = floor($seconds / 3600);
				$i = ($seconds / 60) % 60;
				$time = sprintf("%02d:%02d", $H, $i);
		        $prod[$num]['time']      = $time;
		        
		        $num++;
			}
	 			$fp = fopen('php://output', 'w');
	 			header('Content-Type: application/excel');
	 			header('Content-Disposition: attachment; filename="' . $fileName . '"');

  				fputcsv($fp, array('From: '.$start_date.'  To: '.$end_date));
	 			fputcsv($fp, array('ID','Project Name','Total Time in hr'));
	 			foreach($prod as $product) {
		 			   fputcsv($fp, $product);
					}
			 	fclose($fp);
			 	exit(0); // to not get html in csv file
		}
	}

#-------------------------- To get the csv file of Weekly view---------------------------------	
	if(isset($_POST['weekbtn'])){
		$start_date = $_POST['startdate'];
		$end_date = $_POST['enddate'];

		$sql= "SELECT project,
			MAX(IF(WEEK(date)= 1,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week01,
			MAX(IF(WEEK(date)= 2,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week02,
			MAX(IF(WEEK(date)= 3,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week03,
			MAX(IF(WEEK(date)= 4,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week04,
			MAX(IF(WEEK(date)= 5,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week05,
			MAX(IF(WEEK(date)= 6,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week06,
			MAX(IF(WEEK(date)= 7,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week07,
			MAX(IF(WEEK(date)= 8,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week08,
			MAX(IF(WEEK(date)= 9,  Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week09,
			MAX(IF(WEEK(date)= 10, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week10,
			MAX(IF(WEEK(date)= 11, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week11,
			MAX(IF(WEEK(date)= 12, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week12,
			MAX(IF(WEEK(date)= 13, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week13,
			MAX(IF(WEEK(date)= 14, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week14,
			MAX(IF(WEEK(date)= 15, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week15,
			MAX(IF(WEEK(date)= 16, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week16,
			MAX(IF(WEEK(date)= 17, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week17,
			MAX(IF(WEEK(date)= 18, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week18,
			MAX(IF(WEEK(date)= 19, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week19,
			MAX(IF(WEEK(date)= 20, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week20,
			MAX(IF(WEEK(date)= 21, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week21,
			MAX(IF(WEEK(date)= 22, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week22,
			MAX(IF(WEEK(date)= 23, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week23,
			MAX(IF(WEEK(date)= 24, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week24,
			MAX(IF(WEEK(date)= 25, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week25,
			MAX(IF(WEEK(date)= 26, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week26,
			MAX(IF(WEEK(date)= 27, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week27,
			MAX(IF(WEEK(date)= 28, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week28,
			MAX(IF(WEEK(date)= 29, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week29,
			MAX(IF(WEEK(date)= 30, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week30,
			MAX(IF(WEEK(date)= 31, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week31,
			MAX(IF(WEEK(date)= 32, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week32,
			MAX(IF(WEEK(date)= 33, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week33,
			MAX(IF(WEEK(date)= 34, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week34,
  			MAX(IF(WEEK(date)= 35, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week35,
    		MAX(IF(WEEK(date)= 36, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week36,
    		MAX(IF(WEEK(date)= 37, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week37,
    		MAX(IF(WEEK(date)= 38, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week38,
    		MAX(IF(WEEK(date)= 39, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week39,
    		MAX(IF(WEEK(date)= 40, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week40,
    		MAX(IF(WEEK(date)= 41, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week41,
    		MAX(IF(WEEK(date)= 42, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week42,
    		MAX(IF(WEEK(date)= 43, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week43,
    		MAX(IF(WEEK(date)= 44, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week44,
    		MAX(IF(WEEK(date)= 45, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week45,
    		MAX(IF(WEEK(date)= 46, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week46,
    		MAX(IF(WEEK(date)= 47, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week47,
    		MAX(IF(WEEK(date)= 48, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week48,
    		MAX(IF(WEEK(date)= 49, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week49,
    		MAX(IF(WEEK(date)= 50, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week50,
    		MAX(IF(WEEK(date)= 51, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week51,
    		MAX(IF(WEEK(date)= 52, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week52,
    		MAX(IF(WEEK(date)= 53, Left(time,2) * 3600 + substring(time, 4,2) * 60,0)) AS week53,
    		sum(Left(time,2) * 3600 + substring(time, 4,2) * 60) as totaltime
		    FROM csv_info 
		   	WHERE date>= '".$start_date."' AND date<= '".$end_date."'
		    GROUP BY project
		    ORDER BY date";

		if ($result = mysqli_query($con, $sql)){
									$fileName = 'weekly_csv.csv';
						  			$num = 0;
						  			ob_end_clean();
								
						  		while ($row = mysqli_fetch_assoc($result)){
						  				// print_r($row);
						  			$prod[$num]['project']   = $row['project'];

						  			$seconds = $row['week01'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week01 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week01']   = $week01;

									$seconds = $row['week02'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week02 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week02']   = $week02;

									$seconds = $row['week03'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week03 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week03']   = $week03;

									$seconds = $row['week04'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week04 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week04']   = $week04;

									$seconds = $row['week05'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week05 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week05']   = $week05;

									$seconds = $row['week06'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week06 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week06']   = $week06;

									$seconds = $row['week07'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week07 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week07']   = $week07;

									$seconds = $row['week08'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week08 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week08']   = $week08;

									$seconds = $row['week09'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week09 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week09']   = $week09;

									$seconds = $row['week10'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week10 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week10']   = $week10;

									$seconds = $row['week11'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week11 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week11']   = $week11;

									$seconds = $row['week12'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week12 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week12']   = $week12;

									$seconds = $row['week13'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week13 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week13']   = $week13;

									$seconds = $row['week14'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week14 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week14']   = $week14;

									$seconds = $row['week15'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week15 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week15']   = $week15;

									$seconds = $row['week16'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week16 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week16']   = $week16;

									$seconds = $row['week17'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week17 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week17']   = $week17;

									$seconds = $row['week18'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week18 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week18']   = $week18;

									$seconds = $row['week19'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week19 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week19']   = $week19;

									$seconds = $row['week20'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week20 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week20']   = $week20;

									$seconds = $row['week21'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week21 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week21']   = $week21;

									$seconds = $row['week22'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week22 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week22']   = $week22;

									$seconds = $row['week23'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week23 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week23']   = $week23;

									$seconds = $row['week24'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week24 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week24']   = $week24;

									$seconds = $row['week25'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week25 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week25']   = $week25;

									$seconds = $row['week26'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week26 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week26']   = $week26;

									$seconds = $row['week27'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week27 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week27']   = $week27;

									$seconds = $row['week28'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week28 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week28']   = $week28;

									$seconds = $row['week29'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week29 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week29']   = $week29;

									$seconds = $row['week30'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week30 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week30']   = $week30;

									$seconds = $row['week31'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week31 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week31']   = $week31;

									$seconds = $row['week32'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week32 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week32']   = $week32;

									$seconds = $row['week33'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week33 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week33']   = $week33;

									$seconds = $row['week34'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week34 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week34']   = $week34;

									$seconds = $row['week35'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week35 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week35']   = $week35;

									$seconds = $row['week36'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week36 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week36']   = $week36;

									$seconds = $row['week37'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week37 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week37']   = $week37;

									$seconds = $row['week38'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week38 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week38']   = $week38;

									$seconds = $row['week39'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week39 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week39']   = $week39;

									$seconds = $row['week40'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week40 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week40']   = $week40;

									$seconds = $row['week41'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week41 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week41']   = $week41;

									$seconds = $row['week42'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week42 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week42']   = $week42;

									$seconds = $row['week43'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week43 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week43']   = $week43;

									$seconds = $row['week44'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week44 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week44']   = $week44;

									$seconds = $row['week45'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week45 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week45']   = $week45;

									$seconds = $row['week46'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week46 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week46']   = $week46;

									$seconds = $row['week47'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week47 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week47']   = $week47;

									$seconds = $row['week48'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week48 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week48']   = $week48;

									$seconds = $row['week49'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week49 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week49']   = $week49;

									$seconds = $row['week50'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week50 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week50']   = $week50;

									$seconds = $row['week51'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week51 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week51']   = $week51;

									$seconds = $row['week52'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week52 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week52']   = $week52;

									$seconds = $row['week53'];
									$H = floor($seconds / 3600);
									$i = ($seconds / 60) % 60;
									$week53 = sprintf("%02d:%02d", $H, $i);
									$prod[$num]['week53']   = $week53;

								  	$HH = floor($row['totaltime'] / 3600);
								 	$ii = ($row['totaltime'] / 60) % 60;
								  	$time = sprintf("%02d:%02d", $HH, $ii);
									$prod[$num]['time']   = $time;				  	 

								  	$num++;
				}
						$fp = fopen('php://output', 'w');
						header('Content-Type: application/excel');
						header('Content-Disposition: attachment; filename="' . $fileName . '"');
						fputcsv($fp, array('From: '.$start_date.'  To: '.$end_date));
						fputcsv($fp, array('Project Name','week01','week02','week03','week04','week05','week06','week07','week08','week09','week10','week11','week12','week13','week14','week15','week16','week17','week18','week19','week20','week21','week22','week23','week24','week25','week26','week27','week28','week29','week30','week31','week32','week33','week34','week35','week36','week37','week38','week39','week40','week41','week42','week43','week44','week45','week46','week47','week48','week49','week50','week51','week52','week53','Total'));
						foreach($prod as $product) {
							fputcsv($fp, $product);
						}
							fclose($fp);
							exit(0);
		}
	}

#-------------------------- To get the csv file of Monthly view----------------------------------
	
	if(isset($_POST['monthbtn'])){
		$start_date = $_POST['startdate'];
		$end_date = $_POST['enddate'];
	
		$sql = "SELECT project,
					SUM(IF(MONTH(date) = 1, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS jan,
				    SUM(IF(MONTH(date) = 2, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS feb,
				    SUM(IF(MONTH(date) = 3, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS mar,
				    SUM(IF(MONTH(date) = 4, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS april,
				    SUM(IF(MONTH(date) = 5, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS may,
				    SUM(IF(MONTH(date) = 6, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS jun,
				    SUM(IF(MONTH(date) = 7, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS jul,
				    SUM(IF(MONTH(date) = 8, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS aug,
					SUM(IF(MONTH(date) = 9, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS sept,
				    SUM(IF(MONTH(date) = 10, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS oct,
				    SUM(IF(MONTH(date) = 11, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS nov,
				    SUM(IF(MONTH(date) = 12, Left(time,2) * 3600 + substring(time, 4,2) * 60, 0))AS december,
				    SUM(Left(time,2) * 3600 + substring(time, 4,2) * 60)AS total
				    FROM csv_info 
				    WHERE date>= '".$start_date."' AND date<= '".$end_date."'
				    GROUP BY project";

								if ($result = mysqli_query($con, $sql)){
									$fileName = 'monthly_csv.csv';
						  			$num = 0;
						  			ob_end_clean();
								
						  		while ($row = mysqli_fetch_assoc($result)){
								        $prod[$num]['project']   = $row['project'];

								        $HH = floor($row['jan'] / 3600);
										$ii = ($row['jan'] / 60) % 60;
										$jan = sprintf("%02d:%02d", $HH, $ii);
										$prod[$num]['jan']   = $jan;					  					

					  					$seconds = $row['feb'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$feb = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['feb']   = $feb;					  					

					  					$seconds = $row['mar'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$mar = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['mar']   = $mar;					  					

					  					$seconds = $row['april'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$ap = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['ap']   = $ap;					  					

					  					$seconds = $row['may'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$may = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['may']   = $may;					  					

					  					$seconds = $row['jun'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$jun = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['jun']   = $jun;					  					

					  					$seconds = $row['jul'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$jul = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['jul']   = $jul;					  					

					  					$seconds = $row['aug'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$aug = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['aug']   = $aug;					  					

					  					$HH = floor($row['sept'] / 3600);
										$ii = ($row['sept'] / 60) % 60;
										$sept = sprintf("%02d:%02d", $HH, $ii);
					  					$prod[$num]['sept']   = $sept;					  					

										$seconds = $row['oct'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$oct = sprintf("%02d:%02d", $H, $i);		  					
					  					$prod[$num]['oct']   = $oct;					  					

					  					$seconds = $row['nov'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$nov = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['nov']   = $nov;					  					

					  					$seconds = $row['december'];
										$H = floor($seconds / 3600);
										$i = ($seconds / 60) % 60;
										$december = sprintf("%02d:%02d", $H, $i);
					  					$prod[$num]['december']   = $december;					  					

										$HH = floor($row['total'] / 3600);
										$ii = ($row['total'] / 60) % 60;
										$tm = sprintf("%02d:%02d", $HH, $ii);
										$prod[$num]['tm']   = $tm;					  					
								        
								        $num++;
							 		}
							 	
							 			$fp = fopen('php://output', 'w');
							 			header('Content-Type: application/excel');
							 			header('Content-Disposition: attachment; filename="' . $fileName . '"');
						  				fputcsv($fp, array('From: '.$start_date.'  To: '.$end_date));
							 			fputcsv($fp, array('Project Name','Jan','Feb','Mar','April','May','jun','jul','Aug','Sept','Oct','Nov','Dec','Total'));
							 			foreach($prod as $product) {
								 			   fputcsv($fp, $product);
										}
							 		fclose($fp);
							 		exit(0);
							 	}						  	
	}

?>
		</form>
	</body>
</html>

<script type="text/javascript">
	$(function(){
		document.getElementById('format_select').value = "<?php echo $_POST['format_select'];?>";
		document.getElementById('startdate').value = "<?php echo $_POST['startdate'];?>";
		document.getElementById('enddate').value = "<?php echo $_POST['enddate'];?>";
		var iterateMe = <? echo json_encode($arry)?>;
		var iteratemonth = <? echo json_encode($MonthArr)?>;
		$('.slidedown').hide();

		$(document).on("click", "#show_more", function(){
			var project_name = $(this).attr("data-project");
			$(this).parent().parent().next('tr').slideToggle('fast');
		});


	 $('#mytable tbody tr td').each(function(){
	 	$(this).not(':first-child, :nth-child(2), :last-child ').hide(); 
	 });
	//$('#mytable tbody tr td').hide();
	$("#mytable th").not(':first-child, :nth-child(2), :last-child').hide();

  
	$.each(iterateMe,function(index, value) {
	  	columnTh = $("#mytable th:contains('Week"+value+"')");
	  	columnIndex = columnTh.index() + 1;
	   	// $('#mytable tbody tr td:nth-child(' + columnIndex + ')').css("color", "#F00");
	   	$('#mytable tbody tr td:nth-child(' + columnIndex + ')').show();
	    // columnTh.css("color", "#F00");
	    columnTh.show();

	    $('.slidedown tbody tr td').show(); // to show all inner table fields
	    	$(".slidedown th").show(); // to show all inner table fields
	}); 
	  
 /* for (var i = 1; i < columns; i++) {
    if ($("#mytable > tbody > tr > td:nth-child(" + i + ")").filter(function() {
      return $(this).text() != '0';
    }).length == 1) {
      $("#mytable > tbody > tr > td:nth-child(" + i + "), #mytable > thead > tr > th:nth-child(" + i + ")").hide();
    }
  }*/

  //--------- for hiding the extra months which have value 0 in month view
	  $('#monthtable tbody tr td').each(function(){
	  	$(this).not(':first-child, :nth-child(2), :last-child ').hide(); 
	  });
		$("#monthtable th").not(':first-child, :nth-child(2), :last-child').hide();
		$.each(iteratemonth,function(index, value) {
			columnTh = $("#monthtable thead th:contains("+value+")");
	    	columnIndex = columnTh.index() + 1;
	    	$('#monthtable tbody tr td:nth-child(' + columnIndex + ')').show();
	    	$('.slidedown tbody tr td').show();// to show all inner table fields
	    	$(".slidedown th").show(); // to show all inner table fields
	    	columnTh.show(); 
		});
	});
</script>