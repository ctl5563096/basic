<?php require __DIR__ . '/../default/header.php'; ?>
<style>
    .hot{
        height: 100px;
    }
    .module{
        margin-top: 30px;
        margin-bottom: 50px;
    }
</style>
<body>
<div class="container main-content" style="width: 1000px;">
    <div class="row title" style="height: 60px;margin-bottom: 30px;">
        <a href="#" style="display: inline-block;width: 150px;height: 30px;font-size: 20px;text-align: center;padding-top: 25px">YYCTL</a>
        <div class="input-group" style="width: 300px;height: 32px;padding-top: 23px;margin-left: 480px">
            <input type="text" class="form-control" placeholder="搜点文章">
            <button type="button" class="btn btn-outline-secondary"><span class="glyphicon glyphicon-search"style="display: inline-block;width: 50px"></span></button>
        </div>
    </div>
    <div class="row module" style="height: 180px">
        <div class="col-sm-3 hot" >
            <a href="#" class="text-decoration-none">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
        </div>
        <div class="col-sm-3 hot">
            <a href="#">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
        </div>
        <div class="col-sm-3 hot">
            <a href="#">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
        </div>
        <div class="col-sm-3 hot">
            <a href="#">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
        </div>
    </div>
    <div >

    </div>
    <div class="row main" style="height: 1500px;padding-top: 10px;padding-left: 10px">
        <div class="col-sm-7" style="margin-right: 50px ">
            <?php foreach ($data as $v):?>
                <div>
                    <h3 style="width: 300px">
                        <?php echo $v['article_name']?>
                    </h3>
                    <h5 style="width: 400px">
                        发布时间:<?php echo date('Y-m-d H:i:s',$v['created_at'])?>&nbsp&nbsp&nbsp阅读人数: <?php echo $v['see_num']?>&nbsp&nbsp&nbsp作者: <?php echo $v['author_nickname']?>
                    </h5>
                    <div>
                        <p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 300px">
                            <?php echo $v['content']?>
                        </p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <div class="col-sm-4" style=""></div>
    </div>
</div>
<div id="footer" style="height: 80px;background-color: #ffffff;">
    <nav class="navbar navbar-default navbar-fixed-bottom" style="background-color: #ffffff">
        <div class="navbar-inner navbar-content-center">
            <p class="text-muted credit" style="text-align: center;margin-top: 10px">
                粤ICP备19092236号-1        如有侵权请联系作者
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
