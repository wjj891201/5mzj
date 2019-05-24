<?php

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
        <link rel="stylesheet" type="text/css" href="/public/static/h-ui/css/H-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="/public/static/h-ui.admin/css/H-ui.admin.css" />
        <link rel="stylesheet" type="text/css" href="/public/lib/Hui-iconfont/1.0.8/iconfont.css" />
        <link rel="stylesheet" type="text/css" href="/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
        <link rel="stylesheet" type="text/css" href="/public/static/h-ui.admin/css/style.css" />
        <!--[if IE 6]>
        <script type="text/javascript" src="/public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
        <script>DD_belatedPNG.fix('*');</script>
        <![endif]-->
        <title>H-ui.admin v3.1</title>
        <meta name="keywords" content="H-ui.admin v3.1">
        <meta name="description" content="H-ui.admin v3.1">
    </head>
    <body>
        <header class="navbar-wrapper">
            <div class="navbar navbar-fixed-top">
                <div class="container-fluid cl"> 
                    <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/public/aboutHui.shtml">H-ui.admin</a> 
                    <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/public/aboutHui.shtml">H-ui</a> 
                    <span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.1</span> 
                    <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:void(0);">&#xe667;</a>
                    <nav class="nav navbar-nav">
                        <ul class="cl"></ul>
                    </nav>
                    <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                        <ul class="cl">
                            <li>角色</li>
                            <li class="dropDown dropDown_hover">
                                <a href="#" class="dropDown_A">
                                    <?= Yii::$app->backend_user->identity->username ?> 
                                    <i class="Hui-iconfont">&#xe6d5;</i>
                                </a>
                                <ul class="dropDown-menu menu radius box-shadow">
                                    <li><a href="jsvascript:void(0);" onclick="operate_small('修改密码', '<?= Url::to(['manage/psw']) ?>', '', '400')">修改密码</a></li>
                                    <li><a href="jsvascript:void(0);" class="quit">退出</a></li>
                                </ul>
                            </li>
                            <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                            <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:void(0);" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                                <ul class="dropDown-menu menu radius box-shadow">
                                    <li><a href="javascript:void(0);" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                                    <li><a href="javascript:void(0);" data-val="blue" title="蓝色">蓝色</a></li>
                                    <li><a href="javascript:void(0);" data-val="green" title="绿色">绿色</a></li>
                                    <li><a href="javascript:void(0);" data-val="red" title="红色">红色</a></li>
                                    <li><a href="javascript:void(0);" data-val="yellow" title="黄色">黄色</a></li>
                                    <li><a href="javascript:void(0);" data-val="orange" title="橙色">橙色</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <aside class="Hui-aside">
            <div class="menu_dropdown bk_2">
                <dl id="menu-member">
                    <dt><i class="Hui-iconfont">&#xe67f;</i> 房源管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                    <dd>
                        <ul>
                            <li><a data-href="<?= Url::to(['sec-hand/list']) ?>" data-title="二手房管理" href="javascript:void(0);">二手房管理</a></li>
                            <li><a data-href="<?= Url::to(['lease/list']) ?>" data-title="出租房管理" href="javascript:void(0);">出租房管理</a></li>
                            <li><a data-href="<?= Url::to(['village/list']) ?>" data-title="小区信息管理" href="javascript:void(0);">小区信息管理</a></li>
                            <li><a data-href="<?= Url::to(['build/list']) ?>" data-title="楼盘信息管理" href="javascript:void(0);">楼盘信息管理</a></li>
                            <li><a data-href="<?= Url::to(['build/house-type-list']) ?>" data-title="楼盘户型管理" href="javascript:void(0);">楼盘户型管理</a></li>
                            <li><a data-href="<?= Url::to(['build/open-list']) ?>" data-title="楼盘开盘管理" href="javascript:void(0);">楼盘开盘管理</a></li>
                        </ul>
                    </dd>
                </dl>
                <dl id="menu-admin">
                    <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                    <dd>
                        <ul>
                            <li><a data-href="<?= Url::to(['role/list']) ?>" data-title="角色管理" href="javascript:void(0);">角色管理</a></li>
                            <li><a data-href="<?= Url::to(['access/list']) ?>" data-title="权限管理" href="javascript:void(0);">权限管理</a></li>
                            <li><a data-href="<?= Url::to(['manage/list']) ?>" data-title="账号管理" href="javascript:void(0);">账号管理</a></li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </aside>
        <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
        <section class="Hui-article-box">
            <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
                <div class="Hui-tabNav-wp">
                    <ul id="min_title_list" class="acrossTab cl">
                        <li class="active">
                            <span title="我的桌面" data-href="welcome.html">我的桌面</span>
                            <em></em>
                        </li>
                    </ul>
                </div>
                <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:void(0);"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:void(0);"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
            </div>
            <div id="iframe_box" class="Hui-article">
                <div class="show_iframe">
                    <div style="display:none" class="loading"></div>
                    <iframe scrolling="yes" frameborder="0" src="<?= Url::to(['home/welcome']) ?>"></iframe>
                </div>
            </div>
        </section>
        <div class="contextMenu" id="Huiadminmenu">
            <ul>
                <li id="closethis">关闭当前 </li>
                <li id="closeall">关闭全部 </li>
            </ul>
        </div>
        <!-- footer 作为公共模版分离出去-->
        <script type="text/javascript" src="/public/lib/jquery/1.9.1/jquery.min.js"></script> 
        <script type="text/javascript" src="/public/lib/layer/2.4/layer.js"></script>
        <script type="text/javascript" src="/public/static/h-ui/js/H-ui.min.js"></script>
        <script type="text/javascript" src="/public/static/h-ui.admin/js/H-ui.admin.js"></script> 
        <script type="text/javascript" src="/public/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
        <!-- footer 作为公共模版分离出去-->
        <!--自己写的js-->
        <script type="text/javascript" src="/public/js/common.js"></script> 
        <!--请在下方写此页面业务相关的脚本-->
        <script>
            $(function () {
                $('.quit').click(function () {
                    layer.confirm('确认要退出吗？', {icon: 3, title: '提示', offset: '200px'}, function (index) {
                        location.href = "<?= Url::to(['login/logout']) ?>";
                    });
                });
            });
        </script>
    </body>
</html>