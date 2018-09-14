<html lang="en">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>应用</title>
        <link rel="stylesheet" href="fonts/iconfont.css"/>
        <link rel="stylesheet" href="css/font.css"/>
        <link rel="stylesheet" href="css/weui.min.css"/>
        <link rel="stylesheet" href="css/jquery-weui.min.css"/>
        <link rel="stylesheet" href="css/mui.css"/>
        <link rel="stylesheet" href="css/animate.css"/>
        <link rel="stylesheet" href="css/pages/app.css"/>
        <script>
        (function (doc, win) {
          var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
              var clientWidth = docEl.clientWidth;
              if (!clientWidth) return;
              docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';
            };

          if (!doc.addEventListener) return;
          win.addEventListener(resizeEvt, recalc, false);
          doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);

        function goto(url){

            window.location.href=url;

        }

    </script>
    </head>
    <body>
        <header>
            <div class="titlebar reverse">
                
                <h1>应用<h1>
            </div>
        </header>
        <article style="padding-bottom: 54px;padding-top:44px;">
            <div class="list-wrap">
                <h4>采购管理</h4>
                <ul class="app-list">
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:goto('xunjia.html');">
                                <img border=0 src=images/采购订单.png>  
                                <span>采购计划</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <img border=0 src=images/采购明细.png>  
                                <span>采购明细</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <img border=0 src=images/价格search.png>  
                                <span>价格查询</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <img border=0 src=images/价格趋势.png>  
                                <span>价格趋势</span>
                            </a>
                        </div>
                        
                    </li>
                    
                </ul>
            </div>

            <div class="list-wrap">
                <h4>销售管理</h4>
                <ul class="app-list">
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:goto('order.html');">
                                <i class="iconfont">&#xe64b;</i>
                                <span>订单管理</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe644;</i>
                                <span>发货记录</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe649;</i>
                                <span>收货看板</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe647;</i>
                                <span>收货记录</span>
                            </a>
                        </div>
                        
                    </li>

                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe64d;</i>
                                <span>退货管理</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe64a;</i>
                                <span>交货排程</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe64c;</i>
                                <span>质检结果</span>
                            </a>
                        </div>
                        
                    </li>
                    
                </ul>
            </div>

            <div class="list-wrap">
                <h4>报表管理</h4>
                <ul class="app-list">
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe620;</i>
                                <span>全体供应商</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe648;</i>
                                <span>工厂考察</span>
                            </a>
                        </div>
                        
                    </li>
                    <li>
                        <div class="app-wrap">
                            <a href="javascript:goto('notice.html');">
                                <i class="iconfont">&#xe646;</i>
                                <span>供应商绩效</span>
                            </a>
                        </div>
                        
                    </li>
                </ul>
            </div>
        </article>
        <footer>
            <ul class="menubar animated fadeInUp delay3">
                <li class="tab" onclick="goto('notice.html')">
                    <i class="iconfont">&#xe63c;</i>
                    <label class="tab-label">公告</label>
                    <span class="point"></span>
                </li>
                <li class="tab" onclick="goto('tasks.html')">
                    <i class="iconfont">&#xe63d;</i>
                    <label class="tab-label">任务</label>
                    <span class="point"></span>
                </li>
                <li class="tab active" onclick="goto('app.html')">
                    <i class="iconfont">&#xe63f;</i>
                    <label class="tab-label">应用</label>
                    <span class="point"></span>
                </li>
                <li class="tab" onclick="goto('self.html')">
                    <i class="iconfont">&#xe63e;</i>
                    <label class="tab-label"><a href="self.html">我</a></label>
                </li>
            </ul>
        </footer>
    </body>
</html>



