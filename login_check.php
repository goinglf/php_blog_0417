<?php
//开启session
session_start();
//判断是否为post提交
if(!$_POST){
    echo "服务器异常,请稍后重试";
    return ;
}
//接收表单信息
$username = $_POST['username'] ? strip_tags($_POST['username']): '';
$password = $_POST['password']? strip_tags($_POST['password']): '';
$code= $_POST['code']? strip_tags($_POST['code']): '';

//校验

if($username== '' || $password==''){
    echo "用户名或密码不能为空";
    return;
}
if($code==''){
    echo "验证码不能为空";
    return;
}
//校验验证码
//将用户提交的验证码转变为大写之后再校验
if($_SESSION['code'] !=strtoupper($code)){
    echo "验证码错误,请重新输入";
    return;
}
//数据库操作
//导入数据库文件
include 'mysql/mysql_conn.php';
$sql="SELECT password FROM blog_user WHERE username='$username'";
//执行sql语句
$result=mysqli_query($link,$sql);
//查询不成功直接返回
//if(@mysqli_fetch_row($result) ==0){
//  echo '用户名不存在,请重新输入';
//  return;
//}
$data=$result->fetch_row();
if($data ==0){
    echo '用户名不存在,请重新输入';
    return;
}
//判断密码是否一致
if (md5($password) != $data[0]){
    echo "账户或密码不正确";
    return;
}

$_SESSION['username']=$username;
header('location:index.php');