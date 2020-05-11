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
    <div>
        <button name="btnModify" type="button" class="layui-btn" style="float: right;margin: 10px" onclick="addNew()">
            添加新文章
        </button>
    </div>
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
                info += '<td class="layerDemo" data-content="' + obj.id + '">' + '<button data-method="offset" data-type="auto" class="layui-btn layui-btn-normal" data-content="' + obj.content  +'">查看留言详情</button>' + '</td>';
                info += '<td>' + obj.name + '</td>';
                if (parseInt(obj.is_read) === 1) {
                    info += '<td>' + '<input type="checkbox" class="checke" checked onclick="changeStatus(' + obj.id + ')">' + '</td>';
                } else {
                    info += '<td>' + '<input type="checkbox" class="checke" onclick="changeStatus(' + obj.id + ')">' + '</td>';
                }
                if (parseInt(obj.is_read) === 1) {
                    info += '<td>' + '<input type="checkbox" class="checke" checked onclick="changeStatus(' + obj.id + ')">' + '</td>';
                } else {
                    info += '<td>' + '<input type="checkbox" class="checke" onclick="changeStatus(' + obj.id + ')">' + '</td>';
                }
                if (obj.mail === ''){
                    info += '<td> 无邮箱</td>';
                }else {
                    info += '<td>' + obj.mail + '</td>';
                }
                if (obj.phone === ''){
                    info += '<td> 无电话号码</td>';
                }else {
                    info += '<td>' + obj.phone + '</td>';
                }
                info += '<td>' + timestampToTime(obj.created_at) + '</td>';
                if (obj.reply_time === null){
                    info += '<td> 无回复</td>';
                }else {
                    info += '<td>' + timestampToTime(obj.reply_time) + '</td>';
                }
                if (obj.reply_content === ''){
                    info += '<td> 无回复内容</td>';
                }else {
                    info += '<td>' + '<button data-method="notice" class="layui-btn" onclick="artDetail(' + obj.id + ')">查看回复详情</button>' + '</td>';
                }
                info += '<td style="text-align: center;"><button name="btnModify" type="button" class="layui-btn layui-btn-sm" onclick="update(' + obj.id + ')">回复</button><button name="btnDelete" type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="remove(' + obj.id + ')">删除</button></td>';
                info += '</tr>';
                $("#tab_list").append(info);
            });
            layui.use('layer', function(){ //独立版的layer无需执行这一句
                var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句

                //触发事件
                var active = {
                    setTop: function(){
                        var that = this;
                        //多窗口模式，层叠置顶
                        layer.open({
                            type: 2 //此处以iframe举例
                            ,title: '当你选择该窗体时，即会在最顶端'
                            ,area: ['390px', '260px']
                            ,shade: 0
                            ,maxmin: true
                            ,offset: [ //为了演示，随机坐标
                                Math.random()*($(window).height()-300)
                                ,Math.random()*($(window).width()-390)
                            ]
                            ,content: '//layer.layui.com/test/settop.html'
                            ,btn: ['继续弹出', '全部关闭'] //只是为了演示
                            ,yes: function(){
                                $(that).click();
                            }
                            ,btn2: function(){
                                layer.closeAll();
                            }

                            ,zIndex: layer.zIndex //重点1
                            ,success: function(layero){
                                layer.setTop(layero); //重点2
                            }
                        });
                    }
                    ,offset: function(othis){
                        var type = othis.data('type')
                            ,text = othis.attr('data-content')
                        layer.open({
                            type: 1
                            ,offset: type //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                            ,id: 'layerDemo'+type //防止重复弹出
                            ,content: '<div style="padding: 20px 100px;">'+ text +'</div>'
                            ,btn: '关闭全部'
                            ,btnAlign: 'c' //按钮居中
                            ,shade: 0 //不显示遮罩
                            ,yes: function(){
                                layer.closeAll();
                            }
                        });

                    }
                };
                $('.layerDemo .layui-btn').on('click', function(){
                    var id = $(this).parent().attr('data-content')
                    $.get('/backend/message-board/change-read?id=' + id , function(res){
                        alert(1111111)
                        return
                    });
                    var othis = $(this), method = othis.data('method');
                    active[method] ? active[method].call(this, othis) : '';
                });
            });
        }

        function artDetail(id) {
            window.open('content?id=' + id, '文章详情', 'height=600, width=600, top=100, left=600, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no')
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

        function remove(id) {
            $.post('/backend/article/delete?id=' + id, {}, function (data) {
                if (data.code === 200) {
                    layer.msg(data.msg, {time: 1500}, function () {
                        window.location.href = '/backend/article/index'
                    });
                }
            }, 'json')
        }

        function update(id) {
            window.location.href = '/backend/article/detail?id=' + id;
        }
    </script>
    <script>

    </script>