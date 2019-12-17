<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;"><form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block" style="width: 500px">
                    <input type="text" name="username" required  lay-verify="required" placeholder="输入用户名" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">角色名</label>
                <div class="layui-input-block" style="width: 500px">
                    <select name="role_id">
                        <option value="">请选择一个角色</option>
                        <?php foreach ($lists as $key => $val): ?>
                            <option value="<?php echo $val['id'] ?>"><?php echo $val['role_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div>
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;
    });
    layui.use(['form'],function(){
        var form=layui.form;
        form.on('submit(formDemo)', function(data){
            $.post(
                "<?php echo yii\helpers\Url::to(['backend/jurisdiction/distribution']); ?>",
                $(data.form).serialize(),
                function (obj) {
                    if (obj.code == 200) {
                        layer.msg(obj.msg, {time: 1500}, function () {
                            window.location.href = " <?php echo yii\helpers\Url::to(['backend/jurisdiction/index']); ?> ";
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