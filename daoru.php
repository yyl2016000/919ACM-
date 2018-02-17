<?php
$contestID=isset($_REQUEST['theContestID']) ? $_REQUEST['theContestID'] : "";
$conn = mysqli_connect('localhost','root','123',"acmoj0115") or die("Invalid query: " . mysqli_error($conn));
mysqli_query($conn, "SET names utf8");
mysqli_query($conn, "SET CHARACTER SET utf8");
mysqli_query($conn, "SET COLLATION_CONNECTION='utf8'");



if(!$conn) {
    die($conn->error);
}
mysqli_select_db($conn,'acmoj0115') or die("Invalid query: " . mysqli_error($conn));
$file = fopen("contest$contestID.txt","r");
$content= fread($file,filesize("contest$contestID.txt"));
fclose($file);
$text=substr($content,0,strlen($content));
$contents= explode("\r\n",$text);//explode()函数以","为标识符进行拆分
foreach ($contents as $v)//遍历循环
{
    $serial_number = $v;
    list($studentID,$studentName,$teamID,$password)=explode(" ",$serial_number);
    var_dump(explode(" ",$serial_number));
    mysqli_query($conn,"UPDATE approval SET teamID= '$teamID',password='$password'WHERE contestID= '$contestID'AND studentID='$studentID'");
}
