<?php 
session_start();

$_SESSION['ta_usr']= 'ta';
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("Location: index.php"); exit; }
$conn = new mysqli("localhost", "root", "", "tech_db");

// if (isset($_SESSION['ta_usr'])) {
//     header('Location: ta_form.php');
// }

$sql = "SELECT tech_candidates.tech_can_id, tech_candidates.tech_can_fullname, tech_candidates.tech_can_email, tech_candidates.tech_can_mobile,  tech_candidates.tech_can_gender, tech_candidates.tech_can_dor, tech_candidates.tech_can_appliedposition, tech_candidates.tech_can_technical_assign, SUM(tech_can_exp.tech_can_exp_years) AS sumval 
        FROM tech_candidates 
        INNER JOIN tech_can_exp ON tech_candidates.tech_can_id = tech_can_exp.tech_can_id
        GROUP BY tech_candidates.tech_can_id" ;

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
    $id= $row['tech_can_id'];
    echo "<tr>";
    echo "<td>" . $row['tech_can_id'] . "</td>";
    echo "<td>" . $row['tech_can_fullname'] . "</td>";
    echo "<td>" . $row['tech_can_email'] . "</td>";
    echo "<td>" . $row['tech_can_mobile'] . "</td>";
    echo "<td>" . $row['tech_can_gender'] . "</td>";
    echo "<td>" . $row['tech_can_dor'] . "</td>";
    echo "<td>" . $row['tech_can_appliedposition'] . "</td>";
    echo "<td>" . $row['sumval'] . "</td>";
    $tech_assign_val = $row['tech_can_technical_assign'];   
    echo "<td>";
    if($_SESSION['techid'] == $tech_assign_val){
    echo "<a href='ta-edit-ajax.php?tech_can_id=$id'> Edit</a> ";
}
    echo "</td>";
    echo "</tr>";
}
echo "</table>";


if (isset($_GET['logout'])) {
    //unset($_SESSION['usr']);
    //session_unset();
    session_unset($_SESSION['usr']);
    session_destroy();
    header('location:index.php');
}
echo $tech_assign_val;
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Tech List</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 <form method="get">
 	<a href="logout.php?logout"><strong>Logout user</strong></a>
 </form>
 </body>
 </html>