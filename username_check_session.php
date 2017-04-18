<?php
//开启session
session_start();
if($_SESSION['username'] == ''){
    header('location:login.php');
    return;
}

?>
