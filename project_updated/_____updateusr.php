<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tech_db");

// to get data in form
if (isset($_GET['tech_can_id']))
{
    $id1 = $_GET['tech_can_id'];
    $sql = "SELECT * FROM tech_candidates 
          WHERE tech_can_id = '$id1'";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $name2 = $row['tech_can_fullname'];
        $email2 = $row['tech_can_email'];
        $phone2 = $row['tech_can_mobile'];
        $dor = $row['tech_can_dor'];
        $gender = $row['tech_can_gender'];
    }
}

//to update data
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['update']))
    {
        $name1 = $_POST['name1'];
        $email1 = $_POST['email1'];
        $phone1 = $_POST['phone1'];
        $gen = $_POST['gen'];
        $date1 = $_POST['date1'];

        $sql = "UPDATE tech_candidates SET tech_can_fullname = '$name1', tech_can_email = '$email1', tech_can_gender = '$gen', tech_can_mobile = '$phone1', tech_can_dor = '$date1'  
           WHERE tech_can_id = '$id1' ";
        $conn->query($sql);

        if ($conn->query($sql) === true)
        {
            echo "<br><h2> Updated !!! </h2><br>";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}

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
    <title>UPDATE</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <div class="container text-center beauty">
        <div class="row">
            <div class="col-md-12 ">
                <form method="post">
                    <h2> Update Information:</h2>
                    <input class="input" type="text" name="date1" value="<?php echo date('y/m/d');?>" />
                    <br>
                    <input class="input" type="text" name="name1" value="<?php echo $name2; ?>" placeholder="Enter Full Name*" pattern="[a-zA-Z]+[a-zA-Z ]+">
                    <br>
                    <input class="input" placeholder="Enter Email*" type="email" name="email1" value="<?php echo $email2; ?>">
                    <br>
                    <input type="text" class="input" placeholder="Enter Mobile Number*" name="phone1" value="<?php echo $phone2; ?>" minlength="10" maxlength="10" pattern="[0123456789][0-9]{9}">
                    <br>
                    <label> Gender *</label>
                    <input type="radio" name="gen" value="male" <?php echo ($gender=='male' )? 'checked': '' ?>>
                    <label>Male</label>
                    <input type="radio" name="gen" value="female" <?php echo ($gender=='female' )? 'checked': '' ?>>
                    <label>Female</label>
                    <br> n">
                    <br>
                    <br>
                    <button name="update" class="btn btn-primary btn-large"> UPDATE DATA</button>
                    <br>
                    <a href="userlist.php"><h2> Back To Home!</h2></a>
                    <a href="logout.php?logout" style="display:inline;"><strong>Logout user</strong></a>
                    
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
            </div>
        </div>
    </div>

</body>

</html>