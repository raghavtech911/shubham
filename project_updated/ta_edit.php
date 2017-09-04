<?php
session_start();
// $categories = array();
require_once('dbconnection.php');
$compname = [];
$desg = [];
$exp = [];

// to get data in forms
if (isset($_GET['tech_can_id']))
{
    $id = $_GET['tech_can_id'];
    $sql = "SELECT a.*,
        k.tech_can_exp_nameofcompany,
        k.tech_can_exp_designation,
        k.tech_can_exp_years,
        k.tech_can_exp_id,
        b.tech_can_meta_value as traing_period,
        c.tech_can_meta_value as bond,
        d.tech_can_meta_value as court_case,
        e.tech_can_meta_value as multishift,
        f.tech_can_meta_value as skills,
        g.tech_can_meta_value as current_ctc,
        h.tech_can_meta_value as expected_ctc,
        i.tech_can_meta_value as hear_about_company,
        j.tech_can_meta_value as notice_period 
      FROM tech_candidates as a,
           tech_can_exp as k,
           tech_candidate_meta as b,
           tech_candidate_meta as c,
           tech_candidate_meta as d,
           tech_candidate_meta as e,
           tech_candidate_meta as f,
           tech_candidate_meta as g,
           tech_candidate_meta as h,
           tech_candidate_meta as i,
           tech_candidate_meta as j
      where  a.tech_can_id = '$id' AND
          a.tech_can_id = b.tech_can_id AND
          a.tech_can_id = c.tech_can_id AND
          a.tech_can_id = d.tech_can_id AND
          a.tech_can_id = e.tech_can_id AND
          a.tech_can_id = f.tech_can_id AND
          a.tech_can_id = g.tech_can_id AND
          a.tech_can_id = h.tech_can_id AND 
          a.tech_can_id = i.tech_can_id AND
          a.tech_can_id = k.tech_can_id AND
          a.tech_can_id = j.tech_can_id AND
          b.tech_can_meta_key = 'traing_period' AND
          c.tech_can_meta_key = 'bond' AND
          d.tech_can_meta_key = 'court_case' AND
          e.tech_can_meta_key = 'multishift' AND
          f.tech_can_meta_key = 'skills' AND
          g.tech_can_meta_key = 'current_ctc' AND
          h.tech_can_meta_key = 'expected_ctc' AND
          i.tech_can_meta_key = 'hear_about_company' AND
          j.tech_can_meta_key = 'notice_period'";

    $result = $conn->query($sql);
    if (!$result)
    {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $expid  = $row['tech_can_exp_id'];
        $techid = $row['tech_can_id'];
        $name   = $row['tech_can_fullname'];
        $email  = $row['tech_can_email'];
        $mobile = $row['tech_can_mobile'];
        $gender = $row['tech_can_gender'];
        $dor    = $row['tech_can_dor'];
        $qual   = $row['tech_can_qualification'];
        $train  = $row['traing_period'];
        $work   = $row['bond'];
        $law    = $row['court_case'];
        $shift1 = $row['multishift'];
        $mstatus     = $row['tech_can_maritalstatus'];
        $hear        = $row['hear_about_company'];
        $tech_assign = $row['tech_can_technical_assign'];
        $current_ctc = $row['current_ctc'];
        $expect_ctc  = $row['expected_ctc'];
        $compname[]  = $row['tech_can_exp_nameofcompany'];
        $desg[] = $row['tech_can_exp_designation'];
        $notice_period = $row['notice_period'];
        $aoc = explode(",",$notice_period);
        $exp[]  = $row['tech_can_exp_years'];
        $skill  = $row['skills'];
        $pos    = $row["tech_can_appliedposition"];

        // $hrcmt1 = $row["tech_can_hr_comment"];
    }
}

//for logout
if (isset($_GET['logout']))
{
    session_unset($_SESSION['usr']);
    session_destroy();
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TA EDIT</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="js/ta-edit-validation.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
    <div>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12 ">
                    <form method="post" >
                        <h2>Change Basic Information:</h2>
                        <input class="input ab" type="text" name="date1" value="<?php echo date('y/m/d');?>" />
                        <br>

                        <input class="input ab" type="text" id="name2" name="name1" placeholder="Enter Name" pattern="[a-zA-Z]+[a-zA-Z ]+" value="<?php echo $name;?>"><p><span id="nameerr"></span></p>
                        <br>

                        <input class="input ab" type="email" id="email2" name="email1" placeholder="Enter Email" value="<?php echo $email; ?>"> <p><span id="emailerr"> </span></p>
                        <br>

                        <input type="text" class="input ab" id="phone2" placeholder="Enter Mobile" name="phone1" value="<?php echo $mobile; ?>" minlength="10" maxlength="10" pattern="[0123456789][0-9]{9}"><p><span id="phoneerr"> </span></p>
                        <br>

                        <label> Marriage Status * </label>
                        <input class="ab" type="radio" name="mstatus1" value="married" <?php echo ($mstatus=='married' )? 'checked': '' ?>>
                        <label>Married</label>
                        <input class="ab" type="radio" name="mstatus1" value="unmarried" <?php echo ($mstatus=='unmarried' )? 'checked': '' ?>>
                        <label>Unmarried</label>
                        <br>

                        <label> Gender *</label>
                        <input class="ab" type="radio" name="gender1" value="male" <?php echo ($gender=='male' )? 'checked': '' ?>>
                        <label>Male</label>
                        <input class="ab" type="radio" name="gender1" value="female" <?php echo ($gender=='female' )? 'checked': '' ?>>
                        <label>Female</label>
                        <br>

                        <input class="input ab" type="text" placeholder="Enter Qualification" id="qual2" value="<?php echo $qual; ?>" name="qual1"><p><span id="qualerr"> </span></p>
                        <br>

                        <input class="input ab" type="text" placeholder="Enter Position" id="pos2" value="<?php echo $pos; ?>" name="pos1"><p><span id="poserr"> </span></p>
                        <br>
                </div>
            </div>
        </div>
        <!-- end container -->
        <div class="container text-center exp">
            <div class="row">
                <h2>Change Experiance</h2>
                <div class="col-md-4 ">
                    <label> Name of Company </label>
                    <br>
                    <input class="input ab" type="text" value="<?php echo $compname[0]; ?>" name="comp1" >
                    <br>
                    <input class="input ab" type="text" value="<?php echo $compname[1]; ?>" name="comp2" >
                    <br>
                    <input class="input ab" type="text" value="<?php echo $compname[2]; ?>" name="comp3" >
                    <br>
                </div>
                <div class="col-md-4">
                    <label> Designation </label>
                    <br>
                    <input class="input ab" type="text" value="<?php echo $desg[0]; ?>" name="des1" >
                    <br>
                    <input class="input ab" type="text" value="<?php echo $desg[1]; ?>" name="des2">
                    <br>
                    <input class="input ab" type="text" value="<?php echo $desg[2]; ?>" name="des3">
                    <br>
                </div>
                <div class="col-md-4">
                    <label> Experiance </label>
                    <br>
                    <input class="input ab" type="number" value="<?php echo $exp[0]; ?>" name="exp1" step="any">
                    <br>
                    <input class="input ab" type="number" value="<?php echo $exp[1]; ?>" name="exp2" step="any">
                    <br>
                    <input class="input ab" type="number" value="<?php echo $exp[2]; ?>" name="exp3" step="any">
                    <br>
                </div>
                <label> Notice Period </label>
                <input class="input ab" type="text" name="notice_period1" value="<?php echo $aoc[0]; ?>">
                <\t>
                    <select class="dropclass ab" name="period">
                        <option class="ab" id="day" value="day" <?php echo ($aoc[1] =='day' )? 'selected="selected"': '' ?>>Days</option>
                        <option class="ab" id="month" value="month" <?php echo ($aoc[1] =='month' )? 'selected="selected"': '' ?>>Months</option>
                    </select>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h2>Change General Information</h2>
                    <label> Training for 1-3 Months </label>
                    <t>
                        <select class="dropclass ab" name="train1">
                            <option class="ab" value="yes" <?php echo ($train=='yes' )? 'selected="selected"': '' ?>>YES</option>
                            <option class="ab" value="no" <?php echo ($train=='no' )? 'selected="selected"': '' ?>>NO</option>
                        </select>
                        <br>
                        <label> Minimum Period of Working </label>
                        <\t>
                            <select class="dropclass ab" name="work1">
                                <option class="ab" value="agree" <?php echo ($work=='agree' )?'selected="selected"': '' ?>>Agree</option>
                                <option class="ab" value="disagree" <?php echo ($work=='disagree' )? 'selected="selected"': '' ?>>Disagree</option>
                            </select>
                            <br>
                            <label> Court of Law </label>
                            <\t>
                                <\t>
                                    <select class="dropclass ab" name="law1">
                                        <option class="ab" value="yes" <?php echo ($law=='yes' )? 'selected="selected"': '' ?>>YES</option>
                                        <option class="ab" value="no" <?php echo ($law=='no' )? 'selected="selected"': '' ?>>NO</option>
                                    </select>
                                    <br>
                                    <label> Multishifts </label>
                                    <\t>
                                        <\t>
                                            <select class="dropclass ab" name="shift1">
                                                <option class="ab" value="yes" <?php echo ($shift1=='yes' )? 'selected="selected"': ''?>>YES</option>
                                                <option class="ab" value="no" <?php echo ($shift1=='no' )? 'selected="selected"': '' ?>>NO</option>
                                            </select>
                                            <br>
                                            <textarea rows="5" cols="35" class="input ab" name="skill1"><?php echo $skill; ?></textarea>
                                            <br>
                                            <input class="input ab" type="text" value="<?php echo $current_ctc; ?>" name="current_ctc1">
                                            <br>
                                            <input class="input ab" type="text" value="<?php echo $expect_ctc; ?>" name="expect_ctc1">
                                            <br>
                                            <label>Where Do you Hear About Our Company</label>
                                            <br>
                                            <input class="ab" type="radio" name="hear1" value="Friend" <?php echo ($hear=='Friend' )? 'checked': '' ?>>
                                            <label>Friend</label>
                                            <input class="ab" type="radio" name="hear1" value="Website" <?php echo ($hear=='Website' )? 'checked': '' ?>>
                                            <label>Website</label>
                                            <input class="ab" type="radio" name="hear1" value="Walk-in" <?php echo ($hear=='Walkin' )? 'checked': '' ?>>
                                            <label>Walkin</label>
                                            <input class="ab" type="radio" onclick="myFunction();" name="hear1" <?php echo ($hear=='Other' )? 'checked': '' ?>>
                                            <label>Other</label>
                                            <br>
                                            <br>
                                            <p id="demo"></p>
                                            <input type="submit" id="buttn" class="btn btn-primary btn-large" name="updatebtn" value="Update Data">
                                            <\t>
                                                <a href="logout.php?logout"><strong>Logout user</strong></a><br><br>
                                            <a href="ta_form.php"><h2> Back To TA Home!</h2></a>
                            </form>
                </div>
            </div>
        </div>
    </div>

    </body>

</html>