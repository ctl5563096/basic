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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>YYCTL博客后台</title>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin layui-bg-blue">
    <div class="layui-header layui-bg-blue">
        <div class="layui-logo" style="color: #F0F0F0">YYCTL博客后台</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-bg-blue layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    <?php echo Yii::$app->session->get('user') ?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="<?php echo yii\helpers\Url::to(['backend/login/logout']); ?>">退出登陆</a></li>
        </ul>
    </div>