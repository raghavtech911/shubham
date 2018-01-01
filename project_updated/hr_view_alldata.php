<?php
session_start();
require_once('dbconnection.php');

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
       i.tech_can_meta_value as hear_about_company 
    FROM tech_candidates as a,
         tech_can_exp as k,
         tech_candidate_meta as b,
         tech_candidate_meta as c,
         tech_candidate_meta as d,
         tech_candidate_meta as e,
         tech_candidate_meta as f,
         tech_candidate_meta as g,
         tech_candidate_meta as h,
         tech_candidate_meta as i
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
            b.tech_can_meta_key = 'traing_period' AND
          c.tech_can_meta_key = 'bond' AND
          d.tech_can_meta_key = 'court_case' AND
          e.tech_can_meta_key = 'multishift' AND
          f.tech_can_meta_key = 'skills' AND
          g.tech_can_meta_key = 'current_ctc' AND
          h.tech_can_meta_key = 'expected_ctc' AND
          i.tech_can_meta_key = 'hear_about_company'";

    $result = $conn->query($sql);
    if (!$result)
    {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    echo "<table border='1px'>   
            <thead>   
                <tr>  
                    <th> Company name </th>
                    <th> Designation </th>
                    <th> Experiance Years </th>
                </tr>";

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $tech_assign = $row['tech_can_technical_assign'];
        $tech_assignnn = '';
        if($tech_assign== '3'){$tech_assignnn= ' ';}        
        if($tech_assign== '4'){$tech_assignnn= '2';}
        if($tech_assign== '5'){$tech_assignnn= '3';}
        if($tech_assign== '6'){$tech_assignnn= '4';}
        if($tech_assign== '7'){$tech_assignnn= '5';}
        if($tech_assign== '8'){$tech_assignnn= '6';}

        $hrcmt1 = $row['tech_can_hr_comment'];
        $_SESSION['exp_id'] = $row['tech_can_exp_id'];
        echo "<tr>";
        $name = $row['tech_can_fullname'];
        $email = $row['tech_can_email'];
        $mobile = $row['tech_can_mobile'];
        $gender = $row['tech_can_gender'];
        $dor = $row['tech_can_dor'];
        $qual = $row['tech_can_qualification'];
        $train = $row['traing_period'];
        $work = $row['bond'];
        $law = $row['court_case'];
        $mrg = $row['tech_can_maritalstatus'];
        $hear = $row['hear_about_company'];
        $tech = $row['tech_can_technical_assign'];
        $cur = $row['current_ctc'];
        $exp = $row['expected_ctc'];

        echo "<td>" . $row['tech_can_exp_nameofcompany'] . "</td>";
        // echo "<td>" . $row['tech_can_appliedposition'] . "</td>";
        echo "<td>" . $row['tech_can_exp_designation'] . "</td>";
        echo "<td>" . $row['tech_can_exp_years'] . "</td>";
        echo "</tr>";
    }
    
    echo "<div id='showl'>";
    echo "<dl class='dl-horizontal'>";
    echo "<dt> Name: </dt>";
    echo "<dd> $name </dd>";
    echo "<dt> Email: </dt>";
    echo "<dd> $email </dd>";
    echo "<dt> Mobile: </dt>";
    echo "<dd> $mobile </dd>";
    echo "<dt> Gender: </dt>";
    echo "<dd> $gender </dd>";
    echo "<dt> Date: </dt>";
    echo "<dd> $dor </dd>";
    echo "<dt> Qualification: </dt>";
    echo "<dd> $qual </dd>";
    echo "<dt> Training </dt>";
    echo "<dd> $train </dd>";
    echo "<dt> Minwork period:</dt>";
    echo "<dd> $work </dd>";
    echo "<dt> Hear abt Company: </dt>";
    echo "<dd> $hear </dd>";
    echo "<dt> court cases: </dt>";
    echo "<dd> $law </dd>";
    echo "<dt> Married: </dt>";
    echo "<dd> $mrg </dd>";

    if($tech_assignnn !== ''){
    echo "<dt>TA Assigned : </dt>";
    echo "<dd> techuser $tech_assignnn </dd>";
    echo "<dt> HR comment: </dt>";
    echo "<dd> $hrcmt1 </dd>";
    // echo "Technical Assigned :  techuser".$tech_assignnn."<br>";
    // echo "HR Comment:   ".$hrcmt1."<br>";
  }
    echo "<dt> CurrentCTC: </dt>";
    echo "<dd> $cur </dd>";
    echo "<dt> ExpectedCTC: </dt>";
    echo "<dd> $exp </dd>";
    echo "</dl";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "</div>";
    echo "</table>";

}

//to update TA assign and HR comment
if (isset($_POST['updatedata']))
{
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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Page</title>
    <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
      #showl{
        color:white;
        font-size: 20px;
        text-align: center;
      }
    </style>
   <!--  <script type="text/javascript">
      $(function(){
        $('#btn').click(function(){
          var x= $('.input').serializeArray();
          alert(x);
          $.ajax({
            type: "POST",
            url: "assign-ta-data.php",
            data: x,
            success: function(data){
              alert('done');
            },
          });
        });
      });
    </script> -->
</head>

<body>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <label> Technical Assign :</label>
                    <br>
                    <select class="input" name="ta2" value="<?php echo $tech_assign; ?>">
                            <option value="">Select TA</option>

                        <?php 
                        $sql = "SELECT tech_users_id, tech_users_username FROM tech_users WHERE tech_users_role = 2";
                        $result = $conn->query($sql);
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){?>
                             
                      <option class="input" value="<?php echo $row["tech_users_id"]; ?>"><?php echo $row["tech_users_username"]; ?></option>

                        <?php }?>
                    </select>";
                    <br>
                    <label>HR Comment:</label>
                    <br>
                    <textarea class="input" rows="5" cols="35"  value="<?php echo $hrcmt1; ?>" name="hrcmt2"></textarea>
                    <br>
                    <input type="submit" id="btn" class="btn btn-primary btn-large" name="updatedata" value="Update">
                </form>
                <a href="hrform.php"><h2> Back To Home!</h2></a>
                <a href="logout.php?logout"><strong><h2>Logout user</h2></strong></a>
            </div>
        </div>
    </div>
</body>
</html>