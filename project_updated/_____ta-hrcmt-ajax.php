<?php
require_once('dbconnection.php');
    $ta2 = $_POST['ta2'];
    $hrcmt2 = $_POST['hrcmt2'];

    $sqll = "UPDATE tech_candidates
                SET tech_can_technical_assign= '$ta2',
                    tech_can_hr_comment = '$hrcmt2'
                    WHERE tech_can_id='$id'";

    if ($conn->query($sqll) === true)
    {
        echo "<br><h2> Updated !!! </h2><br>";
    }
    else
    {
        echo "Error: " . $sqll . "<br>" . $conn->error;
    }
    header("Refresh:0");
?>