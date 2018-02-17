<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/18
 * Time: 19:06
 */

require_once 'connect.php';

$studentID = isset($_REQUEST['theStudentID']) ? $_REQUEST['theStudentID'] : "";
$contestID = isset($_REQUEST['theContestID']) ? $_REQUEST['theContestID'] : "";
$theReason = isset($_REQUEST['theMessage']) ? $_REQUEST['theMessage'] : "";

if($theReason){
    if($studentID != 0 && $contestID != 0){
        $query = "UPDATE approval SET status='2' , message='". $theReason ."' WHERE studentID=" . $studentID ." AND contestID=" . $contestID;
        $result = mysqli_query($link, $query) or die("Error Message:" . mysqli_error($link)."\n");
    }
}

else{
    echo "失败,没有填写驳回理由";
}

?>

