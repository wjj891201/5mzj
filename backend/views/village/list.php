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
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="80">ID</th>
                    <th width="100">用户名</th>
                    <th width="90">IP</th>
                    <th width="130">访问时间</th>
                    <th>URL</th>
                    <th width="60">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-c">
                    <td><input type="checkbox" value="1" name=""></td>
                    <td>1</td>
                    <td>张三</td>
                    <td>192.168.0.2</td>
                    <td>2015.01.16 22:12:24</td>
                    <td class="text-l">http://www.h-ui,net/</td>
                    <td class="f-14"><a title="删除" href="javascript:;" onclick="user_del(this, '1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>