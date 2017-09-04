<?php 
require_once('dbconnection.php');
include 'ta_edit.php'; 

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
            $name1  = $_POST['name1'];
            $email1 = $_POST['email1'];
            $phone1 = $_POST['phone1'];
            $gen1   = $_POST['gender1'];
            $date1  = $_POST['date1'];
            $qual1  = $_POST['qual1'];
            $train1 = $_POST['train1'];
            $work1  = $_POST['work1'];
            $law1   = $_POST['law1'];
            $mstatus1 = $_POST['mstatus1'];
            $hear1    = $_POST['hear1'];
            $current_ctc1 = $_POST['current_ctc1'];
            $expect_ctc1  = $_POST['expect_ctc1'];
            $compname1 = $_POST['comp1'];
            $compname2 = $_POST['comp2'];
            $compname3 = $_POST['comp3'];
            $desg1  = $_POST['des1'];
            $desg2  = $_POST['des2'];
            $desg3  = $_POST['des3'];
            $exp1   = $_POST['exp1'];
            $exp2   = $_POST['exp2'];
            $exp3   = $_POST['exp3'];
            $skill1 = $_POST['skill1'];
            $pos1   = $_POST['pos1'];
            $notice_period1 = $_POST['notice_period1'].",".$_POST['period'];
            $law1   = $_POST['law1'];
            $shift1 = $_POST['shift1'];
            $id = $_GET['tech_can_id'];
            echo $id;


            //To update data in table 1 candidate info
            $sql = "UPDATE tech_candidates
                SET tech_can_fullname = '$name1',
                    tech_can_email    = '$email1',
                    tech_can_gender   = '$gen1',
                    tech_can_mobile   = '$phone1',
                    tech_can_dor      = '$date1',
                    tech_can_qualification    = '$qual1',
                    tech_can_appliedposition  = '$pos1',
                    tech_can_maritalstatus    =  '$mstatus1'
                    WHERE tech_can_id = '$id'";
            if ($conn->query($sql) === true)
            {
                echo "updated !";
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        

            $shubh1 = "SELECT tech_can_exp_id FROM tech_can_exp WHERE tech_can_id= '$id'";
            $result = $conn->query($shubh1);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              $techuserids[] = $row['tech_can_exp_id'];
            }

            $shubham1 = "UPDATE tech_can_exp SET tech_can_exp_nameofcompany= '$compname1',
                tech_can_exp_designation = '$desg1',
                tech_can_exp_years = '$exp1'
                WHERE tech_can_exp_id = '$techuserids[0]' AND
                tech_can_id = '$id'";

                if ($conn->query($shubham1) === true)
            {
                echo "updated !";
            }
            else
            {
                echo "Error: " . $shubham1 . "<br>" . $conn->error;
            }
           
            $shubham2 =  "UPDATE tech_can_exp SET tech_can_exp_nameofcompany = '$compname2',
                tech_can_exp_designation = '$desg2',
                tech_can_exp_years = '$exp2'
                WHERE tech_can_exp_id = '$techuserids[1]' AND
                tech_can_id = '$id'";
            if ($conn->query($shubham2) === true)
            {
                echo "updated !";
            }
            else
            {
                echo "Error: " . $shubham2 . "<br>" . $conn->error;
            }
           $shubham3  =  "UPDATE tech_can_exp SET tech_can_exp_nameofcompany= '$compname3',
                tech_can_exp_designation = '$desg3',
                tech_can_exp_years = '$exp3'
                WHERE tech_can_exp_id = '$techuserids[2]' AND
                tech_can_id = '$id'";
             if ($conn->query($shubham3) === true)
            {
                echo "updated !";
            }
            else
            {
                echo "Error: " . $shubham3 . "<br>" . $conn->error;
            }        

            //To update data in table3  meta table
            $sql2 = "UPDATE tech_candidate_meta 
                    SET tech_can_meta_value = '$train1' 
                    WHERE tech_can_meta_key ='traing_period' AND
                    tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$work1' 
                     WHERE tech_can_meta_key ='bond' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$law1' 
                     WHERE tech_can_meta_key ='court_case' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$shift1' 
                     WHERE tech_can_meta_key ='multishift' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$skill1' 
                     WHERE tech_can_meta_key ='skills' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$current_ctc1' 
                     WHERE tech_can_meta_key ='current_ctc' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$expect_ctc1' 
                     WHERE tech_can_meta_key ='expected_ctc' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$hear1' 
                     WHERE tech_can_meta_key ='hear_about_company' AND
                      tech_can_id = '$id';";

            $sql2 .= "UPDATE tech_candidate_meta 
                     SET tech_can_meta_value = '$notice_period1' 
                     WHERE tech_can_meta_key ='notice_period' AND
                      tech_can_id = '$id'";

            if (mysqli_multi_query($conn, $sql2))
            {
                echo "updated !!!";
            }else{
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
 }

 ?>