<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 楼盘信息管理 <span class="c-gray en">&gt;</span> 楼盘列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <span class="select-box inline">
            <select name="" class="select">
                <option value="0">全部分类</option>
                <option value="1">分类一</option>
                <option value="2">分类二</option>
            </select>
        </span>
        <input type="text" name="" id="" placeholder=" 资讯名称" style="width:250px" class="input-text">
        <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 查询</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="l">
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" href="<?= Url::to(['build/add']) ?>">
                <i class="Hui-iconfont">&#xe600;</i> 新增楼盘
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="80">ID</th>
                    <th>标题</th>
                    <th width="80">分类</th>
                    <th width="80">来源</th>
                    <th width="120">更新时间</th>
                    <th width="75">浏览次数</th>
                    <th width="60">发布状态</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-c">
                    <td><input type="checkbox" value="" name=""></td>
                    <td>10001</td>
                    <td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看', 'article-zhang.html', '10001')" title="查看">资讯标题</u></td>
                    <td>行业动态</td>
                    <td>H-ui</td>
                    <td>2014-6-11 11:11:42</td>
                    <td>21212</td>
                    <td class="td-status"><span class="label label-success radius">已发布</span></td>
                    <td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this, '10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑', 'article-add.html', '10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this, '10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
                <tr class="text-c">
                    <td><input type="checkbox" value="" name=""></td>
                    <td>10002</td>
                    <td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看', 'article-zhang.html', '10002')" title="查看">资讯标题</u></td>
                    <td>行业动态</td>
                    <td>H-ui</td>
                    <td>2014-6-11 11:11:42</td>
                    <td>21212</td>
                    <td class="td-status"><span class="label label-success radius">草稿</span></td>
                    <td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this, '10001')" href="javascript:;" title="审核">审核</a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑', 'article-add.html', '10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this, '10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>