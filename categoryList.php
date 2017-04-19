<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style/css/ch-ui.admin.css">
	<link rel="stylesheet" href="style/font/css/font-awesome.min.css">
    <script type="text/javascript" src="style/js/jquery.js"></script>
    <script type="text/javascript" src="layer/layer.js"></script>
    <script type="text/javascript" src="style/js/ch-ui.admin.js"></script>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>分类名称</th>
                        <th>分类描述</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    include 'mysql/mysql_conn.php';
                    $sql="SELECT * FROM blog_category";
                    $result=@mysqli_query($link,$sql);
                    while ($data =@mysqli_fetch_assoc($result)){
                        $list[]=array(
                            'id'   =>$data['id'],
                            'name' =>$data['cate_name'],
                            'title' =>$data['cate_title'],
                            'order' =>$data['cate_order']
                        );
                    }

                    ?>
                    <?php foreach ($list as $k =>$v){
                        ?>
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">
                            <input type="text" name="ord[]" value="<?php echo $v['order']?>">
                        </td>
                        <td class="tc"><?php echo $v['id']?></td>
                        <td>
                            <a href="#"><?php echo $v['name']?></a>
                        </td>
                        <td><?php echo $v['title']?></td>
                        <td>
                            <a href="categoryEdit.php?id=<?php echo $v['id']?>">修改</a>
                            <a href="javascript:;"  onclick="del(<?php echo $v['id']?>)" >删除</a>
                            <script>

                            </script>
                        </td>
                    </tr>
                    <?php };?>
                </table>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
</body>
</html>

<script>
function del(id) {
        layer.confirm('确认删除吗？', {
        btn: ['确认','取消'] //按钮
    }, function() {
            $.ajax({
                type: 'GET',
                url: 'categoryDel.php',
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    if (data.status != 0) {
                        layer.msg(data.message, {icon: 2});
                        return;
                    }
                    layer.msg('删除成功', {
                        icon: 6,
                        time: 2000
                    },
                        function () {
                            location.href ="categoryList.php";
                        })
                },
                error: function (xhr, status) {
                    console.log(xhr);
                    console.log(status);
                }
            });
        },
            function () {
                    layer.msg('取消删除', {
                        icon: 2,
                        time: 2000 //
                    });

                });

}
</script>