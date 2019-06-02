<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerCssFile('@web/public/js/layui/css/layui.css', ['depends' => ['backend\assets\BackendAsset']]);
$this->registerCssFile('@web/public/lib/webuploader/0.1.5/webuploader.css', ['depends' => ['backend\assets\BackendAsset']]);
$this->registerJsFile('@web/public/js/layui/layui.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/lib/webuploader/0.1.5/webuploader.min.js', ['depends' => ['backend\assets\BackendAsset'], 'position' => View::POS_HEAD]);
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 二手房管理 <span class="c-gray en">&gt;</span> 添加二手房 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
        <label class="form-label col-xs-4 col-sm-2">标题：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">小区名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'vill_name', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'id' => 'vill_name', 'style' => 'width:90%;'])->label(false); ?>
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
            <?= $form->field($model, 'hou_area', ['template' => "{input}&nbsp;平米{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">售价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'to_price1', ['template' => "{input}&nbsp;万元{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">单价：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'price1', ['template' => "{input}&nbsp;元{error}", 'options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
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
            <?= $form->field($model, 'house_owner', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">手机号：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'mob_phone', ['options' => ['class' => false]])->textInput(['class' => 'input-text', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房源图片：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <div class="uploader-thum-container">
                <div id="filePicker">选择图片</div>
                <span id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</span>
            </div>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"></label>
        <div class="formControls col-xs-8 col-sm-9">
            <div class="uploader-list-container"> 
                <div class="queueList">
                    <ul class="filelist" id="fileList">
                        <?php if (isset($attach) && !empty($attach)): ?>
                            <?php foreach ($attach as $key => $vo): ?>
                                <li style="height:auto;" id="">
                                    <p class="title"></p>
                                    <p class="imgWrap"><img src="<?= Yii::$app->params['file_domain'] . $vo['attach_path'] . $vo['attach_name'] ?>"></p>
                                    <p class="progress"><span></span></p>
                                    <p class="first pic_operate <?php if ($vo['attach_code'] == 1): ?>cur_pic<?php endif; ?>" title="首图"><i class="Hui-iconfont">&#xe612;</i></p>
                                    <p class="del pic_operate" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></p>
                                    <input type="hidden" name="attach_path[]" value="<?= $vo['attach_path'] . $vo['attach_name'] ?>">
                                    <input type="hidden" name="attach_code[]" value="<?= $vo['attach_code'] ?>">
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">描述：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <?= $form->field($model, 'hou_remark', ['options' => ['class' => false]])->textArea(['class' => 'textarea', 'style' => 'width:90%;'])->label(false); ?>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">房源标签：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <?=
            $form->field($model, 'lab')->checkboxList($build_lab, [
                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<div class="check-box" style="width:18%;"><input type="checkbox" name="' . $name . '" id="_' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="_' . $index . '">' . $label . '</label></div>';
                    return $return;
                }
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
        <label class="form-label col-xs-4 col-sm-2">推荐指数：</label>
        <div class="formControls col-xs-8 col-sm-2">
            <?= $form->field($model, 'user_grade')->textInput(['class' => 'input-text', 'style' => 'width:70%;'])->label(false); ?>
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
        var $list = $("#fileList");
        var $btn = $("#btn-star");
        var thumbnailWidth = 100;
        var thumbnailHeight = 100;
        var uploader = WebUploader.create({
            auto: false,
            swf: '/public/lib/webuploader/0.1.5/Uploader.swf',
            // 文件接收服务端。
            server: '<?= Url::to(['sec-hand/upload']) ?>',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {id: '#filePicker', innerHTML: '选择图片', multiple: true},
            // fileVal: 'test',
            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on('fileQueued', function (file) {
            var $li = $(
                    '<li style="height:auto;" id="' + file.id + '">' +
                    '<p class="title">' + file.name + '</p>' +
                    '<p class="imgWrap"><img src=""></p>' +
                    '<p class="progress"><span></span></p>' +
                    '<p class="first pic_operate" title="首图"><i class="Hui-iconfont">&#xe612;</i></p>' +
                    '<p class="del pic_operate" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></p>' +
                    '</li>'
                    ),
                    $img = $li.find('img');
            $list.append($li);
            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }
                $img.attr('src', src);
            }, thumbnailWidth, thumbnailHeight);
        });
        $btn.on('click', function () {
            uploader.upload();
        });
        $list.on('click', '.del', function () {
            var id = $(this).parent().attr('id');
            $(this).parent().remove();
            if (id) {
                var quID = uploader.getFile(id);
                uploader.removeFile(quID);
            }
        });
        // 首图
        $list.on('click', '.first', function () {
            $(this).addClass('cur_pic');
            $(this).parent().find("input[name='attach_code[]']").val('1');
            var obj = $(this).parent().siblings();
            obj.find("input[name='attach_code[]']").val('0');
            obj.find('p.first').removeClass('cur_pic');
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {

        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file, data) {
            $('#' + file.id).append('<input name="attach_path[]" type="hidden" value="' + data.attach_path + data.attach_name + '">');
            $('#' + file.id).append('<input name="attach_code[]" type="hidden" value="0">');
            layer.tips('上传成功', '#' + file.id, {tips: [1, '#EA2000']});
        });
        // 文件上传失败，显示上传出错。
        uploader.on('uploadError', function (file) {

        });
        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {

        });
    });
    //引入自定义插件
    layui.config({
        base: '/public/js/yutons-mods/'
    }).use(['yutons_sug'], function () {
        var yutons_sug = layui.yutons_sug;
        sessionStorage.setItem("url", "<?= Url::to(['sec-hand/get-village']) ?>");
        yutons_sug.render({
            id: "vill_name",
            limits: "10",
            limit: "10",
            height: "300",
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
