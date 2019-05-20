<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 楼盘开盘管理 <span class="c-gray en">&gt;</span> 楼盘开盘列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <div class="text-c">
        <form action="<?= Url::to(['build/open-list']) ?>" method="get">
            楼盘名称：<input type="text" name="build_name" value="<?= $build_name ?>" style="width:120px" class="input-text">
            <button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 查询</button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="l">
            <a class="btn btn-primary radius" href="<?= Url::to(['build/open-add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 新增开盘
            </a>
        </span> 
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
                <tr class="text-c">
                    <th>楼盘名称</th>
                    <th width="10%">开盘时间</th>
                    <th width="10%">参考单价</th>
                    <th width="10%">参考总价</th>
                    <th width="10%">交房时间</th>
                    <th width="10%">创建时间</th>
                    <th width="8%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $vo): ?>
                    <tr class="text-c">
                        <td><?= $vo['build_name'] ?></td>
                        <td><?= $vo['open_time'] ?></td>
                        <td><?= $vo['price'] ?></td>
                        <td><?= $vo['to_price'] ?></td>
                        <td><?= $vo['turn_time'] ?></td>
                        <td><?= $vo['cre_time'] ?></td>
                        <td class="f-14 td-manage">
                            <a style="text-decoration:none" class="ml-5" href="<?= Url::to(['build/open-edit', 'id' => $vo['id']]) ?>" title="编辑">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a> 
                            <a style="text-decoration:none" class="ml-5" onClick="operate_del('<?= Url::to(['build/open-del', 'id' => $vo['id']]) ?>')" href="javascript:;" title="删除">
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