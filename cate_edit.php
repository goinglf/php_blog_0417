
<?php
header('Content-type:text/json');
include 'mysql/mysql_conn.php';
if($_POST){
    $id=$_POST['id'];
    $pid=@$_POST['pid']?strip_tags($_POST['pid']) :' ';
    $cate_name=@$_POST['cate_name'] ?strip_tags($_POST['cate_name']) :'';
    $cate_title=@$_POST['cate_title'] ?strip_tags($_POST['cate_title']) :'';
    $sql2="UPDATE blog_category SET cate_name='{$cate_name}',cate_title='{$cate_title}',cate_pid='{$pid}' WHERE id='{$id}'";

$result2=mysqli_query($link,$sql2);
if($result2){
    $data=array('status'=>0,'message'=>'修改成功');
    die(json_encode($data));

//    echo "添加成功";
//    echo "<script>setTimeout(function(){location.href='categoryList.php'},1000);</script>";
}else{
//    echo '添加失败,请稍后重试';
    $data=array('status'=>1,'message'=>'修改失败');
    die(json_encode($data));
}
}
?>