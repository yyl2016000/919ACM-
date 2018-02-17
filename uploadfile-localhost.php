<?php
/**
 * Created by PhpStorm.
 * User: WHJ
 * Date: 2018/1/19
 * Time: 16:30
 */
$data= "contest".$_COOKIE['mycookie'];

//$_FILES:文件上传变量
//print_r($_FILES);
$filename=$_FILES['myFile']['name'];
$type=$_FILES['myFile']['type'];
$tmp_name=$_FILES['myFile']['tmp_name'];
$size=$_FILES['myFile']['size'];
$error=$_FILES['myFile']['error'];

//将服务器上的临时文件移动到指定位置
//方法一move_upload_file($tmp_name,$destination)
//move_uploaded_file($tmp_name, "downloads/".$filename);//文件夹应提前建立好，不然报错
//方法二copy($src,$des)
//以上两个函数都是成功返回真，否则返回false
//copy($tmp_name, "copies/".$filename);
//注意，不能两个方法都对临时文件进行操作，临时文件似乎操作完就没了，我们试试反过来

$name=explode('.',$filename);//将文件名以'.'分割得到后缀名,得到一个数组
$newPath=$data.'.'.$name[1];
move_uploaded_file($tmp_name, "./".$newPath);
echo "<script>alert('提交成功！')</script>";
//能够实现，说明move那个函数基本上相当于剪切；copy就是copy，临时文件还在
?>


