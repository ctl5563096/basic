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
<body οnlοad="newtext()">
<?php //var_dump($moreWeather); ?>
<!--<div class="clock"></div>-->
<div style="width: 300px;position: fixed;right: 0px;top:50px;" class="card">
    <div class="card-header" style="text-align: center">留言板</div>
    <?php foreach ($comment as $ck => $cv): ?>
        <div class="card-body border" style="margin: 3px">
            <p style="font-size: 12px"><?php echo $cv['content'] ?></p>
            <P style="font-size: 8px"><?php echo $cv['name'] ?> 于 <?php echo date('Y-m-d H:i:s',$cv['created_at']) ?> 留下他的足迹</P>
        </div>
    <?php endforeach; ?>
    <div class="card-body" style="float: right">
        <button type="button" class="btn btn-primary btn-sm" onclick="goMessageBoard()" style="float: right">查看更多留言</button>
    </div>
</div>
<div style="width: 300px;position: fixed;left: 30px;top:50px;" class="card">
    <p class="card-body">在线聊天室,想测试可以开两个页面哦~</p>
    <div class="card-body border message" style="margin: 10px;height: 300px;padding-bottom: 30px;overflow:auto;">
    </div>
    <div class="form-group card-body">
        <textarea class="form-control" rows="3" id="ws_content"></textarea>
    </div>
    <div class="card-body" style="float: right">
        <button type="button" class="btn btn-primary btn-sm" onclick="sendMessage()">发送消息</button>
    </div>
</div>
<div class="container main-content" style="width: 1050px;">
    <div class="row title" style="height: 280px;">
        <img src="/header/back.gif" style="width: 1050px;display: block;height: 280px;">
    </div>
    <div class="row title" style="height: 60px;margin-bottom: 30px;">
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">首页 </a>
        <a href="/front/message/index" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">留言板 </a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">碎碎念 </a>
        <a href="/front/photo/index" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">生活圈子</a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">生命树</a>
        <a href="#" style="display: inline-block;width: 100px;height: 30px;font-size: 16px;text-align: center;padding-top: 25px;font-family: -apple-system, BlinkMacSystemFont, PingFang-SC-Regular, Hiragino Sans GB, Microsoft Yahei, Arial, sans-serif;text-transform:uppercase;">查看更多</a>
        <div class="input-group" style="width: 300px;height: 32px;padding-top: 21px;margin-left: 80px">
            <input type="text" class="form-control" placeholder="搜点文章" style="height: 30px" id="title" name="title">
            <button type="button" class="btn btn-outline-secondary" style="height: 30px;width: 80px " onclick="searchArticle()"><span class="glyphicon glyphicon-search"style="display: inline-block;"></span></button>
            <img src="/header/blog.jpg" class="rounded-circle" style="width: 30px;height: 30px;margin-left: 30px" alt="YYCTL">
        </div>
    </div>
    <div class="row module" style="height: 180px">
        <div class="col-sm-3 hot" >
            <a href="/front/index/article-list?module=php" class="text-decoration-none">
                <img src="/header/php.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;margin-top: 10px"><a href="/front/index/article-list?module=php"><strong style="font-family: 'Microsoft YaHei UI'">P H P 代 码 录</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="/front/index/article-list?module=sql">
                <img src="/header/mysql.jpg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;margin-top: 10px"><a href="/front/index/article-list?module=sql"><strong style="font-family: 'Microsoft YaHei UI'">mysql</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="/front/index/article-list?module=system">
                <img src="/header/system.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;margin-top: 10px"><a href="/front/index/article-list?module=system"><strong style="font-family: 'Microsoft YaHei UI'">操作系统</strong></a></h4>
        </div>
        <div class="col-sm-3 hot">
            <a href="/front/index/blog">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1588759285737&di=cab165e622d2a77d4b54cb8302496413&imgtype=0&src=http%3A%2F%2Fie.bjd.com.cn%2Fimages%2F201910%2F30%2F5db942a9e4b0d15f72e52ef4.jpeg" width="220px" height="150px">
            </a>
            <h4 style="text-align: center;font-size: 24px;margin-top: 10px"><a href="/front/index/blog"><strong style="font-family: 'Microsoft YaHei UI'">博 主 介 绍</strong></a></h4>
        </div>
    </div>
    <div >

    </div>
    <div class="row main" style="padding-top: 10px;padding-left: 10px">
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
                <h3 style="margin-top: 10px">现 在 天 气</h3>
                <div class="card " style="margin-top: 10px">
                    <div class="card-body" style="padding-top: 5px;padding-bottom: 5px;height: 50px">城&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;市 : <?php echo $weather['location']['name'] ?><img src="/header/city.png" class="rounded card-body" style="width: 50px;margin-left: 130px" ></div>
                    <div class="card-body" style="padding-top: 5px;padding-bottom: 5px;height: 50px">现在天气 : <?php echo $weather['now']['text'] ?><img src="/black/<?php echo  $weather['now']['code']?>@1x.png" class="rounded card-body" style="width: 50px;margin-left: 130px" ></div>
                    <div class="card-body" style="padding-top: 5px;padding-bottom: 5px;height: 50px">气&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;温 : &nbsp;<?php echo $weather['now']['temperature'] ?>&#8451;</div>
                    <div class="card-body weather border" style="padding: 0px;display: none;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;">
                        <div class="card-body" style="padding: 5px;">
                            明 天 天 气：
                            <div class="card-body" style="padding: 0px;">
                                白天天气 : <?php echo $moreWeather['daily'][1]['text_day'] ?>
                                <img src="/black/<?php echo  $moreWeather['daily']['1']['code_day']?>@1x.png" class="rounded card-body" style="width: 50px;margin-left: 80px" >
                            </div>
                            <div class="card-body" style="padding: 0px;">
                                晚间天气 : <?php echo $moreWeather['daily'][1]['text_night'] ?>
                                <img src="/black/<?php echo  $moreWeather['daily']['1']['code_night']?>@1x.png" class="rounded card-body" style="width: 50px;margin-left: 80px" >
                            </div>
                            <div class="card-body" style="padding: 0px;">
                                最高气温：<?php echo $moreWeather['daily'][1]['high'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 最低气温：<?php echo $moreWeather['daily'][1]['low'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body weather border" style="padding: 0px;display: none;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;">
                        <div class="card-body" style="padding: 5px;">
                            后 天 天 气：
                            <div class="card-body" style="padding: 0px;">
                                白天天气 : <?php echo $moreWeather['daily'][2]['text_day'] ?>
                                <img src="/black/<?php echo  $moreWeather['daily'][2]['code_day']?>@1x.png" class="rounded card-body" style="width: 50px;margin-left: 80px" >
                            </div>
                            <div class="card-body" style="padding: 0px;">
                                晚间天气 : <?php echo $moreWeather['daily'][2]['text_night'] ?>
                                <img src="/black/<?php echo  $moreWeather['daily'][2]['code_night']?>@1x.png" class="rounded card-body" style="width: 50px;margin-left: 80px" >
                            </div>
                            <div class="card-body" style="padding: 0px;">
                                最高气温：<?php echo $moreWeather['daily'][2]['high'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 最低气温：<?php echo $moreWeather['daily'][1]['low'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="layerDemo" style="padding-top: 0px;padding-bottom: 0px;height: 50px"><button type="button" class="btn btn-primary weatherButton" data-method="notice" style="margin-left: 100px" onclick="getWeather()">查看明后两天天气</button></div>
                </div>
<!--                <H3 style="padding-bottom: 5px;margin-top: 5px" class="border border-right-0 border-top-0 border-left-0">-->
<!--                    <strong style="font-family: 'Microsoft YaHei UI'">-->
<!--                        关于博主-->
<!--                    </strong>-->
<!--                </H3>-->
<!--                <div style="margin-top: 10px">-->
<!--                    <img src="/header/blog.jpg" class="rounded" style="width: 50px" alt="YYCTL">&nbsp;&nbsp;&nbsp;YYCTL-->
<!--                </div>-->
                <h3 style="margin-top: 10px">每 日 吐 槽</h3>
                <div class="card" style="margin-top: 10px">
                    <div class="card-body">总想吐槽点什么东西</div>
                </div>
                <h3 style="margin-top: 10px">个 人 经 历</h3>
                <div class="card" style="margin-top: 10px">
                    <div class="card-body">查看更多<button type="button" class="btn btn-primary" style="float: right" onclick="personal()">MORE-></button></div>
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
                            <a href="/front/index/detail?id=<?php echo $hot['id']?>">
                                <?php echo ($key+1).'.'.$hot['article_name'] ?>
                                <p style="display: inline-block;float: right">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo $hot['like']?>
                                </p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <div class="card" style="margin-top: 50px">
                <div class="form-group card-body" style="padding-bottom: 0px;margin-bottom: 0px;">
                    <label for="comment" style="text-align: center;margin-left: 50px">「路过总要留点东西下来」</label>
                    <textarea class="form-control" rows="5" id="content" name="content" placeholder="留下你的意见"></textarea>
                    <div class="form-group" style="z-index: 2000">
                        <label for="usr">大 名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="留下大名">
                    </div>
                    <div class="form-group" style="z-index: 2000">
                        <label for="usr" >邮 箱</label>
                        <input type="text" class="form-control" id="mail" name="mail" placeholder="选填">
                    </div>
                    <div class="form-group" style="z-index: 2000">
                        <label for="usr" >电话号码</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="选填">
                    </div>
                    <div class="card-body" style="text-align: center">
                        <button type="button" class="btn btn-primary btn-sm" onclick="messageBoard()">留下你的痕迹 []~(~▽~)~* </button>
                    </div>
                </div>
            </div>
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
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                </button>
                <h4 class="modal-title" id="myModalLabel">
                    模态框（Modal）标题
                </h4>
            </div>
            <div class="modal-body">
                在这里添加一些文本
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary">
                    提交更改
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
</html>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    var ws = new WebSocket("ws://120.78.13.233:18308/Chat");
    ws.onopen = function () {
        console.log('websocket连接成功')
    };
    function sendMessage() {
            var dom = $('#ws_content');
            var message = dom.val();
            if(message === ''){
                alert('请输入发送的消息');
                return false
            }
            ws.send(message);
            dom.val('')
        }

    ws.onmessage = function (evt) {
        var result= evt.data;
        var dom = '';
        dom = '<p>' + result + '</p>';
        $('.message').append(dom)
    };

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
        var mail = $('#mail').val();
        var phone = $('#phone').val();
        if (name === '' || content === ''){
            alert('请输入完整信息哦 我才能看到你的留言 （￣︶￣）↗!')
            return false;
        }
        $.ajax({
            url:'/front/message/message-board',
            type:'post',
            dataType:'json',
            data:{content:content,name:name,mail:mail,phone:phone},
            success: function(data){
                if (data.code === 200){
                    alert('你的留言已经发送到我的邮箱,我会在第一时间回复你，感谢关注 <(￣︶￣)>')
                    $('#name').val('');
                    $('#content').val('');
                    $('#mail').val('');
                    $('#phone').val('');
                }else {
                    alert(data.msg);
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    /**
     * 获取明天和后天天气
     */
    function getWeather() {
        var dom = $('.weather').css('display')
        if(dom === 'none'){
            $('.weather').slideDown(1500)
            $('.weatherButton').text("收起天气预告板")
        }else {
            $('.weather').slideUp(1500)
            $('.weatherButton').text("查看明后两天天气")
        }
    }

    // 跳转留言板
    function goMessageBoard()
    {
        window.location.href = '/front/message/index';
    }
</script>