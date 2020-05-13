<?php require __DIR__ . '/../default/header.php'; ?>
<?php require __DIR__ . '/../default/menu.php'; ?>
<script src="/js/echarts.min.js"></script>
<div class="layui-body" style="color: #0C0C0C;margin-left: 20px;margin-top: 20px">
    <div  id="main" class="layui-col-md9"  style="width: 1200px;height:700px;">
    </div>
    <div  class="layui-col-md3">
        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">每日留言总数</h2>
                <div class="layui-colla-content layui-show"><?php echo $messageTotal ?></div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">每日新增文章</h2>
                <div class="layui-colla-content layui-show"><?php echo $articleTotal ?></div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">每日访问人数</h2>
                <div class="layui-colla-content layui-show"><?php echo $accessTotal ?></div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo $messageData ?>" id="message">
    <input type="hidden" value="<?php echo $articleData ?>" id="article">
    <input type="hidden" value="<?php echo $accessData ?>" id="access">
</div>
<?php require __DIR__ . '/../default/footer.php'; ?>
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        var message = $('#message').val();
        var article = $('#article').val();
        var access = $('#access').val();
        var arr = message.split(',');
        var arr1 = article.split(',');
        var arr2 = access.split(',');
        var option = {
            title: {
                text: '每日数据统计'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#6a7985'
                    }
                }
            },
            legend: {
                data: ['每小时留言', '每小时新增文章', '每小时访问人数']
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    boundaryGap: false,
                    data: ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00' ,'07:00' ,'08:00' ,'09:00' ,'10:00' ,'11:00', '12:00' ,'13:00' ,'14:00' ,'15:00' ,'16:00' ,'17:00' ,'18:00' ,'19:00' ,'20:00' ,'21:00' ,'22:00' ,'23:00']
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: '每小时留言',
                    type: 'line',
                    stack: '总量',
                    areaStyle: {},
                    data: arr
                },
                {
                    name: '每小时新增文章',
                    type: 'line',
                    stack: '总量',
                    areaStyle: {},
                    data: arr1
                },
                {
                    name: '每小时访问人数',
                    type: 'line',
                    stack: '总量',
                    label: {
                        normal: {
                            show: true,
                            position: 'top'
                        }
                    },
                    areaStyle: {},
                    data: arr2
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    });
</script>