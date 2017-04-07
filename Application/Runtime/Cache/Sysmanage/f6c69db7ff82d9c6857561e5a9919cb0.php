<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>美房网系统后台登陆</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/unicorn.login.css" />
        <script type="text/javascript">
        function checkform() {
            var adminName = $.trim($("#adminName").val());
            var adminPwd = $.trim($("#adminPwd").val());
            if (adminName == "") {
                document.getElementById("trspan").style.display = "";
                $("#trspan").html("用户名不能为空！");
                $("#adminName").val("");
                $("#adminName").select();
                return false;
            }
            else if (adminPwd == "") {
                document.getElementById("trspan").style.display = "";
                $("#trspan").html("登陆密码不能为空！");
                $("#adminPwd").val("");
                $("#adminPwd").select();
                return false;
            }
            else {
                return true;
            }
        }
        function checkadmin() {
            document.getElementById("trspan").style.display = "none";
            $("#trspan").html("");
        }
        function checkpass() {
            document.getElementById("trspan").style.display = "none";
            $("#trspan").html("");
        }
	</script>
    </head>
    <body>
        <div id="logo">
            <img src="/Public/sysmanage/img/logo.png" alt="" />
        </div>
        <div id="loginbox">
            <form id="loginform" class="form-vertical" action="/index.php/Sysmanage/Login/checklogin" onSubmit="return checkform();" method="post">
				<p>请输入帐号和密码.</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" id="adminName" name="adminname" placeholder="帐号" onChange="checkadmin()"  />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="adminPwd" name="adminpwd" placeholder="密码" onChange="checkpass()"  />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                	<span class="pull-left" id="trspan" style="display:none; color:Red"></span>
                    <!-- <span class="pull-left"><a href="#" class="flip-link" id="to-recover">Lost password?</a></span> -->
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="登陆" /></span>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="/Public/sysmanage/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="/Public/sysmanage/js/unicorn.login.js"></script>
    </body>
</html>