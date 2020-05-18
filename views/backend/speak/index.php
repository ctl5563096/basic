<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;color: #0C0C0C">
        <a href=" <?php echo yii\helpers\Url::to(['backend/speak/add']); ?> ">
            <button type="button" class="layui-btn layui-btn-lg"">
            <i class="layui-icon">&#xe654;</i>
            </button>
        </a>
        <table class="layui-table" lay-filter='table'>
            <colgroup>
                <col width="200">
                <col width="200">
                <col width="200">
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>发布日期</th>
                <th>内容</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="main">
            </tbody>
        </table>
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
        $.post("/backend/speak/get-list", pageConf, function (data) {
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
        $("#main").html('');
        $.each(data.dataList, function (index, obj) {
            // id 很多时候并不是连续的，如果为了显示比较连续的记录数，可以这样根据当前页和每页条数动态的计算记录序号
            index = index + num + 1;
            var info = '';
            info += '<tr>';
            info += '<td>' + index + '</td>';
            info += '<td>' + timestampToTime(obj.created_at) + '</td>';
            info += '<td class="layerDemo">' + '<button data-method="offset" class="layui-btn" data-content="' + obj.content + '">看看说了什么</button>' + '</td>';
            info += '<td style="text-align: center;"><button name="btnDelete" type="button" data-method="offset" class="layui-btn layui-btn-sm layui-btn-danger" onclick="remove(' + 'this'+','+ obj.id + ')">删除</button></td>';
            info += '</tr>';
            $("#main").append(info);
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
        layer.confirm('确认要删除吗？', {
            btn : [ '确定', '取消' ]//按钮
        }, function(index) {

            layer.close(index);
            //此处请求后台程序，下方是成功后的前台处理……
            var dom = e;
            $.post('/backend/speak/delete?id=' + id, {}, function (data) {
                if (data.code === 200) {
                    layer.msg(data.msg)
                    $(dom).parent().parent().remove();
                }
            }, 'json')

        });
    }
</script>