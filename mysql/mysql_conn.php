<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 14:50
 */
//设置字符集
header("Content-type:text/html;charset=utf-8");
//连接数据库
$link=@mysqli_connect('localhost','root','','blog') or die('连接失败,请稍后重试');
//设置数据库编码
mysqli_query($link,"set names utf8");