<?php 
session_start();

include('db_connect.php');

if (isset($_POST['username'])) {
    $usr = $_POST['username'];
    $pw = $_POST['password'];
    $pw= md5($pw);
}

if (isset($_SESSION['usr'])) {
    header('Location: index.php');
}


if (isset($_POST['submit'])) {
    $sql = "SELECT username, password FROM login_table";
    $auth = $conn->query($sql);

    if ($auth->num_rows > 0) {

        while ($row = $auth->fetch_assoc()) {

            if ($row['username'] == $usr && $row['password'] == $pw) {
                $_SESSION['usr'] = $row['username'];
                header("Location: index.php");
            }else{
                echo "Check Login Details !";
                }
        }
    }
}

?>