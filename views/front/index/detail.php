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
</style>
<body>
<div class="container main-content" style="width: 1200px;">
    <div class="row title" style="height: 60px;margin: 30px;">
        <div class="card border-0">
            <div class="card-body">
                <button type="button" class="btn btn-default btn-sm border" onclick="backIndex()">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回首页
                </button>
            </div>
        </div>
    </div>
    <div class="title border" style="margin: 30px;">
        <div class="card border-0">
            <h2 class="card-body" style="text-align: center;">
                <?php echo $detail->article_name ?>
            </h2>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <span class="glyphicon glyphicon-user"></span> <span><?php echo $detail->author_nickname?></span>
                &nbsp;
                <span class="glyphicon glyphicon-time"></span> <span><?php echo date('Y-m-d H:i:s',$detail->created_at)?></span>
                &nbsp;
                <span class="glyphicon glyphicon-thumbs-up" onclick="like(<?php echo $detail->id ?>)"></span> <span class="like"><?php echo $detail->like ?></span>
                &nbsp;
                <span class="glyphicon glyphicon-thumbs-down" onclick="hate(<?php echo $detail->id ?>)"></span> <span class="hate"><?php echo $detail->hate ?></span>
            </div>
            <div class="card-body">
                <?php echo $detail->content?>
            </div>

        </div>
        <div class="card border" style="margin: 30px;height: 250px">
            <div class="form-group card-body">
                <label for="comment">评论:</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
                <div class="card-body">
                    <div class="card-body" style="height: 100px;display: inline-block;float: right">
                        <button type="button" onclick="comment(<?php echo $detail->id?>)" class="btn btn-success" style="float: right;width: 80px;" >提交评论</button>
                    </div>
                    <div class="card-body" style="height: 70px;display: inline-block;float: right;">
                        <button type="button" onclick="clearText()" class="btn btn-success" style="float: right;width: 80px">重置</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border" style="margin: 30px;" id="parent">
                <?php foreach ($comment as $k => $v): ?>
                    <div class="card-body" style="padding: 5px">
                        <?php echo $v['comment']; ?>
                    </div>
                    <div class="card-body border border-right-0 border-left-0 border-top-0" style="margin: 5px;text-align: right;padding: 0px;padding-bottom: 5px"><?php echo $v['user_name']; ?> 于 <?php echo date('Y-m-d H:i:s',$v['created_at'])?> 评论 </div>
                <?php endforeach;?>
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
    function backIndex(){
        window.location.href = window.location.href = '<?php echo Url::toRoute(['/front/index/index']); ?>';
    }
    // 点赞接口
    function like(id){
        var like = $(".like").html();
        $.ajax({
            url:'/front/index/like',
            type:'post',
            dataType:'json',
            data:{id:id},
            success: function(data){
                if (data.code === 200){
                    like = parseInt(like) + 1;
                    $(".like").html(like);
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
        var hate = $(".hate").html();
        $.ajax({
            url:'/front/index/hate',
            type:'post',
            dataType:'json',
            data:{id:id},
            success: function(data){
                if (data.code === 200){
                    alert(data.msg)

                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    // 清楚文本域内容
    function clearText(){
        $('#comment').val('')
    }

    function comment(id){
        var comment = $('#comment').val();
        if (comment === ''){
            alert('内容不能为空')
        }
        $.ajax({
            url:'/front/comment/comment',
            type:'post',
            data:{comment:comment,article_id:id},
            dataType:'json',
            success: function(data){
                if (data.code === 200){
                    $
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }
</script>
