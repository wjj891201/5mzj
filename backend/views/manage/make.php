<?php

use yii\helpers\Url;
?>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 账号管理 
    <span class="c-gray en">&gt;</span> 分配角色 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">账号名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <?= $userDetail->username ?>
                <input type="hidden" name="_csrf" id='csrf' value="<?= Yii::$app->request->csrfToken ?>"> 
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">角色：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <dl class="permission-list">
                    <dd>
                        <?php foreach ($role as $key => $vo): ?>
                            <dl class="cl permission-list2">
                                <dt>
                                    <input type="checkbox" <?php if (in_array($vo['id'], $have_role)): ?>checked="checked"<?php endif; ?> value="<?= $vo['id'] ?>" name="role_id[]">
                                    <?= $vo['name'] ?>
                                    </label>
                                </dt>
                            </dl>
                        <?php endforeach; ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-success radius">
                    <i class="icon-ok"></i> 确定
                </button>
            </div>
        </div>
    </form>
</article>