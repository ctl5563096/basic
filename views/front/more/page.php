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

<div class="layui-carousel" id="test1">
    <div carousel-item>
        <div>条目1</div>
        <div>条目2</div>
        <div>条目3</div>
        <div>条目4</div>
        <div>条目5</div>
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
        });
    });
</script>
</body>
</html>

