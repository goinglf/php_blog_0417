<?php
header('Content-type:text/json');
$id=$_GET['id'];
if($id==''){
    $data=array('status'=>1,'message'=>'请选择要删除的选项');
    die(json_encode($data));
}
include 'mysql/mysql_conn.php';
//校验id是否存在
$sql1="SELECT * FROM blog_category WHERE id='{$id}'";
$result1=@mysqli_query($link,$sql1);
if(mysqli_fetch_row($result1) <= 0){
    $data=array('status'=>2,'message'=>'请重新选择要删除的选项');
    die(json_encode($data));
}

$sql="DELETE FROM blog_category WHERE id='{$id}'";
$result=mysqli_query($link,$sql);
if($result){
    $data=array('status'=>0,'message'=>'删除成功');
    die(json_encode($data));
}else{
    $data=array('status'=>3,'message'=>'删除失败,请重试');
    die(json_encode($data));
}
