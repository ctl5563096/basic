<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<style>
    .thumb {margin-left:5px; margin-top:15px; height:128px}
    #prevModal {width:100%; height:100%; text-align:center; display:none;}
    #img_prev {max-width:98%; max-height:98%; margin: 10px auto}
</style>
<div class="layui-body" style="color: #0C0C0C;margin-left: 20px;margin-top: 20px">
    <div class="layui-form-item" style="width: 500px">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item" style="width: 500px">
        <label class="layui-form-label">摘要</label>
        <div class="layui-input-block">
            <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class='layui-container' style='margin-top:15px;margin-left: 90px'>
        <button type="button" class="layui-btn" id="upload">
            <i class="layui-icon">&#xe67c;</i>选择图片
        </button>
        <div class='layui-input-block' id='div_prev' title=''></div>
    </div>
    <div id='prevModal'>
        <img id='img_prev'/>
    </div>
    <div class='layui-container upload' style='margin-top:15px;margin-left: 90px;display: none'>
        <button type="button" class="layui-btn" id="upd">
            <i class="layui-icon">&#xe67c;</i>上传
        </button>
    </div>
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use('element', function () {
        var element = layui.element;
    });
    layui.use(['upload', 'layer','element'], function () {
        var upload = layui.upload, layer = layui.layer;
        var uploadInst = upload.render({
            elem: '#upload',        //绑定元素
            accept: 'images',       //允许上传的文件类型
            auto: false,            //选完文件后不要自动上传
            bindAction: '#upd',     //指定一个按钮触发上传
            url: '/backend/photo/upload',        //上传接口
            choose: function (obj) {
                var files = obj.pushFile(); //将每次选择的文件追加到文件队列
                //图像预览，如果是多文件，会逐个添加。(不支持ie8/9)
                obj.preview(function (index, file, result) {
                    var imgobj = new Image();   //创建新img对象
                    imgobj.src = result;        //指定数据源
                    imgobj.className = 'thumb';
                    imgobj.onclick = function (result) {
                        //单击预览
                        img_prev.src = this.src;
                        var w = 500, h = 500;
                        layer.open({
                            title: '预览',
                            type: 1,
                            area: [w, h], //宽高
                            shade: false,
                            content: $('#prevModal')
                        });
                    };
                    document.getElementById("div_prev").appendChild(imgobj); //添加到预览区域
                    $('.upload').show()
                });
            },
            done: function (res) {

            },
            error: function () {
                // 上传异常
            }
        });
    });
</script>