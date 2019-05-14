<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房源管理 <span class="c-gray en">&gt;</span> 二手房列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l"> 
            <a class="btn btn-primary radius" data-title="新增房源" href="<?= Url::to(['sec-hand/add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 新增房源
            </a>
        </span>
        <div class="text-r">
            <input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
            <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜记录</button>
        </div>
    </div>
    <div class="mt-20">
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
                        <td><?= $vo['vill_id'] ?></td>
                        <td><?= $vo['price1'] ?></td>
                        <td><?= $vo['to_price1'] ?></td>
                        <td><?= $vo['hou_area'] ?></td>
                        <td><?= $vo['cre_time'] ?></td>
                        <td><?= $vo['mod_time'] ?></td>
                        <td></td>
                        <td class="f-14">
                            <a style="text-decoration:none" class="ml-5" href="<?= Url::to(['sec-hand/edit', 'id' => $vo['id']]) ?>" title="编辑">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a> 
                            <a title="删除" href="javascript:;" onclick="user_del(this, '1')" class="ml-5" style="text-decoration:none">
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