<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C;margin-left: 20px;margin-top: 20px">
    <ul class="layui-timeline">
        <!--        <li class="layui-timeline-item">-->
        <!--            <i class="layui-icon layui-timeline-axis"></i>-->
        <!--            <div class="layui-timeline-content layui-text">-->
        <!--                <h3 class="layui-timeline-title">8月18日</h3>-->
        <!--                <p>-->
        <!---->
        <!--                </p>-->
        <!--            </div>-->
        <!--        </li>-->
    </ul>
    <input type="hidden" id="page" value="1">
    <input type="hidden" id="page1" value="0">
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use(['form', 'element'], function () {
        var element = layui.element;
        var form = layui.form;
    });

    $(function () {
        initList(1);

        function timeDate(creatAt) {
            var date = new Date(creatAt);
            Y = date.getFullYear() + '-';
            M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
            D = date.getDate() + ' ';
            h = date.getHours() + ':';
            m = date.getMinutes() + ':';
            s = date.getSeconds();
            return Y + M + D + h + m + s;
        }
    });
    var isIniting = false

    function initList(page) {
        if (isIniting) return;
        isIniting = true;
        $.ajax({
            type: 'POST',
            url: "/backend/photo/list?page=" + page,
            dataType: 'json',
            success: function (data) {
                isIniting = false;
                if (data.code === 200) {
                    var dom = '';
                    $.each(data.data, function (index, value) {
                        dom += '<li class="layui-timeline-item"><i class="layui-icon layui-timeline-axis"></i><div class="layui-timeline-content layui-text">';
                        dom += '<h3 class="layui-timeline-title">' + index + '</h3>'
                        $.each(value, function (i, v) {
                            dom += '<div style="display: inline-block"><img class="photo" src=/' + v.url + ' style="width:100px;height:100px;margin: 5px 0px 5px 5px;" title="' + v.content + '"><i class="layui-icon" style="vertical-align:top" onclick="deleteImg(' + v.id + ',' + 'this'+ ')">&#x1006;</i></div>'
                        });
                    });
                    var num = $('#page').val();
                    ++num
                    $('#page').val(num);
                    $('.layui-timeline').append(dom);
                    if ($('.photo').length === data.count){
                        var domFooter = '<p id="footer-content">已经到底了</p>';
                        $('.layui-timeline').append(domFooter);
                    }
                }
            },
            error: function () {
                isIniting = false;
            }
        })
    }

    // 删除图片
    function deleteImg(id,e) {
        layer.confirm('你确定要删除该图片吗', {icon: 1, title: '提示'}, function (index) {
            $.ajax({
                type: 'POST',
                url: "/backend/photo/delete?id=" + id,
                dataType: 'json',
                success: function (data) {
                    if (data.code === 200) {
                        layer.msg('删除成功',{time:1500})
                        $(e).parent().remove()
                    }
                    layer.close(index);
                },
                error: function () {
                    layer.close(index);
                }
            })
        });
    }

    $(document).on("mousewheel DOMMouseScroll", function (e) {
        var delta = (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) ||
            (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1));
        if (delta < 0) {
            var page = $('#page').val();
            if ($('#footer-content').length === 0){
                initList(page)
            }
        }
    })

</script>