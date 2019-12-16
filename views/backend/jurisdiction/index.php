<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;color: #0C0C0C">
        <table class="layui-table" lay-filter='table'>
            <colgroup>
                <col width="200">
                <col width="200">
                <col width="200">
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>角色名</th>
                <th>角色权限</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($lists as $k => $v): ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $k ?></td>
                    <td><?php echo $v ?></td>
                    <td>
                        <a href=" <?php echo yii\helpers\Url::toRoute(['backend/jurisdiction/edit' ,'role_name'=>$k]); ?>">
                            <button type="button" class="layui-btn" lay-filter="demo" data-id="" id="id" onclick="test(this)">
                                <i class="layui-icon" lay-filter="demo">&#xe642;</i>
                            </button>
                        </a>
                    </td>
                </tr>
            <?php $i++; ?>
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
</script>