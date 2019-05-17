<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 楼盘信息管理 <span class="c-gray en">&gt;</span> 添加楼盘 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?php
    $form = ActiveForm::begin([
                'options' => ['class' => 'form form-horizontal', 'id' => 'form-article-add'],
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'error_info'],
                ]
    ]);
    ?>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">楼盘名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">楼盘地址：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_add', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">产权年限：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_years', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">建筑面积：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_area', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">开发商：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'comp_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">开发商联系人：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'comp_lman', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">联系电话：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'comp_tel', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">用途类型：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_usetype', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($houUsetype, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房屋结构类别：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_str', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($houBuildstr, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">建筑类别：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_type', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($buildType, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">交付标准：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_fix_state', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($houFixState, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">楼盘标签：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <?=
            $form->field($model, 'lab')->checkboxList($buildLab, [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="check-box" style="width:18%;"><input type="checkbox" name="' . $name . '" id="_' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="_' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">楼盘简介：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_remark', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <?= Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 确定', ['class' => 'btn btn-secondary radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>