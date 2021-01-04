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
                <img src="http://www.ctllys.top/upload/image/20210103224630.jpg" height="280px" width="1000px" style="margin: auto;margin-top: 20px;display: block;box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.20), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
            </div>
            <div>
                <img src="http://www.ctllys.top/upload/image/20210103224630.jpg" height="280px" width="1000px" style="margin: auto;margin-top: 20px;display: block;box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.20), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
            </div>
            <div>
                <img src="http://www.ctllys.top/upload/image/20210103224630.jpg" height="280px" width="1000px" style="margin: auto;margin-top: 20px;display: block;box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.20), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
            </div>
            <div>
                <img src="http://www.ctllys.top/upload/image/20210103224630.jpg" height="280px" width="1000px" style="margin: auto;margin-top: 20px;display: block;box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.20), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
            </div>
            <div>
                <img src="http://www.ctllys.top/upload/image/20210103224630.jpg" height="280px" width="1000px" style="margin: auto;margin-top: 20px;display: block;box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.20), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
            </div>
        </div>
    </div>
    <div>
        <!-- 内容主体区域 -->
        <div class="layui-row" style="height: 1000px;">
            <div class="layui-col-md9" style="background-color: red;height: 1000px;">
                你的内容 9/12
            </div>
            <div class="layui-col-md3" style="background-color: cadetblue;height: 1000px;">
                你的内容 3/12
            </div>
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
            // ,anim: 'fade' //切换动画方式
            ,autoplay: true
            ,height:350
        });
    });
</script>
</body>
</html>

