<?php
include 'username_check_session.php';

if(!$_POST){
    header('location:login.php');
    return;
}

$password_o=$_POST['password_o']? strip_tags($_POST['password_o']): '';
$password=$_POST['password']? strip_tags($_POST['password']): '';
$password_c=$_POST['password_c']? strip_tags($_POST['password_c']): '';
//校验

if($password_o ==''){
    echo "原密码不能为空";
    return;
}

if($password =='' ||  $password_c==''){
    echo "新密码和确认密码不能为空";
    return;
}

if( strlen($password) <6 || strlen($password_c) <6 || strlen($password_o) <6){
    echo "密码不能少于6位";
    return;
}


if($password_o == $password){
    echo '新密码不能与原密码相同';
    return;
}
if($password != $password_c){
    echo '确认密码不一致';
    return;
}

include 'mysql/mysql_conn.php';
$username=$_SESSION['username'];
$password_o=md5($password_o);
//查询密码是否正确
$sql="SELECT username FROM blog_user WHERE password='$password_o'";

$result=mysqli_query($link,$sql);
$data=mysqli_fetch_row($result);

if(!$data){
    echo '请输入正确的密码';
    return;
}
$password=md5($password);
//修改密码
$sql="UPDATE blog_user SET password='$password' WHERE username='$username'";
$result1=mysqli_query($link,$sql);
if($result1){
    $_SESSION['username']='';
    //跳转页面
//    header('top.location:login.php');
    echo '修改成功,正在跳转';
    echo "<script>setTimeout(function(){top.location.href='login.php'},1000);</script>";
}else{
    echo '密码修改失败,请稍后重试';
}
?>