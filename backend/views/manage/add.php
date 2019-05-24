<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 账号管理 <span class="c-gray en">&gt;</span> 添加账号 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<article class="page-container">
    <?php
    $form = ActiveForm::begin([
                'options' => ['class' => 'form form-horizontal', 'id' => 'form-admin-add'],
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'error_info'],
                ]
    ]);
    ?>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">用户名：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'username', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">姓名：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'real_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">性别：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <?=
            $form->field($model, 'sex')->inline()->radioList([0 => '女', 1 => '男'], [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="radio-box"><input type="radio" name="' . $name . '" id="mortgage-' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="mortgage-' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">身份证号码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'id_card', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">手机号码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'telphone', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">邮箱：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'email', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'password', ['options' => ['class' => false]])->passwordInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">确认密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 're_password', ['options' => ['class' => false]])->passwordInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <?= Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 确定', ['class' => 'btn btn-primary radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</article>
<script type="text/javascript">
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
    });
</script>