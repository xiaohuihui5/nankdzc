<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>我</title>
        <link rel="stylesheet" href="fonts/iconfont.css"/>
        <link rel="stylesheet" href="css/font.css"/>
        <link rel="stylesheet" href="css/weui.min.css"/>
        <link rel="stylesheet" href="css/jquery-weui.min.css"/>
        <link rel="stylesheet" href="css/mui.css"/>
        <link rel="stylesheet" href="css/animate.css"/>
        <link rel="stylesheet" href="css/pages/self.css"/>
        <script>(function (doc, win) {
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
            <div class="head-box">
               <h3>我</h3>
               <div class="head-icon-outer">
                    <div class="head-icon"></div>
               </div>
               <h5>头像点击可以更换</h5>
            </div>
        </header>
        <article>
            <div class="weui_cells weui_cells_access">
                <a class="weui_cell" href="javascript:goto('person_info.html');">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>资料修改</p>
                    </div>
                    <i class="iconfont">&#xe642;</i>
                </a>
            </div>
            <div class="weui_cells weui_cells_access">
                <a class="weui_cell" href="javascript:goto('modify.html');">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>密码修改</p>
                    </div>
                   <i class="iconfont">&#xe642;</i>
                </a>
            </div>
            <div class="weui_cells weui_cells_access">
                <a class="weui_cell" href="javascript:;">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>检查新版本</p>
                    </div>
                   <i class="iconfont">&#xe642;</i>
                </a>
            </div>
            <div class="button">
                <div class="bd">
                    <a href="javascript:back();" class="weui_btn weui_btn_primary">退出</a>
                </div>
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
<script type="text/javascript">
    function back(){
        window.location.href = 'app.html';
    }
</script>