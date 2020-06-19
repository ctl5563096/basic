<?php
use yii\helpers\Html;
?>
<?=Html::jsFile('@web/js/jq.js')?>
<!DOCTYPE html>
<html>
<head>
    <title>博 客 后 台</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Custom Theme files -->
    <link href="/css/backend/login/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/backend/login/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->

    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //web font -->

</head>
<script>
    function tijiao() {
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        if (!password || !username){
            alert('请检查账号密码是否输入')
            return
        }
        var data = {
            username:username,
            password:password
        }
        $.post(
            '<?php echo yii\helpers\Url::to(['chat/login/custom']); ?>',
            data,
            function (res) {
                if (res.code === 200){
                    alert(res.msg)
                    window.location.href = " <?php echo yii\helpers\Url::to(['chat/message/index']); ?> ";
                }else {
                    alert(res.msg)
                }
            }
        )
    }
</script>
<body>

<!-- main -->
<div class="w3layouts-main">
    <div class="bg-layer">
        <h1>Login Blog</h1>
        <div class="header-main">
            <div class="main-icon">
                <span class="fa fa-eercast"></span>
            </div>
            <div class="header-left-bottom">
                <form>
                    <div class="icon1">
                        <span class="fa fa-user"></span>
                        <input type="email" placeholder="Username" class="username" name="username" required=""/>
                    </div>
                    <div class="icon1">
                        <span class="fa fa-lock"></span>
                        <input type="password" placeholder="Password" name="password" required=""/>
                    </div>
<!--                    <div class="login-check">-->
<!--                        <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Keep me logged in</label>-->
<!--                    </div>-->
                    <div class="bottom">
                        <button class="btn" type="button" id="submit" onclick="tijiao()">Log In</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- copyright -->
        <div class="copyright">
            <p>© 2019 Slide Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
        </div>
        <!-- //copyright -->
    </div>
</div>
<!-- //main -->
</body>
</html>
