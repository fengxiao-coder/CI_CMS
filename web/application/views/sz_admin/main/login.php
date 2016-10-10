<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>商品管理CMS系统-登录页面</title>
        <?php echo css("css/login.css"); ?>
        <?php echo js("js/jquery.js"); ?>
        <script type="text/javascript">
            if (window != window.top)
                window.top.location.href = window.location.href;
        </script>
    </head>
    <body>
        <div class="login">
            <div class="login-form" >
                <form method="post" id='login-form'>
                    <h1>项目申报系统</h1>
                    <div class="line"><img  src="<?php echo base_url("theme/default/images/logo_line.png");?>"
                      width="371" height="3"></div>
                    <div class="control-group">
                        <div  class="error-box">
                            <div class="logo-error" style="display:block;">
                                <?php get_messagebox(); // 获取提示框 ?>
                            </div>
                        </div>

                        <ul>
                            <li> 
                                <div class="float-left" style="width:70px;"><label for="name">用户名：</label></div>
                                <div class="divInput"><input id="name" type="text" name="name" maxlength="30"/></div>
                                <div class="c"></div>
                            </li> 
                        </ul>
                        <ul>
                            <li> 
                                <div class="float-left" style="width:70px;"><label for="password">密&nbsp;&nbsp;&nbsp;码：</label></div>
                                <div class="divInput"><input id="password" type="password" name="password" maxlength="30"/></div>
                                <div class="c"></div>
                            </li>

                        </ul>
                        <div class="form-actions"><button type="button" class="btn btn-success" onClick="my_submit();">登 录</button></div>

                        <div class="copyright">技术支持：凌宇通信网络有限公司</div>
                        <input type="hidden" name="is_login" value="1">
                    </div>
                </form>
            </div>
            <div class="login-bottom"></div>
        </div>
    </body>
</html>
<script type="text/javascript">
    function my_submit() {
        $('#login-form').submit();
    }
    jQuery(function ($) {
        $(document).ready(function () {
            $('#username').focus();
        });
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $('#login-form').submit();
            }
        });
    });
</script>

