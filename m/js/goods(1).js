/**
 * Created by maxteng on 15/5/9.
 */

var class1Id = "class1";
var class2Id = "class2";
var goodsListId = "goods_list_tpl";

var tpl1 = $("#"+class1Id).html();
var tpl2 = $("#"+class2Id).html();
var goodsListTpl = $("#"+goodsListId).html();
goodsListTpl = goodsListTpl.replace('<img name="goods-imgs-url">', '<img src="<!--{$imageURLSmall}-->">');

var goodsClassFields = ['className', 'classId', 'activeClass'];
var goodsListFields = ['goodsname', 'classFavorite', 'descpt', 'price', 'measure', 'imageURL', 'imageURLSmall', 'versionID', 'goodsid', 'shortdescpt'];

var classMap = [];

var stockMap = [];
var goodsClassMap = [];

$(document).ready(function() {
    goodsListPageInit();
    $(".js-content").css("height",($(window).height()-$(".search-div").height()-$(".js-menu-bar").height()-2-$(".act-tips").height()+"px"));
});
