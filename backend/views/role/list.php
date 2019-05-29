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
    <?= $this->render('../set/prompt.php'); ?>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l"> 
            <a class="btn btn-primary radius" href="<?= Url::to(['role/add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 
                添加角色
            </a> 
        </span> 
    </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="6">角色管理</th>
            </tr>
            <tr class="text-c">
                <th width="10%">ID</th>
                <th width="30%">角色名称</th>
                <th>更新时间</th>
                <th>创建时间</th>
                <th width="10%">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_role as $key => $vo): ?>
                <tr class="text-c">
                    <td><?= $key + 1 ?></td>
                    <td><?= $vo['name'] ?></td>
                    <td><?= $vo['updated_time'] ?></td>
                    <td><?= $vo['created_time'] ?></td>
                    <td class="f-14">
                        <a title="编辑" href="<?= Url::to(['role/edit', 'id' => $vo['id']]) ?>" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="role_del(this,<?= $vo['id'] ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function role_del(obj, id) {
        layer.confirm('确认要删除吗？', {icon: 3, title: '提示', offset: '200px'}, function (index) {
            $.ajax({
                type: "GET",
                url: "<?= URL::to(['role/del']); ?>",
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    if (data == 404) {
                        layer.msg('sorry，您没有权限！', {icon: 2, time: 1000});
                    }
                    if (data == 1) {
                        $(obj).parents("tr").remove();
                        layer.msg('已成功删除!', {icon: 1, time: 1000});
                    }
                }
            });
        });
    }
</script>