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
    <form class="layui-form">
        <div class="layui-form-item" style="margin-top: 10px">
            <label class="layui-form-label" style="width: 110px;padding-right: 5px">请选择筛选条件 :</label>
            <div class="layui-inline">
                <div class="layui-input-inline" style="width: 150px;">
                    <select name="is_ready" id="searchRead">
                        <option value="">请选择已读状态</option>
                        <option value="1">已读</option>
                        <option value="0">未读</option>
                        <option value="">全部</option>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline" style="width: 150px;margin-right: 0px;">
                    <select name="is_reply" id="searchReply">
                        <option value="">请选择回复状态</option>
                        <option value="1">已回</option>
                        <option value="0">未回</option>
                        <option value="">全部</option>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label" style="padding:9px 0px;text-align: center;">留言人:</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="name" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                    <button type="button" class="layui-btn" onclick="initLayPage()">搜索</button>
            </div>
        </div>
    </form>
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
                                        <th>留言内容</th>
                                        <th>留言人</th>
                                        <th>是否已读</th>
                                        <th>是否回复</th>
                                        <th>邮箱</th>
                                        <th>手机号码</th>
                                        <th>留言时间</th>
                                        <th>回复时间</th>
                                        <th>回复内容</th>
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
        layui.use(['form','layer', 'element', 'table'], function () {
            var form = layui.form
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
                pageConf.is_read = $("#searchRead").val();
                pageConf.is_reply = $("#searchReply").val();
                pageConf.name = $("input[name='name']").val();
                pageConf.pageSize = 10;
                pageConf.page = 1;
            }
            $.post("/backend/message-board/list", pageConf, function (data) {
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
                info += '<td class="layerDemo" data-content="' + obj.id + '">' + '<button data-method="offset" data-type="auto" class="layui-btn layui-btn-normal" data-content="' + obj.content + '">查看留言详情</button>' + '</td>';
                info += '<td>' + obj.name + '</td>';
                if (parseInt(obj.is_read) === 1) {
                    info += '<td>' + '<input type="checkbox" class="checke" checked onclick="changeStatus(' + obj.id + ')">' + '</td>';
                } else {
                    info += '<td>' + '<input type="checkbox" class="checke" onclick="changeStatus(' + obj.id + ')">' + '</td>';
                }
                if (parseInt(obj.is_reply) === 1) {
                    info += '<td>' + '<input type="checkbox" class="checke" checked onclick="changeStatus(' + obj.id + ')">' + '</td>';
                } else {
                    info += '<td>' + '<input type="checkbox" class="checke" onclick="changeStatus(' + obj.id + ')">' + '</td>';
                }
                if (obj.mail === '') {
                    info += '<td> 无邮箱</td>';
                } else {
                    info += '<td>' + obj.mail + '</td>';
                }
                if (obj.phone === '') {
                    info += '<td> 无电话号码</td>';
                } else {
                    info += '<td>' + obj.phone + '</td>';
                }
                info += '<td>' + timestampToTime(obj.created_at) + '</td>';
                if (obj.reply_time === null) {
                    info += '<td> 无回复</td>';
                } else {
                    info += '<td>' + timestampToTime(obj.reply_time) + '</td>';
                }
                if (obj.reply_content === '') {
                    info += '<td class="layerDemo1">无回复内容</td>';
                } else {
                    info += '<td class="layerDemo1">' + '<button data-method="offset" class="layui-btn" data-content="' + obj.reply_content + '">查看回复详情</button>' + '</td>';
                }
                if (obj.reply_content === '') {
                    info += '<td class="reply" style="text-align: center;"><button name="btnModify" type="button" data-method="notice" class="layui-btn layui-btn-sm" data-content="' + obj.id + '">回复</button><button name="btnDelete" type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="remove(' + 'this' + ',' + obj.id + ')">删除</button></td>';
                } else {
                    info += '<td class="reply" style="text-align: center;"><button name="btnModify" type="button" class="layui-btn layui-btn-disabled layui-btn-sm" data-content="' + obj.id + '">回复</button><button name="btnDelete" type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="remove(' + 'this' + ',' + obj.id + ')">删除</button></td>';
                }
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

                //触发事件
                var active1 = {
                    offset: function (othis) {
                        var type = othis.data('type')
                            , text = othis.attr('data-content')
                        layer.open({
                            type: 1
                            , offset: type
                            , title: '回复信息'
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

                //触发事件
                var active2 = {
                    notice: function (othis) {
                        var id = othis.attr('data-content');
                        //示范一个公告层
                        layer.open({
                            type: 1
                            ,
                            title: false //不显示标题栏
                            ,
                            closeBtn: false
                            ,
                            area: '400px;'
                            ,
                            shade: 0.8
                            ,
                            id: 'LAY_layuipro' //设定一个id，防止重复弹出
                            ,
                            btn: ['回复', '退出']
                            ,
                            btnAlign: 'c'
                            ,
                            moveType: 1 //拖拽模式，0或者1
                            ,
                            content: '<div style="padding: 30px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
                                '<br>回复内容<br>' +
                                '<textarea placeholder="请输入回复内容" class="layui-textarea-' + id + '"  name="desc" style="margin-top: 10px;height: 100px;width: 300px;"></textarea>' +
                                '</div>'
                            ,
                            success: function (layero) {
                            }
                            ,
                            yes: function (index, layero) {
                                var class_name = '.layui-textarea-' + id;
                                var content = $(class_name).val()
                                if (content === '') {
                                    layer.msg('请输入回复内容', {
                                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                    });
                                    return false
                                }
                                $.ajax({
                                    type: 'POST',
                                    url: '/backend/message-board/reply?id=' + id,
                                    data: {content: content},
                                    dataType: 'json',
                                    success: function (res) {
                                        if (res.code === 200) {
                                            layer.msg(res.msg, {
                                                time: 2000
                                            });
                                            $(othis).off('click')
                                            othis.attr('class','layui-btn layui-btn-disabled layui-btn-sm');
                                            othis.parent().parent().children().eq(9).html('');
                                            $(othis.parent().parent().children().eq(9)).append('<button data-method="offset" class="layui-btn" data-content="' + res.content + '">查看回复详情</button>');
                                            $(othis.parent().parent().children().eq(4)).children('.checke').prop("checked",true)
                                            // 重新绑定元素
                                            $('.layerDemo1 .layui-btn').on('click', function () {
                                                var othis = $(this), method = othis.data('method');
                                                active1[method] ? active1[method].call(this, othis) : '';
                                            });
                                            setTimeout(function () {
                                                layer.close(index); //如果设定了yes回调，需进行手工关闭
                                            }, 1500)
                                        } else {
                                            layer.msg(res.msg);
                                        }
                                    }
                                });
                            }
                        });
                    }
                };

                $('.layerDemo .layui-btn').on('click', function () {
                    var id = $(this).parent().attr('data-content')
                    var dom = $(this).parent().parent().children('td').eq(3).children('.checke');
                    $.get('/backend/message-board/change-read?id=' + id, function (res) {
                        if (res.code === 200) {
                            dom.prop("checked", true);
                        }
                    }, 'json');
                    var othis = $(this), method = othis.data('method');
                    active[method] ? active[method].call(this, othis) : '';
                });

                $('.layerDemo1 .layui-btn').on('click', function () {
                    var othis = $(this), method = othis.data('method');
                    active1[method] ? active1[method].call(this, othis) : '';
                });

                $('.reply .layui-btn').on('click', function () {
                    var othis = $(this), method = othis.data('method');
                    active2[method] ? active2[method].call(this, othis) : '';
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

        function addNew() {
            window.location.href = '/backend/article/add'
        }

        function changeStatus(id) {
            $.post('/backend/article/change-status?id=' + id, {}, function (data) {

            }, 'json')
        }

        function remove(e, id) {
            var dom = e;
            $.post('/backend/message-board/delete?id=' + id, {}, function (data) {
                if (data.code === 200) {
                    layer.msg(data.msg)
                    $(dom).parent().parent().remove();
                }
            }, 'json')
        }

        function update(id) {
            window.location.href = '/backend/article/detail?id=' + id;
        }
    </script>
    <script>

    </script>