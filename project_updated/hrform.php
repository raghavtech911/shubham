<!DOCTYPE html>
<html>

<head>
    <title>List Page</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
</div>

<body>
    <script src="script.js">
    </script>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12 ">
                <div class="tab">
                    <button class="tablink" onclick="openCitya(event,'raddnew')"> LIST OF ALL CANDIDATES </button>
                    <form action="reject_list.php" style="display:inline;">
                        <button class="tablink" onclick="openCitya(event,'rlist')"> REJECTED LIST </button>
                    </form>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="raddnew" class="tabcontent1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  
<?php 
session_start();
$_SESSION['hr_usr']= 'hr_user';
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("Location: index.php"); exit; }
$conn = new mysqli("localhost", "root", "", "tech_db");


$sql = "SELECT tech_candidates.tech_can_id, tech_candidates.tech_can_fullname, tech_candidates.tech_can_email, tech_candidates.tech_can_mobile,  tech_candidates.tech_can_gender, tech_candidates.tech_can_dor, tech_candidates.tech_can_appliedposition , SUM(tech_can_exp.tech_can_exp_years) AS sumval FROM tech_candidates 
                INNER JOIN tech_can_exp ON tech_candidates.tech_can_id = tech_can_exp.tech_can_id WHERE tech_can_status = 0 GROUP BY tech_candidates.tech_can_id" ;

$result = $conn->query($sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

echo "<table border='1px'>   
            <thead>   
                <tr>  
                    <th> SR.NO. </th>   
                    <th> Name </th>
                    <th> Email </th>   
                    <th> Mobile </th>   
                    <th> Gender </th>   
                    <th> Date of registration </th>
                    <th> Position For Applied </th>
                    <th> Total Experiance </th>
                    <th> Actions </th>   
                </tr>";

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<tr>";
    $id= $row['tech_can_id'];
    echo "<td>" . $row['tech_can_id'] . "</td>";
    echo "<td>" . $row['tech_can_fullname'] . "</td>";
    echo "<td>" . $row['tech_can_email'] . "</td>";
    echo "<td>" . $row['tech_can_mobile'] . "</td>";
    echo "<td>" . $row['tech_can_gender'] . "</td>";
    echo "<td>" . $row['tech_can_dor'] . "</td>";
    echo "<td>" . $row['tech_can_appliedposition'] . "</td>";
    echo "<td>" . $row['sumval'] . "</td>";
     echo "<td>";
     echo "<a href='hr_view_alldata.php?tech_can_id=$id'> View</a>";
     echo "<a href='hr-edit-update-data.php?tech_can_id=$id'> Edit</a> ";
     echo "<a href='rejectcode.php?tech_can_id=$id'> Reject </a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>

			</div>
		</div>
	</div>    
</div>
<div id="rlist" class="tabcontent1"> 
</div>
<br><br><br><br><br> 
<a href="logout.php?logout"><strong><h2>Logout user<h2></strong></a>
<br><br><br><br><br><br><br><br><br><br><br>
 </body>
 </html>
