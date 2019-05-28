<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 管理员管理 
    <span class="c-gray en">&gt;</span> 角色管理 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<article class="page-container">
    <?php
    $form = ActiveForm::begin([
                'options' => ['class' => 'form form-horizontal', 'id' => 'form-admin-role-add'],
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'error_info'],
                ]
    ]);
    ?>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">角色名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'name', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">权限：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?php foreach ($access_list as $key => $vo): ?>
                <dl class="permission-list">
                    <dt>
                        <label><input type="checkbox" value="<?= $vo['id'] ?>" name="access_ids[]" <?php if (in_array($vo['id'], $have_access)): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;<?= $vo['title'] ?></label>
                    </dt>
                    <?php if (!empty($vo['child'])): ?>
                        <dd>
                            <dl class="cl permission-list2">
                                <dd style="margin-left: 0px;">
                                    <?php foreach ($vo['child'] as $key => $v): ?>
                                        <label>
                                            <input type="checkbox" value="<?= $v['id'] ?>" name="access_ids[]" <?php if (in_array($v['id'], $have_access)): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;<?= $v['title'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                </dd>
                            </dl>
                        </dd>
                    <?php endif; ?>
                </dl>
            <?php endforeach; ?> 
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <?= Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 确定', ['class' => 'btn btn-secondary radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</article>

<script type="text/javascript">
    $(function () {
        $(".permission-list dt input:checkbox").click(function () {
            $(this).closest("dl").find("dd input:checkbox").prop("checked", $(this).prop("checked"));
        });
        $(".permission-list2 dd input:checkbox").click(function () {
            var l = $(this).parent().parent().find("input:checked").length;
            var l2 = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
            if ($(this).prop("checked")) {
                $(this).closest("dl").find("dt input:checkbox").prop("checked", true);
                $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", true);
            } else {
                if (l == 0) {
                    $(this).closest("dl").find("dt input:checkbox").prop("checked", false);
                }
                if (l2 == 0) {
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", false);
                }
            }
        });
    });
</script>