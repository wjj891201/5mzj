<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerCssFile('@web/public/js/layui/css/layui.css', ['depends' => ['backend\assets\BackendAsset']]);
$this->registerJsFile('@web/public/js/layui/layui.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/lib/My97DatePicker/4.8/WdatePicker.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 楼盘开盘管理 <span class="c-gray en">&gt;</span> 新增开盘 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
        <label class="form-label col-xs-4 col-sm-2">开盘时间：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'open_time', ['options' => ['class' => false]])->textInput(['class' => 'input-text Wdate', 'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd',readOnly:true})", 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">参考单价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'price', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">参考总价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_price', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">交房时间：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'turn_time', ['options' => ['class' => false]])->textInput(['class' => 'input-text Wdate', 'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd',readOnly:true})", 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">入住时间：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'checkin_time', ['options' => ['class' => false]])->textInput(['class' => 'input-text Wdate', 'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd',readOnly:true})", 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">是否优选：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <?=
            $form->field($model, 'high_quality')->inline()->radioList([1 => '是', 0 => '否'], [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="radio-box"><input type="radio" name="' . $name . '" id="mortgage-' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="mortgage-' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">是否推荐：</label>
        <div class="formControls col-xs-8 col-sm-2 skin-minimal">
            <?=
            $form->field($model, 'recommend')->inline()->radioList([1 => '是', 0 => '否'], [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="radio-box"><input type="radio" name="' . $name . '" id="mortgage-' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="mortgage-' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">户型分布说明：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_type', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">开盘详情：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'open_remark', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:90%;'])->label(false); ?>
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