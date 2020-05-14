<?php require __DIR__ . '/../default/header.php'; ?>
<?php //var_dump($page);die(); ?>
<body>
<div class="container main-content" style="width: 1000px;">
    <div class="row title" style="height: 60px;margin: 30px;">
        <div class="card border-0">
            <div class="card-body">
                <button type="button" class="btn btn-default btn-sm border" onclick="backLast()">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回上一页
                </button>
            </div>
        </div>
    </div>
    <h2 style="text-align: center">生 活 圈 子</h2>
    <div class="body-content border border-0  card" style="margin: 30px;">
    </div>
</div>
、
<div id="footer" class="border border-0" style="height: 80px;background-color: #ffffff;">
    <nav class="navbar navbar-default navbar-fixed-bottom border border-0" style="background-color: #ffffff">
        <div class="navbar-inner navbar-content-center">
            <p class="text-muted credit" style="text-align: center;margin-top: 10px">
                粤ICP备19092236号-1 如有侵权请联系作者
            </p>
            <p class="text-muted credit" style="text-align: center">
                网站地址:www.ctllys.top
            </p>
            <p class="text-muted credit" style="text-align: center">
                作者邮箱:chentulinys@163.com
            </p>
        </div>
    </nav>
</div>
</body>
</html>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    var page = 1;
    var totalPage;

    // 返回上一页
    function backLast() {
        window.history.back();
    }

    // 时间戳装换时间类型
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
    }


    $(function () {
        $.ajax({
            type: 'POST',
            url: "/front/message/get-list",
            dataType: 'json',
            success: function (data) {
                if (data.code == 200) {
                    var dom = '';
                    $.each(data.dataList.dataList, function (index, value) {
                        var date = new Date(parseInt(value.created_at));
                        Y = date.getFullYear() + '-';
                        M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
                        D = date.getDate() + ' ';
                        h = date.getHours() + ':';
                        m = date.getMinutes() + ':';
                        s = date.getSeconds();
                        dom += '<div class="card-body body-message border" style="margin-top: 10px;margin-bottom: 10px">';
                        dom += '<div class="card-body"><span class="label label-info">热 心 伙 伴</span>  &nbsp;&nbsp;&nbsp;';
                        dom += value.name;
                        dom += ' 在 ' + Y + M + D + h + m + s + '时,在博客留下了痕迹';
                        dom += '</div>';
                        dom += '<div class="card-body"><span class="label label-primary">留 言 内 容</span>';
                        dom += '<div class="card-body" style="letter-spacing: 1px;line-height: 1.5;text-indent:2em">';
                        dom += value.content;
                        dom += '</div>';
                        dom += '</div>';
                        dom += '<div class="card-body"><span class="label label-success">博 主 回 复</span>';
                        dom += '<div class="card-body" style="letter-spacing: 1px;line-height: 1.5;text-indent:2em">';
                        if (value.reply_content === '') {
                            dom += '暂无回复,博主看到消息会第一时间回复你~!';
                        } else {
                            dom += value.reply_content;
                        }
                        dom += '</div>';
                        dom += '</div>';
                        dom += '</div>';
                    });
                    totalPage = parseInt(data.dataList.totalPage);
                    $('.body-content').append(dom);
                }
            }
        })
    });

    $(window).scroll(function (e) {
        console.log(page)
        console.log(totalPage)
        if (page < totalPage) {
            page++;
            setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    url: "/front/message/get-list?page=" + page,
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 200) {
                            var dom = '';
                            $.each(data.dataList.dataList, function (index, value) {
                                var date = new Date(parseInt(value.created_at));
                                Y = date.getFullYear() + '-';
                                M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
                                D = date.getDate() + ' ';
                                h = date.getHours() + ':';
                                m = date.getMinutes() + ':';
                                s = date.getSeconds();
                                dom += '<div class="card-body body-message border" style="margin-top: 10px;margin-bottom: 10px">';
                                dom += '<div class="card-body"><span class="label label-info">热 心 伙 伴</span>  &nbsp;&nbsp;&nbsp;';
                                dom += value.name;
                                dom += ' 在 ' + Y + M + D + h + m + s + '时,在博客留下了痕迹';
                                dom += '</div>';
                                dom += '<div class="card-body"><span class="label label-primary">留 言 内 容</span>';
                                dom += '<div class="card-body" style="letter-spacing: 1px;line-height: 1.5;text-indent:2em">';
                                dom += value.content;
                                dom += '</div>';
                                dom += '</div>';
                                dom += '<div class="card-body"><span class="label label-success">博 主 回 复</span>';
                                dom += '<div class="card-body" style="letter-spacing: 1px;line-height: 1.5;text-indent:2em">';
                                if (value.reply_content === '') {
                                    dom += '暂无回复,博主看到消息会第一时间回复你~!';
                                } else {
                                    dom += value.reply_content;
                                }
                                dom += '</div>';
                                dom += '</div>';
                                dom += '</div>';
                            });
                            $('.body-content').append(dom);
                        }
                    }
                })
            }, 1500);
        } else if (page === totalPage) {
            page++;
            $(document).ajaxStop(function () {
                var dom = '';
                dom += '<div class="card-body" style="text-align: center">已经到底啦~！';
                dom += '</div>';
                $('.body-content').append(dom);
            });
        }
    })
</script>
