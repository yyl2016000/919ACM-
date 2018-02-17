<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/16
 * Time: 16:47
 */

$adminTreeViewData = array(
    array(
        "text" => "比赛管理",
        "name" => "contestList",
        "selectable" => false,
        "nodes" => array(
            array(
                "text" => "增加比赛",
                "name" => "insertContest"
            ),
            array(
                "text" => "删除比赛",
                "name" => "deleteContest"
            )
        )),
    array(
        "text" => "审批管理",
        "name" => "nameList",
        "selectable" => false,
        "nodes" => array(
            array(
                "text" => "报名人员审批",
                "name" => "nameListApproval"
            ),
            array(
                "text" => "审批名单下载",
                "name" => "nameListDownload"
            ),
            array(
                "text" => "审批名单上传",
                "name" => "nameListUpload"
            )),
    )
);
echo json_encode($adminTreeViewData);