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
            <input type="text" class="form-control" placeholder="搜点文章" style="height: 30px">
            <button type="button" class="btn btn-outline-secondary" style="height: 30px;width: 80px"><span class="glyphicon glyphicon-search"style="display: inline-block;"></span></button>
        </div>
    </div>
    <div class="row module" style="height: 180px">
        <div class="col-sm-3 hot" >
            <a href="#" class="text-decoration-none">
                <img src="/header/php.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="#"><strong style="font-family: 'Microsoft YaHei UI'">P H P 代 码 录</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="#">
                <img src="/header/mysql.jpg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="#"><strong style="font-family: 'Microsoft YaHei UI'">mysql</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="#">
                <img src="/header/system.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="#"><strong style="font-family: 'Microsoft YaHei UI'">操作系统</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="blog">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="blog"><strong style="font-family: 'Microsoft YaHei UI'">博 主 介 绍</strong></a></h4>
        </div>
    </div>
    <div >

    </div>
    <div class="row main" style="height: 1500px;padding-top: 10px;padding-left: 10px">
        <div class="col-sm-7 border border-left-0 border-bottom-0 border-top-0 " style="margin-right: 50px ">
            <?php foreach ($data as $v):?>
                <div style="margin-top:20px;padding-bottom: 30px" class="article border border-left-0 border-right-0 border-top-0" style="width: 545px;height: 415px">
                    <h3 style="width: 300px;margin-bottom: 15px">
                        <strong><?php echo $v['article_name']?></strong>
                    </h3>
                    <div style="margin-bottom: 15px">
                        <?php $label = explode(',',$v['label']) ?>
                        <?php foreach ($label as $item): ?>
                            <span class="label label-primary"><?php echo $item ?></span>
                        <?php endforeach;?>
                    </div>
                    <h5 style="width: 400px">
                        发布时间:<?php echo date('Y-m-d H:i:s',$v['created_at'])?>&nbsp&nbsp&nbsp阅读人数: <?php echo $v['see_num']?>&nbsp&nbsp&nbsp作者: <?php echo $v['author_nickname']?>
                    </h5>
                    <div>
                        <div class="text">
                            <?php echo $v['introduction']?>
                        </div>
                    </div>
                    <br>
                    <div style="padding-bottom: 10px">
                        <button type="button" class="btn btn-primary" style="float: left"  onclick="detail(<?php echo $v['id'] ?>)">查看详情</button>
                        <button type="button" class="btn btn-danger" style="float: right;width: 40px" onclick="hate(<?php echo $v['id']?>)">踩</button>
                        <button type="button" class="btn btn-success" style="float: right;width: 40px;margin-right: 10px" onclick="like(<?php echo $v['id']?>)">点赞</button>
                    </div>
                </div>
            <br>
            <?php endforeach;?>
        </div>
        <div class="col-sm-4 border border-right-2" style="">
                <H3 style="padding-bottom: 5px;margin-top: 5px" class="border border-right-0 border-top-0 border-left-0">
                    <strong style="font-family: 'Microsoft YaHei UI'">
                        关于博主
                    </strong>
                </H3>
                <div style="margin-top: 10px">
                    <img src="/header/blog.jpg" class="rounded" style="width: 50px" alt="YYCTL">&nbsp;&nbsp;&nbsp;YYCTL
                </div>
                <h3 style="margin-top: 10px">每 日 吐 槽</h3>
                <div class="card" style="margin-top: 10px">
                    <div class="card-body">总想吐槽点什么东西</div>
                    <p class="card-body" style="text-align: right">发布于--<?php echo date('Y-m-d') ?></p>
                </div>
                <h3 style="margin-top: 10px">个 人 经 历</h3>
                <div class="card" style="margin-top: 10px">
                    <div class="card-body">点过去看看吧<button type="button" class="btn btn-primary" style="float: right" onclick="personal()">MORE-></button></div>
                </div>
                <h3 style="margin-top: 10px">座 右 铭</h3>
                <div class="card border border-right-0 border-top-0 border-left-0" style="margin-top: 10px" >
                    <div class="card-body">
                       人生路漫漫长,任重而道远
                    </div>
                </div>
                <h3 style="margin-top: 5px">热点排行</h3>
                <?php foreach ($hotArticle as $key => $hot): ?>
                    <div class="card border border-right-0 border-top-0 border-left-0" style="margin-top: 10px" >
                        <div class="card-body">
                            <a href="detail?id=<?php echo $hot['id']?>">
                                <?php echo ($key+1).'.'.$hot['article_name'] ?>
                                <p style="display: inline-block;float: right">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo $hot['like']?>
                                </p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
<div id="footer" class="border border-0" style="height: 80px;background-color: #ffffff;">
    <nav class="navbar navbar-default navbar-fixed-bottom border border-0" style="background-color: #ffffff">
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
<script>
    // 跳转个人简介页面
    function personal(){
        window.location.href = 'blog'
    }

    // 点赞接口
    function like(id){
        $.ajax({
            url:'/front/index/like',
            type:'post',
            dataType:'json',
            data:{id:id},
            success: function(data){
                if (data.code === 200){
                    alert('感谢点赞')
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    // 踩接口
    function hate(id){
        $.ajax({
            url:'/front/index/hate',
            type:'post',
            dataType:'json',
            data:{id:id},
            success: function(data){
                if (data.code === 200){
                    alert('会持续改进,欢迎发送邮件或者留言更正错误地方')
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }
    
    function detail(id) {
        window.location.href = 'detail?id=' + id
    }
</script>
