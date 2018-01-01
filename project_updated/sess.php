<?php
session_start();
if(isset($_SESSION['hi'])){
echo "{$_SESSION['hi']}";
}
?>