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
    <h2 style="text-align: center">查 看 更 多</h2>
    <div class="body-content border border-0  card" style="margin: 30px;">
        暂无开发
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
    // 返回上一页
    function backLast() {
        window.history.back();
    }
</script>

