<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<article class="page-container">
    <?= $this->render('../set/prompt.php'); ?>
    <?php
    $form = ActiveForm::begin([
                'options' => ['class' => 'form form-horizontal', 'id' => 'form-member-add'],
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'error_info'],
                ]
    ]);
    ?>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">上级权限：</label>
        <div class="formControls col-xs-8 col-sm-9"> 
            <?= $form->field($model, 'pid', ['template' => "<span class=\"select-box\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($list, ['class' => 'select', 'size' => 1])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'sort', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限标题：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'title', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>Urls：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'urls', ['options' => ['class' => false]])->textarea(['class' => 'textarea'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <?= Html::submitButton('&nbsp;&nbsp;提交&nbsp;&nbsp;', ['class' => 'btn btn-primary radius']); ?>
            <?= Html::button('&nbsp;&nbsp;取消&nbsp;&nbsp;', ['onclick' => 'layer_close();', 'class' => 'btn btn-default radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</article>