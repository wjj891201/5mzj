<?php

use yii\web\View;
use yii\helpers\Url;

$this->registerJsFile('@web/public/js/treeTable/jquery.treeTable.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="l">
            <a href="javascript:;" onclick="operate_small('添加权限节点', '<?= Url::to(['access/add']) ?>')" class="btn btn-primary radius">
                <i class="Hui-iconfont">&#xe600;</i>
                添加权限节点
            </a>
        </span> 
    </div>
    <table class="table table-border table-bordered table-bg" id="treeTable_1">
        <thead>
            <tr>
                <th scope="col" colspan="7">权限节点</th>
            </tr>
            <tr class="text-c">
                <th width="5%">ID</th>
                <th width="20%">权限标题</th>
                <th>Urls</th>
                <th width="20%">创建时间</th>
                <th width="10%">排序</th>
                <th width="10%">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($access as $key => $vo): ?>
                <?php if ($vo['pid'] == 0): ?>
                    <?php $p_key = $key + 1; ?>
                <?php endif; ?>
                <tr class="text-c" id="<?= $key + 1; ?>" <?php if ($vo['pid'] != 0): ?>pId="<?= $p_key; ?>"<?php endif; ?>>
                    <td style="text-align: left;"><?= $key + 1 ?></td>
                    <td style="text-align: left;"><?= $vo['title'] ?></td>
                    <td>
                        <?php
                        $tmp_urls = @json_decode($vo['urls'], true);
                        $tmp_urls = $tmp_urls ? $tmp_urls : [];
                        ?>
                        <?= implode("<br/>", $tmp_urls); ?>
                    </td>
                    <td><?= $vo['created_time'] ?></td>
                    <td><?= $vo['sort'] ?></td>
                    <td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑', 'admin-permission-add.html', '1', '', '310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this, '1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(function () {
        var option = {
            theme: 'default',
            expandLevel: 1,
            beforeExpand: function ($treeTable, id) {
                //判断id是否已经有了孩子节点，如果有了就不再加载，这样就可以起到缓存的作用
                if ($('.' + id, $treeTable).length) {
                    return;
                }
                $treeTable.addChilds(html);
            },
            onSelect: function ($treeTable, id) {
                window.console && console.log('onSelect:' + id);
            }
        };
        $('#treeTable_1').treeTable(option);
//        parent.layer.closeAll();//关闭所有layer窗口
//        parent.layer.close(layer.index);
//        parent.layer.closeAll('iframe');
//        var index = parent.layer.getFrameIndex(window.name);
//        parent.layer.close(index);
    });
</script>