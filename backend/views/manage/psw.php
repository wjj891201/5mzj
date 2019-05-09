<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<article class="page-container">
    <?php
    $form = ActiveForm::begin(['options' => ['class' => 'form form-horizontal', 'id' => 'form-change-password']]);
    ?>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>原始密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'oldpass', ['options' => ['class' => false]])->passwordInput(['class' => 'input-text', 'placeholder' => '原始密码'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'password', ['options' => ['class' => false]])->passwordInput(['class' => 'input-text', 'placeholder' => '新密码'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 're_password', ['options' => ['class' => false]])->passwordInput(['class' => 'input-text', 'placeholder' => '确认密码'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <?= Html::submitButton('&nbsp;&nbsp;保存&nbsp;&nbsp;', ['class' => 'btn btn-primary radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</article>