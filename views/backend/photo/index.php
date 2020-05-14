<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<div class="layui-body" style="color: #0C0C0C;margin-left: 20px;margin-top: 20px">
    <ul class="layui-timeline">
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis"></i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title">8月18日</h3>
                <p>
                    layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                    <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                    <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
                </p>
            </div>
        </li>
    </ul>
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use(['form', 'element'], function () {
        var element = layui.element;
        var form = layui.form;
    });
</script>