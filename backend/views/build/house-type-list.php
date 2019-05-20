<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 楼盘户型管理 <span class="c-gray en">&gt;</span> 户型列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        户型名称：<input type="text" name="type_name" style="width:250px" class="input-text">
        建面：<input type="text" name="cover_area" style="width:250px" class="input-text">
        <button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 查询</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="l">
            <a class="btn btn-primary radius" href="<?= Url::to(['build/house-type-add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 添加户型
            </a>
        </span>
        <span class="r">共有数据：<strong>54</strong> 条</span> 
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
                <tr class="text-c">
                    <th width="12%">户型编号</th>
                    <th width="10%">楼盘</th>
                    <th>户型名称</th>
                    <th width="10%">室-厅-卫-厨</th>
                    <th width="8%">户型类别</th>
                    <th width="5%">建面/m²</th>
                    <th width="10%">参考均价/元/m²</th>
                    <th width="10%">参考总价/万</th>
                    <th width="10%">更新时间</th>
                    <th width="8%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $vo): ?>
                    <tr class="text-c">
                        <td><?= $vo['type_code'] ?></td>
                        <td><?= $vo['build_name'] ?></td>
                        <td><?= $vo['type_name'] ?></td>
                        <td><?= $vo['type_hab'] ?>室<?= $vo['type_hab'] ?>厅<?= $vo['type_hab'] ?>卫<?= $vo['type_hab'] ?>厨</td>
                        <td><?= $houRoomType[$vo['type_cate']] ?></td>
                        <td><?= $vo['cover_area'] ?></td>
                        <td><?= $vo['average_price'] ?></td>
                        <td><?= $vo['total_price'] ?></td>
                        <td><?= $vo['cre_time'] ?></td>
                        <td class="f-14 td-manage">
                            <a style="text-decoration:none" class="ml-5" href="<?= Url::to(['build/house-type-edit']) ?>" title="编辑">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a> 
                            <a style="text-decoration:none" class="ml-5" onClick="article_del(this, '10001')" href="javascript:;" title="删除">
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