<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<style>
    .checke {
        position: relative;
        -webkit-appearance: none;
        width: 60px;
        height: 30px;
        line-height: 44px;
        background: #eee;
        border-radius: 30px;
        outline: none;
    }

    .checke:before {
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

    .checke:checked {
        background: #18ff0a;
    }

    .checke:checked:before {
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
                                <table class="table table-bordered table-striped layui-table"
                                       style="padding-right: 20px;margin-left: 20px">
                                    <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>文章名称</th>
                                        <th>评论人</th>
                                        <th>ip</th>
                                        <th>评论时间</th>
                                        <th>评论内容</th>
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
        layui.use(['layer', 'element', 'table'], function () {
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
            $.post("/backend/article/comment", pageConf, function (data) {
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
            }, "json");
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
                info += '<td>' + obj.article_name + '</td>';
                info += '<td>' + obj.user_name + '</td>';
                info += '<td>' + obj.ip + '</td>';
                info += '<td>' + timestampToTime(obj.created_at) + '</td>';
                info += '<td class="layerDemo">' + '<button data-method="offset" class="layui-btn" data-content="' + obj.comment + '">查看评论详情</button>' + '</td>';
                info += '<td style="text-align: center;"><button name="btnDelete" type="button" data-method="offset" class="layui-btn layui-btn-sm layui-btn-danger" onclick="remove(' + 'this'+','+ obj.id + ')">删除</button></td>';
                info += '</tr>';
                $("#tab_list").append(info);
            });
            layui.use('layer', function () { //独立版的layer无需执行这一句
                var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句

                //触发事件
                var active = {
                    offset: function (othis) {
                        var type = othis.data('type')
                            , text = othis.attr('data-content')
                        layer.open({
                            type: 1
                            , offset: type
                            , title: '留言详情'
                            , id: 'layerDemo' + type //防止重复弹出
                            , content: '<div style="padding: 20px 100px;">' + text + '</div>'
                            , btn: '关闭全部'
                            , btnAlign: 'c' //按钮居中
                            , shade: 0 //不显示遮罩
                            , yes: function () {
                                layer.closeAll();
                            }
                        });

                    }
                };

                $('.layerDemo .layui-btn').on('click', function () {
                    var othis = $(this), method = othis.data('method');
                    active[method] ? active[method].call(this, othis) : '';
                });
            });
        }


        function timestampToTime(timestamp) {
            var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
            var Y = date.getFullYear() + '-';
            var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
            var D = (date.getDate() < 10 ? '0' + date.getDate() : date.getDate()) + ' ';
            var h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
            var m = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
            var s = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds());
            return Y + M + D + h + m + s;
        }



        function remove(e,id) {
            var dom = e;
            $.post('/backend/article/delete-comment?id=' + id, {}, function (data) {
                if (data.code === 200) {
                    layer.msg(data.msg)
                    $(dom).parent().parent().remove();
                }
            }, 'json')
        }

    </script>
