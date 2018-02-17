<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/16
 * Time: 16:40
 */
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/button.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='css/bootstrap-treeview.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/bootstrap-table.min.css'/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-switch.css">
    <script src="Script/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src='Script/bootstrap-treeview.min.js' type='text/javascript'></script>
    <script src='Script/bootstrap-table.min.js' type='text/javascript'></script>
    <script src="js/bootstrap-switch.js" type="text/javascript"></script>
    <script src="js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="js/bootstrap-datetimepicker.zh-CN.js" type="text/javascript" charset="UTF-8"></script>

    <title>ACM报名后台审批</title>

</head>

<body>
    <script language="JavaScript">
        var adminTreeViewData;

        function allHide() {
            $('#nameListDownLoad').hide();
            $('#nameListUpload').hide();
            $('#nameListApproval').hide();
            $('#contestInsert').hide();
        }


        function delContest(ContestID) {
            $.post('deleted.php',{theContestID:ContestID},function () {
                $('#deleteContestList').bootstrapTable('refresh', {url: 'adminContestDeletePost'});
                }
            )
        }

        function approval(StudentID,ContestID) {
            $.post('adminApproval.php',{theStudentID:StudentID , theContestID:ContestID},function () {
                $('#approvalNameList').bootstrapTable('refresh', {url: 'adminOperate'});
            });
        }

        function reject(StudentID,ContestID) {

            var reasons=prompt("请输入驳回理由:",""); // 弹出input框
            if (reasons==0){
                alert("尚未填写驳回理由!");
            }else {
                $.post('adminReject.php',{theStudentID:StudentID , theContestID:ContestID ,theMessage:reasons},function () {
                    $('#approvalNameList').bootstrapTable('refresh', {url: 'adminOperate'});
                });
            }
        }

        function list2txt(ContestID) {
            $.post('downloads/daochu.php',{theContestID:ContestID},function () {
                var a = document.createElement('a');
                a.href = "downloads/"+"contest" + ContestID;
                a.download = "contest" + ContestID;
                a.click();
            });
        }

        function txt2list(ContestID) {
            $.post('daoru.php',{theContestID:ContestID},function () {
            });
            $('#uploadNameList').bootstrapTable('refresh', {url: 'Upload'});
            alert("导入成功!");
        }

        $(function () {
            $.post('adminTreeViewDataPost.php', {}, function (data) {
                adminTreeViewData = JSON.parse(data);
                $('#adminTreeView').treeview({
                    data: adminTreeViewData,
                    levels: 2,
                    onNodeSelected: function (event, node) {
                        allHide();
                        if (node.name == "insertContest") {
                            $('#contestInsert').show();
                            $('#contestDelete').hide();
                            $('#nameListDownload').hide();
                            $('#nameListUpload').hide();
                            $('#nameListApproval').hide();
                            $("#contestCreateContest-startTime").datetimepicker({
                                format: "yyyy-mm-dd hh:ii:00",
                                weekStart: 1,
                                todayBtn: 1,
                                autoclose: true,
                                todayHighlight: 1,
                                startView: 2,
                                forceParse: 0,
                                showMeridian: 1,
                                initialDate: new Date(),
                                language:"zh-CN"
                            });
                            $("#contestCreateContest-endTime").datetimepicker({
                                format: "yyyy-mm-dd hh:ii:00",
                                weekStart: 1,
                                todayBtn: 1,
                                autoclose: true,
                                todayHighlight: 1,
                                startView: 2,
                                forceParse: 0,
                                showMeridian: 1,
                                initialDate: new Date(),
                                language:"zh-CN"
                            });
                        }
                        if (node.name == "deleteContest") {
                            $('#contestInsert').hide();
                            $('#contestDelete').show();
                            $('#nameListDownload').hide();
                            $('#nameListUpload').hide();
                            $('#nameListApproval').hide();
                            $('#deleteContestList').bootstrapTable('refresh', {url: 'adminContestDeletePost'});
                        }
                        if (node.name == "nameListApproval") {
                            $('#contestInsert').hide();
                            $('#contestDelete').hide();
                            $('#nameListDownload').hide();
                            $('#nameListUpload').hide();
                            $('#nameListApproval').show();
                            $('#approvalNameList').bootstrapTable('refresh', {url: 'adminOperate'});
                        }
                        if (node.name == "nameListDownload") {
                            $('#contestInsert').hide();
                            $('#contestDelete').hide();
                            $('#nameListUpload').hide();
                            $('#nameListApproval').hide();
                            $('#nameListDownload').show();
                            $('#downloadNameList').bootstrapTable('refresh', {url: 'Download'});
                        }
                        if (node.name == "nameListUpload") {
                            $('#contestInsert').hide();
                            $('#contestDelete').hide();
                            $('#nameListDownload').hide();
                            $('#nameListApproval').hide();
                            $('#nameListUpload').show();
                            $('#uploadNameList').bootstrapTable('refresh', {url: 'Upload'});
                        }
                    }
                    });
                });


            $('#listSubmit').click(function () {
                $.post('adminContestCreatePost.php',{
                        theContestName : $('#aContestName').val(),
                        startTime : $('#contestCreateContest-startTime').val(),
                        endTime : $('#contestCreateContest-endTime').val()
                    },
                    function () {
                    //
                    }
                );
            });

            $('#deleteContestList').bootstrapTable({
                //height: 700,
                classes: 'table table-striped table-condensed table-hover',
                method: 'get',
                columns: [{
                    field: 'Contest',
                    title: '比赛名称',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'Edit',
                    title: '删除',
                    align: 'center',
                    valign: 'middle'
                }
                ],
                pagination: true,
                sidePagination: 'client',
                pageSize: 15
            });

            $('#approvalNameList').bootstrapTable({
                //height: 700,
                classes: 'table table-striped table-condensed table-hover',
                method: 'get',
                columns: [{
                    field: 'UserID',
                    title: '学生学号',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'UserName',
                    title: '学生姓名',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'UserClass',
                    title: '专业班级',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'UserGrade',
                    title: '年级',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'UserSchool',
                    title: '学校',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'TheContestName',
                    title: '所报比赛名称',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'adminApproval',
                    title: '通过',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'adminReject',
                    title: '驳回',
                    align: 'center',
                    valign: 'middle'
                }
                ],
                pagination: true,
                sidePagination: 'client',
                pageSize: 15
            });

            $('#downloadNameList').bootstrapTable({
                //height: 700,
                classes: 'table table-striped table-condensed table-hover',
                method: 'get',
                columns: [{
                    field: 'Contest',
                    title: '比赛名称',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'Number',
                    title: '报名人数',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'Print',
                    title: '下载名单',
                    align: 'center',
                    valign: 'middle'
                }
                ],
                pagination: true,
                sidePagination: 'client',
                pageSize: 15
            });

            $('#uploadNameList').bootstrapTable({
                //height: 700,
                classes: 'table table-striped table-condensed table-hover',
                method: 'get',
                columns: [{
                    field: 'Contest',
                    title: '比赛名称',
                    align: 'center',
                    valign: 'middle'
                },{
                    field: 'Upload',
                    title: '上传名单',
                    align: 'center',
                    valign: 'middle'
                }
                ],
                pagination: true,
                sidePagination: 'client',
                pageSize: 15
            });


        });
    </script>
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12 col-sm-offset-1'>
                <img src='logo.png' class='img-responsive center-block' style="display: inline">
            </div>
        </div>
    </div>
    <!------------------以上的是左半边的内容----------------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-pull-1">
                <div class="clearfix" style="margin-bottom: 70px;"></div>
                <div id="adminTreeView" class="row">
                </div>
            </div>
            <div class="col-sm-9 col-sm-pull-1">
                <div id="" class="well well-sm text-center"><label style="font-size: 24px" id="adminTitle">管理界面</label>
                </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
                <div id="contestInsert" style="display: none">
                        <div class="clearfix" style="margin-bottom: 30px;"></div>
                        <form action="" method="post">
                            <label for="contestName" class="col-sm-2 text-right ">比赛名称:</label>
                            <input class="col-sm-7" id="aContestName" type="text" name="theContestName">
                            <div class="clearfix" style="margin-bottom: 30px;"></div>
                            <div class="row row-margin-bottom">
                                <label for="contestCreateContest-startTime" class="col-sm-2 text-right">比赛开始时间：</label>
                                <div class="col-sm-10">
                                    <div class="input-group date form_datetime">
                                        <input id="contestCreateContest-startTime" class="form-control" size="16" type="text"
                                               value="" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix" style="margin-bottom: 30px;"></div>
                            <div class="row row-margin-bottom">
                                <label for="contestCreateContest-endTime" class="col-sm-2 text-right">比赛结束时间：</label>
                                <div class="col-sm-10">
                                    <div class="input-group date form_datetime">
                                        <input id="contestCreateContest-endTime" class="form-control" size="16" type="text"
                                               value=""
                                               readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix" style="margin-bottom: 30px;"></div>
                            <button class="btn btn-default col-sm-2 col-sm-offset-5" id="listSubmit">提交</button>
                        </form>
                </div>

                <div id="contestDelete" style="display: none">
                    <table id="deleteContestList">
                    </table>
                </div>

                <div id="nameListApproval" style="display: none">
                    <table id="approvalNameList">
                    </table>
                </div>

                <div id="nameListDownload" style="display: none">
                    <table id="downloadNameList">
                    </table>
                </div>

                <div id="nameListUpload" style="display: none">
                    <table id="uploadNameList">
                    </table>
                </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
            </div>
        </div>
    </div>
</body>
