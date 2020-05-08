<?php use yii\helpers\Url;

require __DIR__ . '/../default/header.php'; ?>
<style>
    .hot{
        height: 100px;
    }
    .module{
        margin-top: 30px;
        margin-bottom: 50px;
    }
    .clock { position: fixed;top: 30px;left: 150px}
</style>
<body>
<!--<div class="clock"></div>-->
<div style="width: 300px;height: 200px;position: fixed;right: 0px;bottom:70px;" class="card">
    <div class="form-group card-body" style="padding-bottom: 0px;margin-bottom: 0px">
        <label for="comment" style="text-align: center;margin-left: 50px">「路过总要留点东西下来」</label>
        <textarea class="form-control" rows="5" id="content" name="content"></textarea>
        <div class="form-group">
            <label for="usr">留下贵姓必有回复</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="card-body" style="float: right">
            <button type="button" class="btn btn-primary btn-sm" onclick="messageBoard()">留下你的痕迹 []~(~▽~)~* </button>
        </div>
    </div>
</div>
<div style="width: 300px;position: fixed;right: 0px;top:50px;" class="card">
    <div class="card-header" style="text-align: center">留言板</div>
    <?php foreach ($comment as $ck => $cv): ?>
        <div class="card-body border" style="margin: 3px">
            <p style="font-size: 12px"><?php echo $cv['content'] ?></p>
            <P style="font-size: 8px"><?php echo $cv['name'] ?> 于 <?php echo date('Y-m-d H:i:s',$cv['created_at']) ?> 留下他的足迹</P>
        </div>
    <?php endforeach; ?>
    <div class="card-body" style="float: right">
        <button type="button" class="btn btn-primary btn-sm" onclick="messageBoard()" style="float: right">查看更多留言</button>
    </div>
</div>
<div class="container main-content" style="width: 1050px;">
    <div class="row title" style="height: 280px;">
        <img src="https://i0.hdslb.com/bfs/article/a452474691b43b474d43e3f931fb6e44fd157a5c.gif" style="width: 1050px;display: block;height: 280px;">
    </div>
    <div class="row title" style="height: 60px;margin-bottom: 30px;">
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">首页 </a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">留言板 </a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">碎碎念 </a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">生活圈子</a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">生命树</a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">查看更多</a>
        <div class="input-group" style="width: 300px;height: 32px;padding-top: 21px;margin-left: 110px">
            <input type="text" class="form-control" placeholder="搜点文章" style="height: 30px" id="title" name="title">
            <button type="button" class="btn btn-outline-secondary" style="height: 30px;width: 80px " onclick="searchArticle()"><span class="glyphicon glyphicon-search"style="display: inline-block;"></span></button>
        </div>
    </div>
    <div class="row module" style="height: 180px">
        <div class="col-sm-3 hot" >
            <a href="/front/index/article-list?module=php" class="text-decoration-none">
                <img src="/header/php.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="/front/index/article-list?module=php"><strong style="font-family: 'Microsoft YaHei UI'">P H P 代 码 录</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="/front/index/article-list?module=sql">
                <img src="/header/mysql.jpg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="/front/index/article-list?module=sql"><strong style="font-family: 'Microsoft YaHei UI'">mysql</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="/front/index/article-list?module=system">
                <img src="/header/system.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="/front/index/article-list?module=system"><strong style="font-family: 'Microsoft YaHei UI'">操作系统</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="/front/index/blog">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;"><a href="/front/index/blog"><strong style="font-family: 'Microsoft YaHei UI'">博 主 介 绍</strong></a></h4>
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
    var clock = $(".clock").clock({
            width: 200,       // set width
            height: 200,      // set height
            theme: 't3',      // set theme  => 't1' 't2' 't3'
            date: new Date()  // set date => new Date()
        }),
        data = clock.data('clock');
    // 跳转个人简介页面
    function personal(){
        window.location.href = '<?php echo Url::toRoute(['/front/index/blog']); ?>';
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

    // 文章详情
    function detail(id) {
        window.location.href = '/front/index/detail?id=' + id
    }

    // 搜索文章名
    function searchArticle() {
        window.location.href = '/front/index/article-list?article_name=' + $(" input[ name='title' ] ").val();
    }

    $("#name").keydown(function() {
        //给输入框绑定按键事件
        if(event.keyCode == "13") {//判断如果按下的是回车键则执行下面的代码
            messageBoard()
        }
    })

    function messageBoard(){
        // 获取姓名和内容
        var name = $('#name').val();
        var content = $('#content').val();
        if (name === '' || content === ''){
            alert('请输入完整信息哦 我才能看到你的留言 （￣︶￣）↗!')
            return false;
        }
        $.ajax({
            url:'/front/message/message-board',
            type:'post',
            dataType:'json',
            data:{content:content,name:name},
            success: function(data){
                if (data.code === 200){
                    alert('我已经收到你的留言,我会在第一时间回复你，感谢关注 <(￣︶￣)>')
                    $('#name').val('');
                    $('#content').val('');
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }
</script>
