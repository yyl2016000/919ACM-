<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/18
 * Time: 20:57
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
        'Upload' => "<form  enctype='multipart/form-data' target=\"id_iframe\" name=\"form\" method=\"post\" action=\"uploadfile-localhost.php\">
                             <table colspan=2>
                              <td>
                              <input style='  margin:0px 0cm 0cm 3cm;'name='myFile' type='file'/></td>
                              <td>
                               <div class='row col-sm-12 '>
                                <button  class='btn btn-default col-sm-4 col-sm-push-1 text-center' type='submit' name='submit' >提交</button>
                                <button onclick='txt2list(".$row['contestID'].")' class='btn btn-default col-sm-8 col-sm-push-2 text-center'>导入数据库</button>
                               </div>
                              </td>
                             </table>
                        </form>
                        <iframe id=\"id_iframe\" name=\"id_iframe\" style=\"display:none;\"></iframe>  
 "
    );
    //style='  margin:5px 10cm 0cm 0cm;'
    setcookie('mycookie',$row['contestID']);
    array_push($id, $obj);
}

echo json_encode($id);