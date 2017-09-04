<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tech_db");
if (isset($_POST['username']))
{
    $usr = $_POST['username'];
    $pw = $_POST['password'];
    $pw= md5($pw);
}

//for sessions
if (isset($_SESSION['usr']))
{
    header('Location: register-page.php');
}
if (isset($_SESSION['hr_usr']))
{
    header('Location: hrform.php');
}
if (isset($_SESSION['ta_usr']))
{
    header('Location: ta_form.php');
}

// checking login Details
if (isset($_POST['submit']))
{
    $sql = "SELECT tech_users_id, tech_users_username, tech_users_password, tech_users_role FROM tech_users";
    $auth = $conn->query($sql);
    if ($auth->num_rows > 0)
    {
        while ($row = $auth->fetch_assoc())
        {
            if ($row['tech_users_username'] == $usr && $row['tech_users_password'] == $pw && $row['tech_users_role'] == 0)
            {
                $_SESSION['usr'] = $row['tech_users_username'];
                $_SESSION['techid'] = $row['tech_users_id'];
                header("Location: register-page.php");
            }
            else if ($row['tech_users_username'] == $usr && $row['tech_users_password'] == $pw && $row['tech_users_role'] == 1)
            {
                $_SESSION['usr'] = $row['tech_users_username'];
                $_SESSION['techid'] = $row['tech_users_id'];
                header("Location: hrform.php");
            }
            else if ($row['tech_users_username'] == $usr && $row['tech_users_password'] == $pw && $row['tech_users_role'] == 2)
            {
                $_SESSION['usr'] = $row['tech_users_username'];
                $_SESSION['techid'] = $row['tech_users_id'];
                header("Location: ta_form.php");
            }
            else
            {
                echo "<h2> Failed ! Try again... </h2>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="styleforlogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<body>
    <div class="login">
        <h1>Login</h1>
        <form method="post">
            <input style="color:white;" type="text" name="username" placeholder="Username" required="required" />
            <input style="color:white;" type="password" name="password" placeholder="Password" required="required" />
            <button name="submit" type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
    </div>
</body>

</html>