<?php require __DIR__ . '/../default/header.php'; ?>
<?php //var_dump($page);die(); ?>
<body>
<div class="container main-content" style="width: 1000px;">
    <div class="row title" style="height: 60px;margin: 30px;">
        <div class="card border-0">
            <?php if (((int)$page === 1 && (int)$totalPage === 1) || $totalCount === 0): ?>
                <div class="card-body">
                    <button type="button" class="btn btn-default btn-sm border" onclick="backIndex()">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回首页
                    </button>
                </div>
            <?php elseif((int)$page === 1 && (int)$totalPage > 1): ?>
                <div class="card-body" style="width: 910px">
                    <button type="button" class="btn btn-default btn-sm border" onclick="backIndex()">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回首页
                    </button>
                    <button type="button" class="btn btn-default btn-sm border" onclick="nextArticle()" style="float: right ">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> 看看下一篇
                    </button>
                </div>
            <?php elseif((int)$page !== 1 && (int)$totalPage === (int)$page): ?>
                <div class="card-body" style="width: 910px">
                    <button type="button" class="btn btn-default btn-sm border" onclick="lastArticle()">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回上一页
                    </button>
                </div>
            <?php else: ?>
                <div class="card-body" style="width: 910px">
                    <button type="button" class="btn btn-default btn-sm border" onclick="lastArticle()">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回上一页
                    </button>                    <button type="button" class="btn btn-default btn-sm border" onclick="nextArticle()" style="float: right ">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> 看看下一篇
                    </button>

                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="title border border-left-0 border-right-0 border-bottom-0" style="margin: 30px;height: 1200px">
        <?php if ($totalCount !== 0): ?>
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
        <?php else: ?>
            <div class="card" style="margin-top: 30px">
                <div class="card-body">暂无文章哦~可以去看看其他内容!</div>
            </div>
        <?php endif; ?>
    </div>
    <div class="" style="margin: 30px;height: 50px;text-align: center">
        <?php if ((int)$page > 1 && (int)$totalPage > 1): ?>
            <?php if ((int)$totalPage === (int)$page): ?>
                <button type="button" class="btn btn-light" style="margin-right: 20px" onclick="lastArticle()"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;&nbsp;<span>LAST</span>
                </button>
            <?php elseif ((int)$totalPage >1 && (int)$page < (int)$totalPage): ?>
                <button type="button" class="btn btn-light" style="margin-right: 20px" onclick="lastArticle()"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;&nbsp;<span>LAST</span>
                </button>
                <button type="button" class="btn btn-light" style="margin-right: 20px" onclick="nextArticle()"><span>NEXT</span>&nbsp;&nbsp;<span class="glyphicon glyphicon-circle-arrow-down"></span>
                </button>
            <?php endif; ?>
        <?php elseif((int)$page === 1 && (int)$totalPage > 1): ?>
                <button type="button" class="btn btn-light" style="margin-right: 20px" onclick="nextArticle()"><span>NEXT</span>&nbsp;&nbsp;<span class="glyphicon glyphicon-circle-arrow-down"></span>
                </button>
        <?php endif; ?>
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
    function nextArticle() {
        var url = '/front/index/article-list?';
        <?php foreach ($params as $key => $item): ?>
            <?php if($key === 'page'): ?>
                <?php continue; ?>
            <?php endif; ?>
            url += '<?php echo $key ?>=<?php echo $item ?>&';
        <?php endforeach; ?>
        url += 'page=';
        url += '<?php echo ($page + 1)?>';
        window.location.href = url;
    }

    function lastArticle() {
        var url = '/front/index/article-list?';
        <?php foreach ($params as $key => $item): ?>
        <?php if($key === 'page'): ?>
        <?php continue; ?>
        <?php endif; ?>
        url += '<?php echo $key ?>=<?php echo $item ?>&';
        <?php endforeach; ?>
        url += 'page=';
        url += '<?php echo ($page - 1)?>';
        window.location.href = url;
    }

    function backIndex(){
        window.location.href = 'index'
    }
</script>

