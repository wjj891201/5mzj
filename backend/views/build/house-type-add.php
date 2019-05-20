<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerCssFile('@web/public/js/layui/css/layui.css', ['depends' => ['backend\assets\BackendAsset']]);
$this->registerJsFile('@web/public/js/layui/layui.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 楼盘户型管理 <span class="c-gray en">&gt;</span> 添加户型 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
            <?= $form->field($model, 'build_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'id' => 'build_name'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'type_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型类别：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'type_cate', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($houRoomType, ['class' => 'select', 'id' => 'area_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">建面：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'cover_area', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">参考均价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'average_price', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">参考总价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'total_price', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'type_hab')->textInput(['class' => 'input-text', 'placeholder' => '室', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'type_hall')->textInput(['class' => 'input-text', 'placeholder' => '厅', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'type_toilet')->textInput(['class' => 'input-text', 'placeholder' => '卫', 'style' => 'width:70%;'])->label(false); ?>
            <?= $form->field($model, 'type_kit')->textInput(['class' => 'input-text', 'placeholder' => '厨', 'style' => 'width:70%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型标签：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <?=
            $form->field($model, 'lab')->checkboxList($houseTypeLab, [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="check-box" style="width:18%;"><input type="checkbox" name="' . $name . '" id="_' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="_' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型简介：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'type_remark', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型楼栋分布：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'type_dis', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <?= Html::submitButton('<i class="Hui-iconfont">&#xe632;</i> 确定', ['class' => 'btn btn-secondary radius']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
    });
    //引入自定义插件
    layui.config({
        base: '/public/js/yutons-mods/'
    }).use(['yutons_sug'], function () {
        var yutons_sug = layui.yutons_sug;
        sessionStorage.setItem("url", "<?= Url::to(['build/get-builds']) ?>");
        yutons_sug.render({
            id: "build_name",
            cols: [
                [{
                        field: 'build_name',
                        title: '楼盘名称'
                    }, {
                        field: 'build_add',
                        title: '楼盘地址'
                    }, {
                        field: 'comp_name',
                        title: '开发商'
                    }]
            ],
            type: 'sugTable',
            url: sessionStorage.getItem("url") + "?params="
        });
    });
</script>