<?php
$mysqli = new MySQLi("localhost","root","123","acmoj0115");
$table_name="approval";
$contestID=isset($_REQUEST['theContestID']) ? $_REQUEST['theContestID'] : "";

mysqli_query($mysqli, "SET names utf8");
mysqli_query($mysqli, "SET CHARACTER SET utf8");
mysqli_query($mysqli, "SET COLLATION_CONNECTION='utf8'");
if(!$mysqli){
    die($mysqli->error);
}
function showTable($mysqli,$table_name,$contestID){
    $sql = "select * from $table_name";
   //  $res = $mysqli->query($sql);
    //获取返回总行数和列数
    //echo "共有：".$res->num_rows."行；共有：".$res->field_count."列。";
    //获取表头---从$res取出
    $query = mysqli_query($mysqli,$sql);
    $myfile = fopen("contest$contestID.txt", "w") or die("Unable to open file!");
//遍历数据源，并赋值给$r，当没有数据时，变成false中断循环//mysql_fetch_array() 函数从结果集中取得一行作为关联数组，或数字数组，或二者兼有
    while($r = mysqli_fetch_array($query)) {
        if ($r['contestID'] ==$contestID&&$r['status'] ==1){
            fwrite($myfile, $r['studentID']);//输出字段
            fwrite($myfile, " ");
            fwrite($myfile, $r['studentName'] ."\r\n");
        }
    }
    fclose($myfile);
}
function downfile($contestID){
    ob_end_clean(); //此处为php模板显示
    $filePath = "./";//此处给出你下载的文件在服务器的什么地方
    $fileName = "contest$contestID.txt";//此处给出你下载的文件名
    $file = fopen($filePath . $fileName, "a+"); //   打开文件
    Header("Content-type:application/octet-stream ");
    Header("Accept-Ranges:bytes ");
    Header("Accept-Length:   " . filesize($filePath . $fileName));
    Header("Content-Disposition:attachment;filename= " . $fileName);//   输出文件内容
    echo file_get_contents($fileName);
    fclose($file);
}
showTable($mysqli,"$table_name",$contestID);
downfile($contestID);