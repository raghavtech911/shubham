<?php
require_once('dbconnection.php');  
$errors = array();
$hear1 = '';

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $mstatus = $_POST['mstatus'];
        $gender = $_POST['gender'];
        $qual = $_POST['qualification'];
        $position = $_POST['position'];
        $date = $_POST['date'];

        $comp1 = $_POST['comp1'];
        $des1 = $_POST['des1'];
        $exp1 = $_POST['exp1'];
        $comp2 = $_POST['comp2'];
        $des2 = $_POST['des2'];
        $exp2 = $_POST['exp2'];
        $comp3 = $_POST['comp3'];
        $des3 = $_POST['des3'];
        $exp3 = $_POST['exp3'];
        $notice_period = $_POST['notice_period'].",".$_POST['period'];
        $total_exp = ($exp1 + $exp2 + $exp3);
        $training = $_POST['training'];
        $minwork = $_POST['minwork'];
        $law = $_POST['law'];
        $shift = $_POST['shift'];
        $skill = $_POST['skill'];
        $current_ctc = $_POST['current_ctc'];
        $expect_ctc = $_POST['expect_ctc'];
        $hear = $_POST['hear'];

        if (!$errors)
        {
            // insert data into candidate information table
            $sql = "INSERT INTO tech_candidates (tech_can_fullname, tech_can_email, tech_can_mobile, tech_can_gender, tech_can_qualification, tech_can_appliedposition, tech_can_maritalstatus, tech_can_dor)  
                  VALUES ('$name', '$email', '$phone', '$gender', '$qual', '$position', '$mstatus', '$date')";

            if ($conn->query($sql) === true)
            {
                echo "<br><h2> data inserted into candidate information table !!! </h2><br>";
                $lastid = mysqli_insert_id($conn);
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }


            //to insert data in Experiance table
            if (!empty($comp1) && empty($comp2) && empty($comp3))
            {
                $sql1 = "INSERT INTO tech_can_exp (tech_can_exp_nameofcompany, tech_can_exp_designation, tech_can_exp_years, tech_can_id)  
                          VALUES ('$comp1', '$des1', '$exp1', '$lastid')";
                $conn->query($sql1);
                echo "<br><h2> data inserted into Experiance table !!! </h2><br>";
            }

            if (!empty($comp1) && !empty($comp2) && empty($comp3))
            {
                $sql2 = "INSERT INTO tech_can_exp (tech_can_exp_nameofcompany, tech_can_exp_designation, tech_can_exp_years,tech_can_id)  
               VALUES ('$comp1', '$des1', '$exp1', '$lastid'),
                      ('$comp2', '$des2', '$exp2', '$lastid')";
                $conn->query($sql2);
                echo "<br><h2> data inserted into Experiance table !!! </h2><br>";
            }

            if (!empty($comp1) && !empty($comp2) && !empty($comp3))
            {
                $sql3 = "INSERT INTO tech_can_exp (tech_can_exp_nameofcompany, tech_can_exp_designation, tech_can_exp_years, tech_can_id)  
               VALUES ('$comp1', '$des1', '$exp1', '$lastid'),
                      ('$comp2', '$des2', '$exp2', '$lastid'),
                      ('$comp3', '$des3', '$exp3', '$lastid')";
                $conn->query($sql3);
                echo "<br><h2> data inserted into Experiance table !!! </h2><br>";

            }

            //if not entered any compny name then the current CTC would be NULL
            if ($comp1 == '-' && $comp2 == '-' && $comp3 == '-'){
                $current_ctc= NULL;
            }

            //to insert data in Candidate Meta table
            $sql4 = "INSERT INTO tech_candidate_meta(tech_can_id, tech_can_meta_key,tech_can_meta_value)
                  VALUES ( '$lastid', 'total_exprience',  '$total_exp'),
                         ( '$lastid', 'traing_period',  '$training'),
                         ( '$lastid', 'bond','$minwork'),
                         ( '$lastid', 'court_case',  '$law'),
                         ( '$lastid', 'multishift','$shift'),
                         ( '$lastid', 'skills', '$skill'), 
                         ( '$lastid', 'current_ctc', '$current_ctc'),
                         ( '$lastid', 'expected_ctc', '$expect_ctc' ),                              
                         ( '$lastid', 'hear_about_company', '$hear'),
                         ( '$lastid', 'notice_period', '$notice_period')";

            if ($conn->query($sql4) === true)
            {
                echo "<h2> data inserted into Candidate Meta table !!!</h2>";
            }
            else
            {
                echo "Error: " . $sql4 . "<br>" . $conn->error;
            }
        }
}

?>