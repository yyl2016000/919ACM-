<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/18
 * Time: 15:09
 */

require_once 'connect.php';

$tmp = array();
$query = "select * from approval WHERE status = 0 ORDER BY contestID";
$result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link) . "\n");

while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    $query1 = "select * from contest WHERE contest_id=".$row['contestID'];
    $result1 = mysqli_query($link,$query1);
    $contestName = mysqli_fetch_array($result1,MYSQLI_BOTH);
    $obj = array(
        'UserID' => $row['studentID'],
        'UserName' => $row['studentName'],
        'UserClass' => $row['studentClassName'],
        'UserGrade' => $row['studentGrade'],
        'UserSchool' => $row['studentSchool'],
        'TheContestName' => $contestName['title'],
        'adminApproval' => "<button type='button' class='btn btn-default' onclick=' approval(".$row['studentID'].",".$row['contestID'].") '>通过 </button>", //这里要写一个点击之后的函数
        'adminReject' => "<button type='button' class='btn btn-default' onclick='reject(".$row['studentID'].",".$row['contestID'].")'>驳回 </button>" //这里要写一个点击之后的函数
    );
    array_push($tmp, $obj);
}

echo json_encode($tmp);