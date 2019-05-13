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
        <label class="form-label col-xs-4 col-sm-2">描述：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this, 200)"></textarea>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">产品规格：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="输入长度" value="" class="input-text" style=" width:25%">
            MM
            <input type="text" name="" id="" placeholder="输入宽度" value="" class="input-text" style=" width:25%">
            MM
            <input type="text" name="" id="" placeholder="输入高度" value="" class="input-text" style=" width:25%">
            MM </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">所属供应商：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="" value="" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">价格计算单位：</label>
        <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select class="select">
                    <option>请选择</option>
                    <option value="1">件</option>
                    <option value="2">斤</option>
                    <option value="3">KG</option>
                    <option value="4">吨</option>
                    <option value="5">套</option>
                </select>
            </span> </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">产品重量：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="" value="" class="input-text" style="width:90%">
            kg</div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">产品展示价格：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="" value="" class="input-text" style="width:90%">
            元</div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">市场价格：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="" value="" class="input-text" style="width:90%">
            元</div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">成本价格：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="" value="" class="input-text" style="width:90%">
            元</div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">最低销售价格：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="" value="" class="input-text" style="width:90%">
            元</div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">销售开始时间：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss', maxDate: '#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:180px;">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">销售结束时间：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss', minDate: '#F{$dp.$D(\'datemin\')}'})" id="datemax" class="input-text Wdate" style="width:180px;">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">产品关键字：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="" id="" placeholder="多个关键字用英文逗号隔开，限10个关键字" value="" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <div class="uploader-thum-container">
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
                <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
            </div>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">图片上传：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <div class="uploader-list-container">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker-2"></div>
                        <p>或将照片拖到这里，单次最多可选300张</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
                    <div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div>
                        <div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
        <div class="formControls col-xs-8 col-sm-9"> 
            <script id="editor" type="text/plain" style="width:100%;height:400px;"></script> 
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
            <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
            <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
