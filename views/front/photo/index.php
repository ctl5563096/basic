<?php require __DIR__ . '/../default/header.php'; ?>
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
                <a href="http://beian.miit.gov.cn/">备案号:粤ICP备19092236号-1 如有侵权请联系作者</a>
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
    layui.use(['form', 'element'], function () {
        var element = layui.element;
        var form = layui.form;
    });

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
            url: "/front/photo/list",
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    var dom = '';
                    $.each(data.dataList.dataList, function (index, value) {
                        var upload_at = getLocalTime(value.upload_time);
                        dom += '<div class="card-body body-message border" style="margin-top: 10px;margin-bottom: 10px">';
                        dom += '<div class="card-body img" >';
                        dom += '<img data-method="notice" layer-src="/' + value.url +' " style="width: 100px;height: 100px" src="/' + value.thumb_url + '" alt="' + value.content +'">';
                        dom += '<p style="vertical-align:bottom;display: inline-block;float: right">发布于 ' + upload_at + '</p>';
                        dom += '</div>';
                        dom += '<div class="card-body" style="padding: 0;">';
                        dom += '<div class="card-body" style="letter-spacing: 1px;line-height: 1.5;text-indent:1em;padding: 0;">';
                        dom += value.content;
                        dom += '</div>';
                        dom += '</div>';
                        dom += '</div>';
                    });
                    totalPage = parseInt(data.dataList.totalPage);
                    $('.body-content').append(dom);
                }
                layer.photos({
                    photos: '.img'
                    ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
                    ,area:[800 ,800]
                    ,offset: '20px'
                    ,tab: function(pic, layero){
                        console.log(layero.children().eq(0).children('.layui-layer-phimg').css('display','inline-block'));
                        layero.children().eq(0).children('.layui-layer-phimg').css('display','flex').css('align-items', 'center').css('height', '100%')
                    }
                });
            }
        })
    });

    var flag = false;
    $(window).scroll(function () {
        if (page < totalPage) {
            if (flag) return;
            flag = true;
            page++;
            $.ajax({
                type: 'POST',
                url: "/front/photo/list?page=" + page,
                dataType: 'json',
                success: function (data) {
                    if (data.code === 200) {
                        var dom = '';
                        $.each(data.dataList.dataList, function (index, value) {
                            var upload_at = getLocalTime(value.upload_time);
                            dom += '<div class="card-body body-message border" style="margin-top: 10px;margin-bottom: 10px">';
                            dom += '<div class="card-body img">';
                            dom += '<img data-method="notice" layer-src="/' + value.url +' " style="width: 100px;height: 100px" src="/' + value.thumb_url + '" alt="' + value.content +'">';
                            dom += '<p style="vertical-align:bottom;display: inline-block;float: right">发布于 ' + upload_at + '</p>';
                            dom += '</div>';
                            dom += '<div class="card-body">';
                            dom += '<div class="card-body" style="letter-spacing: 1px;line-height: 1.5;text-indent:1em;padding: 0;">';
                            dom += value.content;
                            dom += '</div>';
                            dom += '</div>';
                            dom += '</div>';
                        });
                        $('.body-content').append(dom);
                        flag = false;
                    }
                    layer.photos({
                        photos: '.img'
                        ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
                        ,area:['800px','800px']
                        ,offset: '20px'
                        ,maxWidth:400
                        ,tab: function(pic, layero){

                        }
                    });
                }
            });
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

