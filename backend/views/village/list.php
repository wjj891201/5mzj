<?php

use yii\helpers\Url;
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
            <input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
            <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜记录</button>
        </div>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                    <th width="80"></th>
                    <th width="100">小区名称</th>
                    <th width="90">所属区域</th>
                    <th width="130">所属板块</th>
                    <th width="130">地址</th>
                    <th width="130">物业公司</th>
                    <th>创建人</th>
                    <th>修改时间</th>
                    <th width="60">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $vo): ?>
                    <tr class="text-c">
                        <td>1</td>
                        <td>张三</td>
                        <td>192.168.0.2</td>
                        <td>2015.01.16 22:12:24</td>
                        <td class="text-l">http://www.h-ui,net/</td>
                        <td>192.168.0.2</td>
                        <td>192.168.0.2</td>
                        <td>192.168.0.2</td>
                        <td class="f-14">
                            <a title="删除" href="javascript:;" onclick="user_del(this, '1')" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>