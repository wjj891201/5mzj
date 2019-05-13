<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 二手房管理 <span class="c-gray en">&gt;</span> 添加二手房 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <?php
    $form = ActiveForm::begin([
                'options' => ['class' => 'form form-horizontal', 'id' => 'form-article-add'],
                'fieldConfig' => [
                    'errorOptions' => ['tag' => 'span', 'class' => 'error_info', 'style' => 'padding-left:10px;'],
                ]
    ]);
    ?>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">标题：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房屋地址：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_building', ['template' => "{input}&nbsp;栋{error}"])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'hou_cell', ['template' => "{input}&nbsp;单元{error}"])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'hou_room', ['template' => "{input}&nbsp;室{error}"])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房屋面积：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_area', ['template' => "{input}&nbsp;平米{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">售价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_price1', ['template' => "{input}&nbsp;万元{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">单价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'price1', ['template' => "{input}&nbsp;元{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'type_hab', ['template' => "{input}&nbsp;室{error}"])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'type_hall', ['template' => "{input}&nbsp;厅{error}"])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'type_toilet', ['template' => "{input}&nbsp;卫{error}"])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">朝向：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_turn', ['template' => "<span class=\"select-box\" style=\"width:70%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($direction, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">装修类型：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_fix_state', ['template' => "<span class=\"select-box\" style=\"width:70%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($decoration, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房屋类别：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_usetype', ['template' => "<span class=\"select-box\" style=\"width:70%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($house_type, ['class' => 'select'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">楼层：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_floor', ['template' => "{input}&nbsp;层{error}"])->textInput(['class' => 'input-text', 'placeholder' => '所在楼层', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'hou_floor_acc', ['template' => "{input}&nbsp;层{error}"])->textInput(['class' => 'input-text', 'placeholder' => '总楼层', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">称呼：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'house_owner', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">手机号：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'mob_phonel', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">描述：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_remark', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房源标签：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?=
            $form->field($model, 'lab')->checkboxList($build_lab, [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<label style="display:block;width:15%;float:left;"><input type="checkbox" name="' . $name . '" id="_' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="_' . $index . '" style="margin-left:5px;">' . $label . '</label></label>';
                    return $return;
                },
                'style' => 'width:70%;'
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">是否解压：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <?=
            $form->field($model, 'is_mortgage')->inline()->radioList([1 => '是', 0 => '否'], [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="radio-box"><input type="radio" name="' . $name . '" id="mortgage-' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="mortgage-' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <?= Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 确定', ['class' => 'btn btn-secondary radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
    });
</script>
