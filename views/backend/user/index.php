<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<style>
    .checke{
        position: relative;
        -webkit-appearance: none;
        width:60px;
        height: 30px;
        line-height: 44px;
        background: #eee;
        border-radius: 30px;
        outline: none;
    }
    .checke:before{
        position: absolute;
        left: 0;
        content: '';
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #eee;
        box-shadow: 0px 0px 5px #ddd;
        transition: all 0.2s linear;
    }

    .checke:checked{
        background: #18ff0a;
    }
    .checke:checked:before{
        left: 30px;
        transition: all 0.2s linear;
    }
</style>
<div class="layui-body" style="color: #0C0C0C">
    <div class="container content">
        <div class="row">
            <div>
                <div class="panel panel-green margin-bottom-40">
                    <div class="panel-body">
                        <div>
                            <div>
                                <table class="table table-bordered table-striped layui-table">
                                    <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>用户名</th>
                                        <th>手机号码</th>
                                        <th>角色</th>
                                        <th>是否启用</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <!-- 表格数据加载 -->
                                    <tbody id="tab_list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 存放分页的容器 -->
        <div id="layui"></div>
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use(['layer' , 'element' , 'table'], function(){
        var element = layui.element;
        var $ = layui.jquery, layer = layui.layer;
        var table = layui.table;
    });
    $(function () {
        initLayPage();
    });

    /**
     * 初始化layui分页
     */

    function initLayPage(pageConf) {
        if (!pageConf) {
            pageConf = {};
            pageConf.pageSize = 5;
            pageConf.page = 1;

        }
        $.post("/backend/user/index", pageConf, function (data) {
            layui.use(['laypage', 'layer'], function () {
                var page = layui.laypage;
                page.render({
                    elem: 'layui',
                    count: data.list.totalCount,
                    curr: pageConf.page,
                    limit: pageConf.pageSize,
                    first: "首页",
                    last: "尾页",
                    layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],
                    jump: function (obj, first) {
                        if (!first) {
                            pageConf.page = obj.curr;
                            pageConf.pageSize = obj.limit;
                            initLayPage(pageConf);
                        }
                    }
                });
                fillTable(data.list, (pageConf.page - 1) * pageConf.pageSize); //页面填充
            })
        },"json");
    }
    //填充表格数据
    function fillTable(data, num) {
        $("#tab_list").html('');
        $.each(data.dataList, function (index, obj) {
            // id 很多时候并不是连续的，如果为了显示比较连续的记录数，可以这样根据当前页和每页条数动态的计算记录序号
            index = index + num + 1;
            var info = '';
            info += '<tr>';
            info += '<td>' + index + '</td>';
            info += '<td>' + obj.username + '</td>';
            info += '<td>' + obj.phonenumber + '</td>';
            info += '<td>' + obj.role_name + '</td>';
            if (obj.is_use === 'yes'){
                info += '<td>' + '<input type="checkbox" class="checke" checked onclick="changeStatus(' +obj.id + ')">' + '</td>';
            }else {
                info += '<td>' + '<input type="checkbox" class="checke" onclick="changeStatus(' +obj.id + ')">' + '</td>';
            }
            info += '<td style="text-align: center;"><button name="btnModify" type="button" class="btn btn-success btn-xs" >修改</button><button name="btnDelete" type="button" class="btn btn-danger btn-xs" onclick="remove(' + obj.id + ')">删除</button></td>';
            info += '</tr>';
            $("#tab_list").append(info);
        });
    }
    // 改变用户启用状态
    function changeStatus(id) {
        $.post('/backend/user/change-status?id=' + id,{},function (data) {

        },'json')
    }
</script>