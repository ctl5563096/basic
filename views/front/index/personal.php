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
    <div class="row title" style="height: 60px;margin: 30px;">
        <div class="card border-0">
            <div class="card-body">
                <button type="button" class="btn btn-default btn-sm border" onclick="backIndex()">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> 返回首页
                </button>
            </div>
        </div>
    </div>
    <div class="title border" style="height: 1200px;margin: 30px;">
        <div class="card border-0">
            <h2 class="card-body" style="text-align: center;">
                关 于 博 主
            </h2>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <span class="glyphicon glyphicon-user"></span> <span>个 人 简 介</span>
                <div class="card-body">博主90后单身狗一条</div>
                <div class="card-body">出身中国大陆最南方--湛江</div>
                <div class="card-body">大学在大连上学(不要问我为什么去北方,因为我想去看北方的海),大学专业电子男一枚</div>
                <div class="card-body">大学主修电子专业,俗称电焊工,学过数字电路,C,C++,模拟电路等等....</div>
                <div class="card-body">大学毕业回到深圳从事web开发(所以有点菜)</div>
                <div class="card-body">目前在深圳某外包公司靠着PHP维持一下生活,目前在自学GO(进程缓慢)</div>
                <div class="card-body">喜欢看电影.听音乐,基本保持更新自己的网易云和自己的电影库,有想要互加网易好友的加YY_CTL 分享一下各自的歌单~ o(￣▽￣)o</div>
                <div class="card-body">想学摄影 但是一直没时间没钱,最主要还是穷</div>
                <div class="card-body">具有独立分析、解决问题的能力，良好的沟通能力，团队合作精神，高度的责任心，能承担工作压力,有强烈的上进心和求知欲，善于学习新事物</div>
            </div>
            <div class="card-body">
                <span class="glyphicon glyphicon-road"></span> <span>工 作 经 历</span>
                <div class="card-body">2018.09 ~ 2019.02 深圳市乐活电子商务公司</div>
                <div class="card-body">2019.04 ~ 2020.06 广州市凡岛网络科技有限公司</div>
                <div class="card-body">2020.06 ~ 至今 某大型互联网公司外包人员</div>
            </div>
            <div class="card-body">
                <span class="glyphicon glyphicon-tags"></span> <span>博 客 技 术</span>
                <div class="card-body">系统主体架构：lamp</div>
                <div class="card-body">技术栈：Yii2 +　Redis + Bootstrap + layui</div>
                <div class="card-body">模块：主要是分为博客主体和后台管理</div>
            </div>
            <div class="card-body">
                <span class="glyphicon glyphicon-tags"></span> <span>后　述</span>
                <div class="card-body">开发初衷：跟我首页写得一样，总想记录点什么</div>
                <div class="card-body">长期维护博客,编写新模块</div>
                <div class="card-body">联系博主邮箱：chentulinys@163.com</div>
                <div class="card-body">博主微信:
                    <img src="/header/qrcode.png" width="100px" height="100px">
                </div>
            </div>
        </div>
    </div>
</div>
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
    function backIndex(){
        window.location.href = 'index'
    }
</script>
