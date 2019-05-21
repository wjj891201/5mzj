<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\HouseSales;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房源管理 <span class="c-gray en">&gt;</span> 二手房列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <div class="text-c"> 
        <form action="<?= Url::to(['sec-hand/list']) ?>" method="get">
            联系方式：<input type="text" class="input-text" style="width:120px" name="mob_phone" value="<?= $mob_phone ?>">
            标题：<input type="text" class="input-text" style="width:120px" name="hou_name" value="<?= $hou_name ?>">
            所属小区：<input type="text" class="input-text" style="width:120px" name="vill_name" value="<?= $vill_name ?>">
            单价：<input type="text" class="input-text" style="width:80px;" name="price1_s" value="<?= $price1_s ?>">-<input type="text" class="input-text" style="width:80px;" name="price1_e" value="<?= $price1_e ?>">
            总价：<input type="text" class="input-text" style="width:80px;" name="to_price1_s" value="<?= $to_price1_s ?>">-<input type="text" class="input-text" style="width:80px;" name="to_price1_e" value="<?= $to_price1_e ?>">
            <input type="hidden" name="pub_state" value="<?= $pub_state ?>">
            <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 查询</button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l"> 
            <a class="btn btn-primary radius" data-title="新增房源" href="<?= Url::to(['sec-hand/add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 新增房源
            </a>
        </span>
        <span class="r">共有数据：<strong><?= $count ?></strong> 条</span>
    </div>
    <div class="mt-20">
        <div id="tab-system" class="HuiTab">
            <!--100未发布，101已发布，102下架，103待核实，104已核实，105不匹配-->
            <?php
            $pub_state_arr = [
                '103' => '待核实',
//                '104' => '已核实',
                '100' => '待发布',
                '101' => '已发布',
                '102' => '已下架',
//                '105' => '不匹配'
            ];
            ?>
            <div class="tabBar cl">
                <?php foreach ($pub_state_arr as $key => $vo): ?>
                    <span <?php if ($key == $pub_state): ?>class="current"<?php endif; ?> data-pub_state="<?= $key ?>"><?= $vo ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                    <th width="10%">房源编号</th>
                    <th>标题</th>
                    <th width="15%">所属小区</th>
                    <th width="8%">总价（万）</th>
                    <th width="10%">单价（元/平米）</th>
                    <th width="10%">面积（平米）</th>
                    <th width="10%">创建时间</th>
                    <th width="10%">更新时间</th>
                    <th width="8%">发布状态</th>
                    <th width="8%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $vo): ?>
                    <tr class="text-c">
                        <td><?= $vo['hou_account'] ?></td>
                        <td><?= $vo['hou_name'] ?></td>
                        <td><?= $vo['vill_name'] ?></td>
                        <td><?= $vo['to_price1'] ?></td>
                        <td><?= $vo['price1'] ?></td>
                        <td><?= $vo['hou_area'] ?></td>
                        <td><?= $vo['cre_time'] ?></td>
                        <td><?= $vo['mod_time'] ?></td>
                        <td class="td-status"><?= HouseSales::getHouPubState($vo['hou_pub_state']) ?></td>
                        <td class="f-14">
                            <?= HouseSales::getStateOperate($vo['hou_pub_state'], $vo['id'], 'sec-hand') ?>
                            <a style="text-decoration:none" class="ml-5" href="<?= Url::to(['sec-hand/edit', 'id' => $vo['id']]) ?>" title="编辑">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a> 
                            <a title="删除" href="javascript:;" onclick="operate_del('<?= Url::to(['sec-hand/del', 'id' => $vo['id']]) ?>')" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-c">
        <?=
        LinkPager::widget([
            'pagination' => $pages,
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页'
        ]);
        ?>
    </div>
</div>
<script>
    $(function () {
        $('.tabBar>span').click(function () {
            var pub_state = $(this).data('pub_state');
            var url = window.location.href;
            if (url.indexOf("pub_state") >= 0) {
                var suffix = url.substr(url.lastIndexOf("pub_state"));
                url = url.replace(suffix, 'pub_state=' + pub_state);
                self.location.href = url;
            } else {
                self.location.href = url + '?pub_state=' + pub_state;
            }
        });
    });
</script>