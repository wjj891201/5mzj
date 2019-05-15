<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房源管理 <span class="c-gray en">&gt;</span> 小区信息列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l"> 
            <a class="btn btn-primary radius" data-title="新增小区" href="<?= Url::to(['village/add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 新增小区
            </a>
        </span>
        <div class="text-r">
            <form action="<?= Url::to(['village/list']) ?>" method="post">
                <input type="hidden" name="_csrf" id='csrf' value="<?= Yii::$app->request->csrfToken ?>">  
                <input type="text" class="input-text" value="<?= $vill_name ?>" style="width:250px" placeholder="小区名称" name="vill_name">
                <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 查询</button>
            </form>
        </div>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                    <th width="5%"></th>
                    <th width="15%">小区名称</th>
                    <th width="8%">所属区域</th>
                    <th width="8%">所属板块</th>
                    <th>地址</th>
                    <th width="15%">物业公司</th>
                    <th width="8%">创建人</th>
                    <th width="10%">添加时间</th>
                    <th width="8%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $vo): ?>
                    <tr class="text-c">
                        <td><?= $key + 1 ?></td>
                        <td><?= $vo['vill_name'] ?></td>
                        <td><?= $vo['area'] ?></td>
                        <td><?= $vo['plate_name'] ?></td>
                        <td><?= $vo['vill_add'] ?></td>
                        <td><?= $vo['prop_comp'] ?></td>
                        <td></td>
                        <td><?= $vo['cre_time'] ?></td>
                        <td class="f-14">
                            <a style="text-decoration:none" class="ml-5" href="<?= Url::to(['village/edit', 'id' => $vo['id']]) ?>" title="编辑">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a> 
                            <a title="删除" href="javascript:;" onclick="operate_del('<?= Url::to(['village/del', 'id' => $vo['id']]) ?>')" class="ml-5" style="text-decoration:none">
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