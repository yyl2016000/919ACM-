<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/18
 * Time: 15:44
 */

require_once 'connect.php';

$studentID = isset($_REQUEST['theStudentID']) ? $_REQUEST['theStudentID'] : "0";
$contestID = isset($_REQUEST['theContestID']) ? $_REQUEST['theContestID'] : "0";
if($studentID != 0 && $contestID != 0){
    $query = "UPDATE approval SET status='1' WHERE studentID=" . $studentID ." AND contestID=" . $contestID;
    $result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link)."\n");
}

?>