<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <!--[if lt IE 9]>
        <script type="text/javascript" src="/public/lib/html5shiv.js"></script>
        <script type="text/javascript" src="/public/lib/respond.min.js"></script>
        <![endif]-->
        <link href="/public/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
        <link href="/public/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
        <link href="/public/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="/public/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
        <!--[if IE 6]>
        <script type="text/javascript" src="/public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
        <script>DD_belatedPNG.fix('*');</script>
        <![endif]-->
        <title>后台登录 - H-ui.admin v3.1</title>
        <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
        <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
    </head>
    <body>
        <div class="header"></div>
        <div class="loginWraper">
            <div id="loginform" class="loginBox">
                <?php
                $form = ActiveForm::begin(['options' => ['class' => 'form form-horizontal']]);
                ?>
                <div class="row cl" style="margin-top: 0px;">
                    <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                    <div class="formControls col-xs-8">
                        <?= $form->field($model, 'username', ['errorOptions' => ['style' => 'height:20px;']])->textInput(['class' => 'input-text size-L', 'placeholder' => '账户'])->label(false); ?>
                    </div>
                </div>
                <div class="row cl" style="margin-top: 0px;">
                    <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                    <div class="formControls col-xs-8">
                        <?= $form->field($model, 'password', ['errorOptions' => ['style' => 'height:20px;']])->passwordInput(['class' => 'input-text size-L', 'placeholder' => '密码'])->label(false); ?>
                    </div>
                </div>
                <div class="row cl" style="margin-top: 0px;">
                    <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe70d;</i></label>
                    <div class="formControls col-xs-8">
                        <?=
                        $form->field($model, 'verifyCode', ['errorOptions' => ['style' => 'height:20px;']])->widget(Captcha::className(), [
                            'template' => '{input}{image}',
                            'captchaAction' => '/login/captcha',
                            'options' => ['class' => 'input-text size-L', 'placeholder' => '验证码', 'style' => 'width:150px;'],
                            'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;margin-left:10px;']
                        ])->label(false);
                        ?>
                    </div>
                </div>
                <div class="row cl" style="margin-top: 0px;">
                    <div class="formControls col-xs-8 col-xs-offset-3">
                        <?= $form->field($model, 'rememberMe')->checkbox(['id' => 'online', 'template' => "<label for=\"online\">{input} 使我保持登录状态</label>"])->label(false); ?>
                    </div>
                </div>
                <div class="row cl">
                    <div class="formControls col-xs-8 col-xs-offset-3">
                        <?= Html::submitButton('&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;', ["class" => "btn btn-success radius size-L"]); ?>
                        <?= Html::resetButton('&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;', ["class" => "btn btn-default radius size-L"]); ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
        <script type="text/javascript" src="/public/lib/jquery/1.9.1/jquery.min.js"></script> 
        <script type="text/javascript" src="/public/static/h-ui/js/H-ui.min.js"></script>
        <script>
            $(function () {
                $("#loginform-verifycode-image").click(function () {
                    $.get('<?= Url::to(['login/captcha', 'refresh' => '']) ?>', function (res) {
                        $("#loginform-verifycode-image").attr('src', res.url);
                    });
                });
            });
        </script>
    </body>
</html>