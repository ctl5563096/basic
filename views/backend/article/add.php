<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<style>
    .layui-form-item{
        margin-top: 50px;
    }
</style>
<div class="layui-body" style="color: #0C0C0C">
    <form class="layui-form" style="margin: 30px;width: 1500px"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
        <div class="layui-form-item">
            <label class="layui-form-label">文章标题</label>
            <div class="layui-input-block">
                <input type="text" name="article_name" placeholder="请输入文章标题" autocomplete="off" class="layui-input" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">作者昵称</label>
            <div class="layui-input-block">
                <input type="text" name="author_nickname" placeholder="请输入作者昵称" autocomplete="off" class="layui-input" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章模块</label>
            <div class="layui-input-block">
                <select name="module" lay-filter="aihao">
                    <option>请选择文章所属模块</option>
                    <option value="personal">个人</option>
                    <option value="php">PHP</option>
                    <option value="Go">Go</option>
                    <option value="system">操作系统</option>
                    <option value="sql">数据库</option>
                    <option value="other">杂谈</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章标签</label>
            <div class="layui-input-block">
                <input type="checkbox" name="label[碎谈]" title="碎谈">
                <input type="checkbox" name="label[阅读]" title="阅读">
                <input type="checkbox" name="label[生活]" title="生活">
                <input type="checkbox" name="label[爱情]" title="爱情">
                <input type="checkbox" name="label[技术]" title="技术">
                <input type="checkbox" name="label[PHP]" title="PHP">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否展示</label>
            <div class="layui-input-block">
                <input type="radio" name="is_display" value="no" title="否">
                <input type="radio" name="is_display" value="yes" title="是" checked>
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 100px">
            <label class="layui-form-label">文章内容</label>
            <div class="layui-input-block">
                <script id="container" name="content" class="layui-textarea" type="text/plain" lay-verify="required">
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <?php require __DIR__ . '/../default/footer.php'; ?>
    <script type="text/javascript" src="/ue/ueditor.config.js"></script>
    <script type="text/javascript" src="/ue/ueditor.all.js"></script>
    <script type="text/javascript">
        var editor = UE.getEditor('container',{
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            initialFrameWidth: 1200,
            initialFrameHeight: 400,
            saveInterval:10000,
            allowDivTransToP: false
        });
        layui.use('element', function(){
            var element = layui.element;
        });
        layui.use('form', function () {
            var form = layui.form;
            form.on('submit(formDemo)', function(data){
                $.post(
                    "<?php echo yii\helpers\Url::to(['backend/article/add']); ?>",
                    $(data.form).serialize(),
                    function (obj) {
                        console.log(obj.msg)
                        if (obj.code === 200) {
                            layer.msg(obj.msg, {time: 1500}, function () {
                                window.location.href = '/backend/article/index'
                            });
                        }
                        else {
                            layer.msg(obj.msg, {time: 1500, anim: 6});
                        }
                    }
                    );
                return false;
            });
        });
    </script>
