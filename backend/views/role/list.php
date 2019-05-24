<?php

use yii\helpers\Url;
?>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 管理员管理 
    <span class="c-gray en">&gt;</span> 角色管理 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l"> 
            <a class="btn btn-primary radius" href="<?= Url::to(['role/add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 
                添加角色
            </a> 
        </span> 
        <span class="r">共有数据：<strong>54</strong> 条</span> 
    </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="6">角色管理</th>
            </tr>
            <tr class="text-c">
                <th width="40">ID</th>
                <th width="200">角色名</th>
                <th>用户列表</th>
                <th width="300">描述</th>
                <th width="70">操作</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-c">
                <td>1</td>
                <td>超级管理员</td>
                <td><a href="#">admin</a></td>
                <td>拥有至高无上的权利</td>
                <td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑', 'admin-role-add.html', '1')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this, '1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
        </tbody>
    </table>
</div>