<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房源管理 <span class="c-gray en">&gt;</span> 小区信息列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <span class="select-box">
                <select name="" class="select">
                    <option value="0">全部栏目</option>
                    <option value="1">新闻资讯</option>
                    <option value="11">├行业动态</option>
                    <option value="12">├行业资讯</option>
                    <option value="13">├行业新闻</option>
                </select>
            </span>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">排序值：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="0" placeholder="" id="" name="">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>发布日期：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss', maxDate: '#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>结束日期：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss', minDate: '#F{$dp.$D(\'datemin\')}'})" id="datemax" class="input-text Wdate">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">图片作者：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="0" placeholder="" id="" name="">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">图片来源：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="0" placeholder="" id="" name="">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">关键词：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="0" placeholder="" id="" name="">
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <button onClick="article_save_submit();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
            <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
            <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
