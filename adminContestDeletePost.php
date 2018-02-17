<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/19
 * Time: 19:35
 */

require_once 'connect.php';

$tmp = array();
$query = "select * from contest WHERE is_deleted='N' ORDER BY contest_id DESC ";
$result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link) . "\n");

while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    $obj = array(
        'Contest' => $row['title'],
        'Edit' => "<button type='button' class='btn btn-default' onclick='delContest(".$row['contest_id'].")'>删除 </button>" //这里要写一个点击之后的函数
    );
    array_push($tmp, $obj);
}

echo json_encode($tmp);