<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/17
 * Time: 16:28
 */


require_once 'connect.php';

$id = array();
$query = "SELECT contestID,count(*) num FROM approval GROUP BY contestID";
$result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link) . "\n");

while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    $query1 = "select * from contest WHERE contest_id=".$row['contestID'];
    $result1 = mysqli_query($link,$query1);
    $contestName = mysqli_fetch_array($result1,MYSQLI_BOTH);
    $obj = array(
        'Contest' => $contestName['title'],
        'Number' => $row['num'],
        'Print' => "<a type='button' class='btn btn-default' onclick='list2txt(".$row['contestID'].")'>下载 </a>" //这里要写一个点击之后的函数
    );
    array_push($id, $obj);

}

echo json_encode($id);