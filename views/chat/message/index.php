<?php require __DIR__ . '/../../backend/default/header.php'; ?>
<style>
    p{
        word-wrap: break-word;
        word-break: break-all;
        overflow: hidden;
    }
    textarea {
        width: 100%;
        height: 100%;
        border: none;
        resize: none;
        cursor: pointer;
    }
</style>
    <div class="layui-side layui-bg-white" style="border-right: 1px" id="list">
<!--        <div>-->
<!--            <img src="https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1592552679&di=8230b33959f96a0fc09cf06c5b2d7aaa&src=http://pic1.win4000.com/wallpaper/4/5359c6695cdee.jpg" style="width: 50px;height: 50px;margin: 3px">-->
<!--            <span style="color: #000000">YYCTL</span>-->
<!--            <span style="color:white ;border-radius:2em;background:red;width: 10px;height: 10px">0</span>-->
<!--        </div>-->
    </div>
    <div class="layui-body" style="color: #0C0C0C;border-left: 1px solid #000000;overflow: hidden;">
        <div style="width: 100%;height: 70%;overflow-y:scroll;border-bottom: 2px solid #000000;padding: 5px" id="main_content">

        </div>
        <div id="sender">
            <textarea id="sender_content" style="height: 128px"></textarea>
            <button type="button" id="send_message" class="layui-btn" style="float: right;width: 100px">发送</button>
        </div>
    </div>
<?php require __DIR__ . '/../../backend/default/footer.php'; ?>
<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;
        var current_user;

        // 先执行对应数据初始化
        // 1.读取有未读消息的用户
        // 2.读取客服信息
        // 3.连接websocket
        // 获取未读信息客户 开始
        // getUsers()
        getNotReadMessage()

        function getUsers(){
            $.ajax({
                url: "<?php echo yii\helpers\Url::to(['chat/add']); ?>",
                type: 'post',
                data: {customId:14},
                dataType: 'json',
                async: false,
                success: function (result) {
                    console.log('SUCCESS!');
                }
            })
        }
        // 获取未读信息客户


        // websocket 开始
        var ws = new WebSocket("ws://120.78.13.233:18308/Custom?custom_id=" + <?php echo $customId ?>);
        ws.onopen = function () {
            layer.msg('客服系统登录成功,模块正在初始化，3秒后初始化成功!',
                {
                    time:3000
                },function () {

                });
            console.log('websocket连接成功')
        };

        // 获取所有未读信息的用户
        function getNotReadMessage()
        {
            $.ajax({
                url: "<?php echo yii\helpers\Url::to(['chat/message/message']); ?>",
                type: 'post',
                data: {customId:14},
                dataType: 'json',
                async: false,
                success: function (result) {
                    if (result.code == 200){
                        let html = ''
                        let list = result.data.dataList
                        if (list.length == 0){
                            html = `<span>暂无未读客户信息</span>`
                        }else{
                            list.map(function(item, index){
                                html += `<div class="get-message" style="cursor:pointer" title="点击查看未读消息" data-openid="`
                                html += item.openid
                                html += `" >`
                                html += `<img src="`
                                html += item.head_img_url
                                html += `"style="width: 50px;height: 50px;margin: 3px">`
                                html += `<span style="color: #000000">`
                                html += item.nickname
                                html += `</span>`
                                html += `<span class="layui-badge layui-bg-gray" style="margin-left: 10px">`
                                html += item.notRead
                                html += `</span>`
                                html += `</div>`
                            })
                            $("#list").html(html);
                        }
                    }else{
                        alert(result.msg)
                    }
                }
            })
        }

        // 发送消息
        function sendMessage() {
            var dom = $('#ws_content');
            var message = dom.val();
            if (message === '') {
                alert('请输入发送的消息');
                return false
            }
            ws.send(message);
            dom.val('')
        }

        // 接受消息
        ws.onmessage = function (evt) {
            var result = evt.data;
            var dom = '';
            dom = '<p>' + result + '</p>';
            $('.message').append(dom)
        };
        // websocket结束

        // 点击事件
        $('.get-message').click(function(e){
            e.stopPropagation()
            let openid = e.currentTarget.getAttribute("data-openid")
            // 判断当前聊天框是哪个用户
            current_user = openid
            $.ajax({
                url: "<?php echo yii\helpers\Url::to(['chat/message/get-message']); ?>",
                type: 'post',
                data: {customId:14,openid:openid},
                dataType: 'json',
                async: false,
                success: function (result) {
                    let html = '';
                    let dom = $('#main_content');
                    // 清空内容
                    dom.empty();
                    if (result.code == 200){
                        if (result.data.message.length == 0){
                            html = `<p style="text-align: center;top: 0px;">暂无聊天记录</p>`
                        }else{
                            // 循环渲染
                            result.data.message.map(function(item, index){
                                // 判断是客服发送还是顾客发送
                                if (item.is_customer == 1){
                                    html += `<p align="right" style="margin-bottom: 5px;">`
                                    html += item.created_time
                                    html += `&nbsp&nbsp&nbsp`
                                    html += this.nickname
                                    html += `</p>`
                                    html += `<p align="right" style="margin-bottom: 20px;padding-left: 50%;">`
                                    html += item.content
                                    html += `</p>`
                                }else{
                                    html += `<p style="margin-bottom: 5px;">`
                                    html += `客服14`
                                    html += `&nbsp&nbsp&nbsp`
                                    html += item.created_time
                                    html += `</p>`
                                    html += `<p style="margin-bottom: 20px;padding-right: 50%">`
                                    html += item.content
                                    html += `</p>`
                                }
                            },{
                                url:result.data.headerUrl,
                                nickname:result.data.userName,
                            })
                            // 把内容塞进去
                            dom.append(html)
                            // 默认让滚动条在最底下
                            dom.scrollTop(dom[0].scrollHeight);
                        }
                    }else{
                        alert(result.msg)
                    }
                }
            })
        })

        // 发送消息
        $('#send_message').click(function () {
            if (!current_user){
                layer.msg('请选择用户');
                return false
            }else {
                let send_content = $('#sender_content').val()
                if (send_content){
                    layer.msg('输入内容为空');
                    return false
                }
            }
        })
    });
</script>
