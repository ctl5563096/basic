<?php require __DIR__ . '/../../backend/default/header.php'; ?>
    <div class="layui-side layui-bg-white" style="border-right: 1px" id="list">
<!--        <div>-->
<!--            <img src="https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1592552679&di=8230b33959f96a0fc09cf06c5b2d7aaa&src=http://pic1.win4000.com/wallpaper/4/5359c6695cdee.jpg" style="width: 50px;height: 50px;margin: 3px">-->
<!--            <span style="color: #000000">YYCTL</span>-->
<!--            <span style="color:white ;border-radius:2em;background:red;width: 10px;height: 10px">0</span>-->
<!--        </div>-->
    </div>
    <div class="layui-body" style="color: #0C0C0C;border-left: 1px solid #000000">
        <div style="width: 100%;height: 80%;overflow-y:scroll;border-bottom: 2px solid #000000">
        </div>
        <div id="sender" style="width: 100%;height: 20%;overflow-y:scroll">
            <textarea id="sender_content" style="width: 100%;height: 100%;overflow-y:scroll"></textarea>
        </div>
    </div>
<?php require __DIR__ . '/../../backend/default/footer.php'; ?>
<script>
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
        alert('欢迎登陆客服系统')
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
                            html += `<div>`
                            html += `<img src="`
                            html += item.head_img_url
                            html += `"style="width: 50px;height: 50px;margin: 3px">`
                            html += `<span style="color: #000000">`
                            html += item.nickname
                            html += `</span>`
                            html += `<span style="color:white ;border-radius:2em;background:red;width: 10px;height: 10px">`
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

    ws.onmessage = function (evt) {
        var result = evt.data;
        var dom = '';
        dom = '<p>' + result + '</p>';
        $('.message').append(dom)
    };
    // websocket结束
</script>
