<?php
use yii\helpers\Html;
?>
<?=Html::jsFile('@web/js/jq.js')?>
<?=Html::jsFile('@web/css/layui/layui.js')?>
<?=Html::cssFile('@web/css/layui/css/layui.css')?>
<?=Html::jsFile('@web/css/layui/layui.js')?>
<?//=Html::jsFile('@web/js/bg.js')?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>carousel模块快速使用</title>
</head>
<body>

<div class="layui-container" style="width: 1200px">
    <div class="layui-carousel" id="test1">
        <div carousel-item>
            <div>
                <img src="http://www.ctllys.top/upload/image/20210103224630.jpg" width="100px">
            </div>
            <div>条目2</div>
            <div>条目3</div>
            <div>条目4</div>
            <div>条目5</div>
        </div>
    </div>
    <div>
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">内容主体区域</div>
    </div>
    <div class="layui-footer" style="background-color: burlywood;text-align: center">
        <p class="text-muted credit" style="margin-top: 10px">
            粤ICP备19092236号-1 如有侵权请联系作者
        </p>
        <p class="text-muted credit" style="margin-top: 10px">
            网站地址:www.ctllys.top
        </p>
        <p class="text-muted credit" style="margin-top: 10px">
            作者邮箱:chentulinys@163.com
        </p>
    </div>
</div>

<!-- 条目中可以是任意内容，如：<img src=""> -->
<script>
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
            ,autoplay: true
        });
    });
</script>
</body>
</html>

