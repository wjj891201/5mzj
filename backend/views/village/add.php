<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerCssFile('@web/public/js/layui/css/layui.css', ['depends' => ['backend\assets\BackendAsset']]);
$this->registerJsFile('@web/public/js/layui/layui.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
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
        <label class="form-label col-xs-4 col-sm-2">小区名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'id' => 'vill_name'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">详细地址：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_add', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">物业公司：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'prop_comp', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">所属区域：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_region', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($area, ['class' => 'select', 'id' => 'area_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">所在街道：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_street', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($street, ['class' => 'select', 'id' => 'street_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">所在板块：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'plate_id', ['template' => "<span class=\"select-box\" style=\"width:90%;\">{input}</span>{error}", 'options' => ['class' => false]])->dropDownList($plate, ['class' => 'select', 'id' => 'plate_here'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">建筑年代：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'build_age', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">总户数：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_hou_holds', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">总楼栋数：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_building', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">停车位：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'park_space', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">绿化率：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'green_rate', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">容积率：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'plot_rate', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">物业费：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_cost', ['template' => "{input}&nbsp;元/平方米{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
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
        $('#area_here').change(function () {
            $.ajax({
                type: 'post',
                url: '<?= Url::to(['village/ajax-get-street-plate']) ?>',
                dataType: "json",
                data: {_csrf: '<?= Yii::$app->request->csrfToken ?>', area_id: $(this).val()},
                success: function (data) {
                    var street = palte = "<option value=''>请选择</option>";
                    $.each(data.street, function (idx, item) {
                        street += "<option value=" + item.streetID + ">" + item.street + "</option>";
                    });
                    $('#street_here').empty().append(street);
                    $.each(data.plate, function (idx, item) {
                        palte += "<option value=" + item.id + ">" + item.plate_name + "</option>";
                    });
                    $('#plate_here').empty().append(palte);
                }
            });
        });
    });
    //引入自定义插件
    layui.config({
        base: '/public/js/yutons-mods/'
    }).use(['yutons_sug'], function () {
        var yutons_sug = layui.yutons_sug;
        sessionStorage.setItem("url", "json/yutons_sug.json");
        yutons_sug.render({
            id: "vill_name",
            height: "167",
            cols: [
                [{
                        field: 'vill_name',
                        title: '小区名称'
                    }, {
                        field: 'vill_add',
                        title: '地址'
                    }, {
                        field: 'vill_region',
                        title: '区域'
                    }, {
                        field: 'location',
                        title: '经/纬度'
                    }]
            ],
            type: 'sugTable',
            url: sessionStorage.getItem("url") + "?params="
        });
    });
</script>