<?php
    use app\models\Menu;
    use \yii\db\Query;

    $levelZero = (new Query())->select('id,name')->from('menu_list')->where("level = 0 AND is_delete = 'no' AND is_use = 'yes'")->all();
    $levelOne = (new Query())->select('name,controller,action,parent_id')->from('menu_list')->where("level = 1 AND is_delete = 'no' AND is_use = 'yes'")->all();

    $parent = [];
    $levelOneRead = [];
    foreach ($levelOne as $kk => $vv){
        $parent[$kk] = $vv['parent_id'];
    }
    array_unique($parent);
    foreach ($levelOne as $kkk => $vvv){
        if (in_array($vvv['parent_id'], $parent, false)){
            $levelOneRead[$vvv['parent_id']][$kkk] = $vvv;
        }
    }

?>
<div class="layui-side layui-bg-blue">
    <div class="layui-side-scroll layui-bg-blue">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <?php foreach ($levelZero as $k => $v):?>
                <li class="layui-nav-item layui-bg-blue">
                    <a href="javascript:;"><?php echo $v['name'] ?></a>
                    <?php foreach ($levelOneRead as $rk => $rv): ?>
                        <?php if ((int)$rk === (int)$v['id']): ?>
                            <?php foreach ($rv as $item): ?>
                                <dl class="layui-nav-child">
                                    <dd><a href="<?php echo yii\helpers\Url::to(['backend/'.$item['controller'].'/'.$item['action']]); ?>"><?php echo $item['name'] ?></a></dd>
                                </dl>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
