<?php

use yii\helpers\Url;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>成功状态提示</div>
    <div class="Huialert Huialert-danger"><i class="Hui-iconfont">&#xe6a6;</i>危险状态提示</div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="l">
            <a href="javascript:;" onclick="operate_full('添加权限节点', '<?= Url::to(['access/add']) ?>')" class="btn btn-primary radius">
                <i class="Hui-iconfont">&#xe600;</i>
                添加权限节点
            </a>
        </span> 
        <span class="r">共有数据：<strong>54</strong> 条</span> 
    </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="7">权限节点</th>
            </tr>
            <tr class="text-c">
                <th width="40">ID</th>
                <th width="200">权限名称</th>
                <th>字段名</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-c">
                <td>1</td>
                <td>栏目添加</td>
                <td></td>
                <td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑', 'admin-permission-add.html', '1', '', '310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this, '1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(function () {
        parent.layer.closeAll();//关闭所有layer窗口
    });
</script>