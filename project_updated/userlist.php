<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tech_db");
$sql = "SELECT * FROM tech_candidates";
$result = $conn->query($sql);

if (!$result)
{
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
                    <th> Update data </th>   
                </tr>";

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    $id = $row['tech_can_id'];
    echo "<td>" . $row['tech_can_id'] . "</td>";
    echo "<td>" . $row['tech_can_fullname'] . "</td>";
    echo "<td>" . $row['tech_can_email'] . "</td>";
    echo "<td>" . $row['tech_can_mobile'] . "</td>";
    echo "<td>" . $row['tech_can_gender'] . "</td>";
    echo "<td>" . $row['tech_can_dor'] . "</td>";
    echo "<td>";
    echo "<a href='update-usr2-ajax.php?tech_can_id=$id'> Edit </a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

//for logout
if (isset($_GET['logout']))
{
    //unset($_SESSION['usr']);
    //session_unset();
    session_unset($_SESSION['usr']);
    session_destroy();
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Page</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
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
<div id="loding"></div>
    <form method="post">
        <br>
        <br>
        <br>
        <br>
        <a href="register-page.php"><h2> Back To Home!</h2></a>
        <a href="logout.php?logout"><strong><h2>Logout user<h2></strong></a>
    </form>
</body>

</html>