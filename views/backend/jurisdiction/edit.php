<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;color: #0C0C0C">
        <label class="layui-form-label" style="width: 300px;text-align: left">角色:<?php echo $role_name; ?></label>
        <form class="layui-form">
            <input type="hidden" value="<?php echo $roleId ?>" name="id">
            <div class="layui-form-item" style="height: 200px;">
                <label class="layui-form-label" style="text-align: left">权限选择:</label>
                <div class="layui-input-block">
                    <?php foreach ($jList as $k => $v): ?>
                        <input type="checkbox" name="role[]" title="<?php echo $v['role_name'] ?>" lay-skin="primary" value="<?php echo $v['id'] ?>" <?php
                            if (in_array($v['id'] ,$jRole )){
                                echo 'checked';
                            }
                        ?>>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use(['layer' , 'element' , 'table' ,'form'], function(){
        var element = layui.element;
        var $ = layui.jquery, layer = layui.layer;
        var table = layui.table;
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)' ,function (data) {
            $.post(
                "<?php echo yii\helpers\Url::to(['backend/jurisdiction/edit']); ?>",
                $(data.form).serialize(),
                function (obj) {
                    if (obj.code == 200) {
                        layer.msg(obj.msg, {time: 1500}, function () {
                            window.location.reload()
                        });
                    }
                    else {
                        layer.msg(obj.msg, {time: 1500, anim: 6});
                    }
                }
            );
            return false;
        })
        form.render('select');
    });
</script>