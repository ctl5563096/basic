<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;color: #0C0C0C">
        <a href=" <?php echo yii\helpers\Url::to(['backend/role/add']); ?> ">
            <button type="button" class="layui-btn layui-btn-lg"">
            <i class="layui-icon">&#xe654;</i>
            </button>
        </a>
        <table class="layui-table" lay-filter='table'>
            <colgroup>
                <col width="100">
                <col width="200">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>角色名</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $k => $v): ?>
                <tr>
                    <td><?php echo $k+1 ?></td>
                    <td><?php echo $v['role_name'] ?></td>
                    <td>
                        <button type="button" class="layui-btn" lay-filter="demo" data-id="<?php echo $v['id']?>" id="id" onclick="test(this)">
                            <input type="hidden" id="<?php echo $v['id']?>" value="<?php echo $v['id']?>">
                            <i class="layui-icon" lay-filter="demo">&#xe640;</i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use(['layer' , 'element' , 'table'], function(){
        var element = layui.element;
        var $ = layui.jquery, layer = layui.layer;
        var table = layui.table;
    });
    function test(o){
        var obj = $(o).children('input');
        var id = obj.val();
        var data = {id:id}
        $.post("<?php echo yii\helpers\Url::to(['backend/role/delete']); ?>" , data ,function (data) {
            if (data.code == 200){
                layer.msg(data.msg, {time: 1500, anim: 6});
                window.location.href = " <?php echo yii\helpers\Url::to(['backend/role/index']); ?> ";
            }else {
                layer.msg(data.msg, {time: 1500, anim: 6});
            }
        });
    }
</script>