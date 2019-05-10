<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房源管理 <span class="c-gray en">&gt;</span> 添加小区 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>小区名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">详细地址：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_add', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">物业公司：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'prop_comp', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属区域：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_region', ['template' => "<span class=\"select-box\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($area, ['class' => 'select', 'id' => 'area_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所在街道：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_street', ['template' => "<span class=\"select-box\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($street, ['class' => 'select', 'id' => 'street_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所在板块：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'plate_id', ['template' => "<span class=\"select-box\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($plate, ['class' => 'select', 'id' => 'plate_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">建筑年代：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_age', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">总户数：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_hou_holds', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">总楼栋数：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_building', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">停车位：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'park_space', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">绿化率：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'green_rate', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">容积率：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'plot_rate', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">物业费：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_cost', ['options' => ['class' => false]])->textInput(['class' => 'input-text'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 确定</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(function () {
        $('#area_here').change(function () {
            $.ajax({
                type: 'post',
                url: '<?= Url::to(['claims-right/ajax-get-region']) ?>',
                dataType: "json",
                data: {_csrf: '<?= Yii::$app->request->csrfToken ?>', type: type, parent_id: id},
                success: function (data) {

                }
            });
        });
    });
</script>