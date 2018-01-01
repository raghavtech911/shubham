<?php
session_start();
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("Location: index.php"); exit; }

if (isset($_SESSION['usr']))
{
    echo "<h2>Hi {$_SESSION['usr']}</h2>";
}
else
{
    header('location:index.php');
}

// //To check email already exists in database using php without ajax
// if(isset($_POST["submitbtn"])){
//         $sql11 = "SELECT * FROM tech_candidates";
//         $resultss = $conn->query($sql11);
//          while ($row = mysqli_fetch_array($resultss, MYSQLI_ASSOC))
//         {
//             if($_POST["email"] == $row["tech_can_email"]){
//                 echo "Email Already Exists in Database. ";
//                 $errors['email']= "emailerr";
//             }
//         }
// }

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
    <title> Basic User </title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
    <script src="js/form-validation.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

<!--  function to show hint that email alredy exist in database -->
    <script type="text/javascript">
    function showhint(str)
    {
        if(str.length == 0){
            document.getElementById("txthint").innerHTML = "";
            return;            
            }else{
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById("txthint").innerHTML=this.responseText;
                        }
                };
                xmlhttp.open("GET","checkemail.php?q="+ str, true);
                xmlhttp.send();
        }
    }
 </script>   
 </head>

<body>
<div class="container">
<a style="float:right; font-size:30px;" href="logout.php?logout"><strong>Logout user</strong></a>
</div>
    <script src="script.js">
    </script>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12 ">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event,'addnew')"> ADD NEW </button>
                    <form action="userlist.php" style="display:inline;" >
                        <button class="tablinks" onclick="openCity(event,'list')"> LIST </button>
                    </form>
                    <img id="loading" src="3.gif" height="60px" width="60px" style="display:none;">
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
    <div id="addnew" class="tabcontent">
        <div class="container text-center beauty">
            <div class="row">
                <div class="col-md-12 ">
                    <form method="post" name="register" action="" >
                        <h2> Basic Information:</h2>
                        <input class="input input1" id="date" type="text" name="date" value="<?php echo date('y/m/d');?>" />
                        <br>
                        <input class="input input1" type="text" id="name" name="name" placeholder="Enter Full Name*" ><p><span id="nameerr"></span></p>
                        <br>
                        <input class="input input1" onblur="showhint(this.value);" id="email" placeholder="Enter Email*" type="email" name="email">
                        <p><span id="txthint"></span></p>
                        <p><span id="emailerr"> </span></p>
                        <br>
                        <input type="text" class="input input1" id="phone" placeholder="Enter Mobile Number*" name="phone" minlength="10" maxlength="10" pattern="[0123456789][0-9]{9}">
                        <p><span id="phoneerr"> </span></p>
                        <br>
                        <label> Marriage Status * </label>
                        <input type="radio" id="mstatus" class="input1" name="mstatus" value="married" >
                        <label>Married</label>
                        <input type="radio" id="mstatus" class="input1" name="mstatus" value="unmarried">
                        <label>Unmarried</label>
                        <br>
                        <label> Gender *</label>
                        <input type="radio" class="input1" id="gender" name="gender" value="male" >
                        <label>Male</label>
                        <input type="radio" class="input1" id="gender" name="gender" value="female">
                        <label>Female</label>
                        <br>
                        <input class="input input1" type="text" id="qual" placeholder="Qualification*" name="qualification" ><p><span id="qualerr"> </span></p>
                        <br>
                        <input class="input input1" id="pos" type="text" placeholder="Position Applied For*" name="position"><p><span id="poserr"> </span></p>
                        <br>
                </div>
            </div>
        </div>
        <!-- end container -->
        <div class="container text-center exp">
            <div class="row">
                <h2>Experiance</h2>
                <p><span id="experr"> </span></p>
                <div class="col-md-4 ">
                    <label> Name of Company </label>
                    <br>
                    <input class="input input1" id="comp1" type="text" name="comp1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" placeholder="eg. Techinfini">
                    <br>
                    <input class="input input1" id="comp2" type="text" name="comp2" >
                    <br>
                    <input class="input input1" id="comp3" type="text" name="comp3" >
                    <br>
                </div>
                <div class="col-md-4">
                    <label> Designation </label>
                    <br>
                    <input class="input input1" id="des1" type="text" name="des1" placeholder="eg. Web Developer">
                    <br>
                    <input class="input input1" id="des2" type="text" name="des2" >
                    <br>
                    <input class="input input1" id="des3" type="text" name="des3" >
                    <br>
                </div>
                <div class="col-md-4">
                    <label> Experiance </label>
                    <br>
                    <input class="input input1" id="exp1" type="number" step="any" name="exp1" placeholder="Years">
                    <br>
                    <input class="input input1" id="exp2" type="number" step="any" name="exp2" >
                    <br>
                    <input class="input input1" id="exp3" type="number" step="any" name="exp3" >
                    <br>
                </div>
                <label> Notice Period </label>
                <input class="input input1" id="notice_period" type="text" name="notice_period">
                    <select class="dropclass input1" name="period">
                        <option class="input1" id="period" value="day">Days</option>
                        <option class="input1" id="period" value="month">Months</option>
                    </select>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h2>General Information</h2>
                    <label> Training for 1-3 Months </label>
                        <select class="dropclass input1" name="training">
                            <option class="input1" id="train" value="yes">YES</option>
                            <option class="input1" id="train" value="no">NO</option>
                        </select>
                        <br>
                        <label> Minimum Period of Working </label>
                            <select class="dropclass input1" name="minwork">
                                <option class="input1" id="minwork" value="agree">Agree</option>
                                <option class="input1" id="minwork" value="disagree">Disagree</option>
                            </select>
                            <br>
                            <label> Court of Law </label>
                                    <select class="dropclass input1" name="law">
                                        <option class="input1" id="law" value="yes">YES</option>
                                        <option class="input1" id="law" value="no">NO</option>
                                    </select>
                                    <br>
                                    <label> Multishifts </label>
                                            <select class="dropclass input1" name="shift">
                                                <option class="input1" id="shift" value="yes">YES</option>
                                                <option class="input1" id="shift" value="no">NO</option>
                                            </select>
                                            <br>
                                            <textarea rows="5" cols="35" class="input input1" placeholder="Enter Your Skills (seprated by ,)" id="skill" name="skill"></textarea>
                                            <br>
                                            <input class="input input1" id="current_ctc" type="text" placeholder="Current CTC" name="current_ctc">
                                            <br>
                                            <input class="input input1" id="expected_ctc" type="text" placeholder="Expected CTC" name="expect_ctc">
                                            <br>
                                            <label>Where Do you Hear About Our Company</label>
                                            <br>
                                            <input type="radio" class="input1" id="hear" name="hear" value="Friend">
                                            <label>Friend</label>
                                            <input type="radio" class="input1" id="hear" name="hear" value="Website">
                                            <label>Website</label>
                                            <input type="radio" class="input1" id="hear" name="hear" value="Walk-in">
                                            <label>Walkin</label>
                                            <input type="radio" class="input1" id="hear" onclick="myFunction();" name="hear">
                                            <label>Other</label>
                                            <br>
                                            <br>
                                            <p id="demo"></p>     
                                            <input type="submit" id="butn" class="btn btn-primary btn-large" name="submitbtn" value="Submit">
                                            <a href="logout.php?logout"><strong>Logout user</strong></a>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div id="list" class="tabcontent">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</body>
</html>