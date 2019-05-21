/**
 * Created by xm_pc on 2019/4/1.
 */

/*添加或者编辑 全屏*/
function operate_full(title, url) {
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

/*添加或者编辑 缩小屏*/
function operate_small(title, url, w, h) {
    layer_show(title, url, w, h);
}

/*删除*/
function operate_del(url) {
    layer.confirm('确认要删除吗？', {icon: 2, title: '提示', offset: '200px'}, function (index) {
        window.location.href = url;
    });
}

/*提示信息关闭*/
$(function () {
    $('.close_down').click(function () {
        $(this).parent().hide();
    });
});

/*房源状态*/
function house_operate(name, url) {
    layer.confirm('确认要' + name + '该房源吗？', {icon: 3, title: '提示', offset: '200px'}, function (index) {
        window.location.href = url;
    });
}
