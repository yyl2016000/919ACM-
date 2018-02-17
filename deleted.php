<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/19
 * Time: 19:55
 */

require_once 'connect.php';

$contestID = isset($_REQUEST['theContestID']) ? $_REQUEST['theContestID'] : "0";
if($contestID != 0){
    $query = "UPDATE contest SET is_deleted='Y' WHERE contest_id=" .$contestID;
    $result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link)."\n");
}
?>