<?php

$id=$_GET['id'];

if($id== ''){
    echo '请选择项';
    return;
}

include 'mysql/mysql_conn.php';
$sql1="SELECT * FROM blog_category WHERE id='{$id}'";
$result1 = @mysqli_query($link,$sql1);
$data1 = mysqli_fetch_assoc($result1);
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="style/font/css/font-awesome.min.css">
    <script type="text/javascript" src="style/js/jquery.js"></script>
    <script type="text/javascript" src="layer/layer.js"></script>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->

<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="" method="post">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>父级分类：</th>
                <td>
                    <?php
                    $sql="SELECT * FROM blog_category WHERE cate_pid =0";
                    $result=@mysqli_query($link,$sql);
                    while ($data =@mysqli_fetch_assoc($result)){
                        $list []=array(
                            'id' =>$data['id'],
                            'name' =>$data['cate_name']
                        );
                    }
                    ?>
                    <select name="pid">
                        <option value="">==请选择==</option>
                        <?php foreach ($list as $k =>$v){?>
                            <?php
                                if($v['id'] ==$data1['cate_pid'] ){?>
                                    <option value="<?php echo $v['id'] ?>"  selected><?php echo $v['name'] ?></option>
                                        <?php  }else{?>
                                                        <option value="<?php echo $v['id'] ?>" ><?php echo $v['name'] ?></option>
                                             <?php }?>
                                    <?php };?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类名称：</th>
                <td>
                    <input type="text" class="lg" name="cate_name" value="<?php echo $data1['cate_name']?>">
                    <p>名称可以写30个字</p>
                </td>
            </tr>
            <th><i class="require">*</i>分类标题：</th>
            <td>
                <input type="text" class="lg" name="cate_title" value="<?php echo $data1['cate_title']?>">
                <p>标题可以写30个字</p>
            </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="提交" >
                </td>
                <td>
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

</body>
</html>

<!--<script>-->
<!--   function edit() {-->
<!--       layer.msg('修改成功正在跳转',{icon: 1, time: 2000},-->
<!--       function () {-->
<!--           location.href ="categoryList.php";-->
<!--       });-->
<!--    };-->
<!--</script>-->



<?php

header('Content-type:text/json');
if($_POST){
$pid=@$_POST['pid']?strip_tags($_POST['pid']) :' ';
$cate_name=@$_POST['cate_name'] ?strip_tags($_POST['cate_name']) :'';
$cate_title=@$_POST['cate_title'] ?strip_tags($_POST['cate_title']) :'';

$sql2="UPDATE blog_category SET cate_name='{$cate_name}',cate_title='{$cate_title}',cate_pid='{$pid}' WHERE id='{$id}'";
var_dump($sql2);
//$result2=mysqli_query($link,$sql2);
//if($result2){
//    echo "添加成功";
//    echo "<script>setTimeout(function(){location.href='categoryList.php'},1000);</script>";
//}else{
//    echo '添加失败,请稍后重试';
//}
    }
?>
