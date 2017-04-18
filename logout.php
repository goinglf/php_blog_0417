<?php
include 'username_check_session.php';
//将session的值为空
$_SESSION['username']='';

header('location:login.php');


?>