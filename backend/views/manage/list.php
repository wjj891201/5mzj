<?php

use yii\web\View;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerJsFile('@web/public/lib/My97DatePicker/4.8/WdatePicker.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/lib/datatables/1.10.0/jquery.dataTables.min.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/lib/laypage/1.2/laypage.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
?>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 管理员管理 
    <span class="c-gray en">&gt;</span> 账号列表 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="<?= Url::to(['manage/add']) ?>" class="btn btn-primary radius">
                <i class="Hui-iconfont">&#xe600;</i> 添加账号
            </a>
        </span> 
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="9">账号列表</th>
                </tr>
                <tr class="text-c">
                    <th width="10%">序号</th>
                    <th width="10%">用户名</th>
                    <th width="10%">姓名</th>
                    <th width="10%">性别</th>
                    <th>身份证号码</th>
                    <th width="10%">手机号</th>
                    <th width="15%">电子邮箱</th>
                    <th width="10%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $vo): ?>
                    <tr class="text-c">
                        <td><?= $key + 1 ?></td>
                        <td><?= $vo['username'] ?></td>
                        <td><?= $vo['real_name'] ?></td>
                        <td><?= $vo['sex'] == 0 ? '女' : '男'; ?></td>
                        <td><?= $vo['id_card'] ?></td>
                        <td><?= $vo['telphone'] ?></td>
                        <td><?= $vo['email'] ?></td>
                        <td class="td-manage">
                            <a title="编辑" href="<?= Url::to(['manage/edit', 'id' => $vo['id']]); ?>" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="operate_del('<?= Url::to(['manage/del', 'id' => $vo['id']]) ?>')" class="ml-5" style="text-decoration:none">
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