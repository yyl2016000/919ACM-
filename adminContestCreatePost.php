<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/19
 * Time: 18:45
 */

//header("Content-Type: text/html; charset=UTF-8");

require_once 'connect.php';

$contestName = isset($_POST['theContestName']) ? $_POST['theContestName'] : "";
$startTime = isset($_POST['startTime']) ? $_POST['startTime'] : "";
$endTime = isset($_POST['endTime']) ? $_POST['endTime'] : "";

if ($contestName != ""){
    $query = "INSERT INTO contest (
                            title,
                            type,
                            start_time,
                            end_time
                        )
                        VALUES
                            (
                                '" . $contestName . "',
                                'CONTEST',
                                '".$startTime."',
                                '".$endTime."'
                            )";
    $result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link) . "\n");
    echo "<script>alert('插入成功!')</script>";
}
else{
    echo "<script>alert('插入失败!')</script>";
}
?>
