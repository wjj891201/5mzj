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
function operate_del(id, url) {
    layer.confirm('确认要删除吗？', function (index) {
        window.location.href = url;
    });
}
