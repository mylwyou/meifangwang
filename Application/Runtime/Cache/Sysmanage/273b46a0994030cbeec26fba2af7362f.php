<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
<head>
    <title>美房网后台管理系统</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
	<link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/uniform.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/select2.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/unicorn.main.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/unicorn.grey.css" />
    <script type="text/javascript" src="/Public/sysmanage/js/jquery.min.js"></script>

    <script type="text/javascript">
        function CheckForm() {
        	var paixu=$("#paixu").val();
            if ($.trim(paixu) == "") {
            	alert("请填写排序！");
                $("#paixu").focus();
                return false;
            }
            else if (isNaN(paixu)) {
                alert("排序号必须为数字！");
                $("#paixu").select();
                return false;
            }
        }

        //flag为图片的字段名，dis为上传页面的提示
        function uploadpic(flag,width,height,dis) {
            winopenforapply("uploadpic", "上传图片", "/index.php/Sysmanage/Uploadpic/?width="+width+"&height="+height+"&dis="+dis+"&flag=" + flag+"&upflag=1", 400, 145);
        }

    </script>

</head>
<body>
<div id="header">
	<h1><a href="#">后台管理系统</a></h1>
</div>

<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <!-- <li class="btn btn-inverse" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li> -->
        <li class="btn btn-inverse"><a title="" href="<?php echo U('Admin/updpass');?>"><i class="icon icon-cog"></i> <span class="text">更改密码</span></a></li>
        <li class="btn btn-inverse"><a title="" href="<?php echo U('Admin/logout');?>" onclick="return confirm('确定要退出后台吗？');"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
    </ul>
</div>

<div id="sidebar">
    <a class="visible-phone" href="#"><i class="icon icon-home"></i>美房网</a>
    <ul>
        <li <?php if (carousel == "main"){ echo 'class="active"';} ?> ><a href="<?php echo U('Home/index');?>">
            <i class="icon icon-list"></i><span>首页</span></a></li>
        <li <?php if (carousel == "welcome"){ echo 'class="active"';} ?> ><a href="<?php echo U('Welcome/index');?>">
            <i class="icon icon-list"></i><span> 欢迎页图片</span></a></li>
        <li <?php if (carousel == "carousel"){ echo 'class="active"';} ?> ><a href="<?php echo U('Carousel/index');?>">
            <i class="icon icon-list"></i><span> 轮播图列表</span></a></li>
        <li <?php if (carousel == "guide"){ echo 'class="active"';} ?> ><a href="<?php echo U('Guide/index');?>">
            <i class="icon icon-list"></i><span> 引导图列表</span></a></li>
        <li <?php if(carousel=="label"||carousel=="news"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                资讯管理</span> <span class="label">3</span></a>
            <ul>
                <li <?php if (carousel == "label"){echo 'class="active"';} ?>><a href="<?php echo U('News/label');?>">
                    标签列表</a></li>
                <li <?php if (carousel == "news"){echo 'class="active"';} ?>><a href="<?php echo U('News/index');?>">
                    资讯列表</a></li>
            </ul>
        </li>

        <!-- <li <?php if(carousel=="user"||carousel=="authuser"||carousel=="authcar"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                用户管理</span> <span class="label">3</span></a>
            <ul>
                <li <?php if (carousel == "user"){echo 'class="active"';} ?>><a href="<?php echo U('User/index');?>">
                    用户列表</a></li>
                <li <?php if (carousel == "authuser"){echo 'class="active"';} ?>><a href="<?php echo U('Authuser/index');?>">
                    租客认证列表</a></li>
                <li <?php if (carousel == "authcar"){echo 'class="active"';} ?>><a href="<?php echo U('Authcar/index');?>">
                    车主认证列表</a></li>
            </ul>
        </li> -->

        <!-- <li <?php if(carousel=="trip"||carousel=="trippic"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                行程管理</span> <span class="label">2</span></a>
            <ul>
            	<li <?php if (carousel == "trippic"){echo 'class="active"';} ?>><a href="<?php echo U('Trippiclist/index');?>">
                    轮播图列表</a></li>
                <li <?php if (carousel == "trip"){echo 'class="active"';} ?>><a href="<?php echo U('Trip/index');?>">
                    行程列表</a></li>
            </ul>
        </li>

        <li <?php if (carousel == "order"){echo 'class="active"';} ?>><a href="<?php echo U('Order/index');?>"><i class="icon icon-inbox">
        </i><span>订单列表</span></a> </li>

        <li <?php if (carousel == "campsite"){echo 'class="active"';} ?>><a href="<?php echo U('Campsite/index');?>"><i class="icon icon-inbox">
        </i><span>露营地管理</span></a> </li>

        <li <?php if (carousel == "feedback"){echo 'class="active"';} ?>><a href="<?php echo U('Feedback/index');?>"><i class="icon icon-inbox">
        </i><span>意见反馈</span></a> </li> -->

        <li <?php if (carousel == "admin"){echo 'class="active"';} ?>><a href="<?php echo U('Admin/index');?>"><i class="icon icon-inbox">
        </i><span>管理员列表</span></a> </li>
    </ul>
</div>

<div id="content">
    
<div id="breadcrumb">
        <a href="<?php echo U('Home/index');?>" title="返回首页" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="<?php echo U('Carousel/index');?>" class="current">轮播图列表</a><a href="#" class="current"><?php if($action == 'upd'): ?>修改轮播图<?php else: ?>添加轮播图<?php endif; ?></a>
    </div>


    
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>
                            <a href="<?php echo U('Carousel/index');?>">轮播图列表</a></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="/index.php/Sysmanage/Carousel/addsend/action/<?php echo ($action); ?>/id/<?php echo ($id); ?>/p/<?php echo ($p); ?>" method="post" class="form-horizontal"
                        name="yuziform" id="yuziform">

                        <div class="control-group">
                            <label class="control-label">
                                轮播图：</label>
                            <div class="controls">
                            	<img id='pic_img' src=<?php if(($fb_trip_pic_info["pic"]) == ""): ?>"/Public/sysmanage/img/empty.png"<?php else: ?>"<?php echo ($fb_trip_pic_info["pic"]); ?>"<?php endif; ?>  style="width:150px;" alt="" />&nbsp;&nbsp;<button type="button" class="btn btn-primary" onclick="uploadpic('pic',600,254,'图片尺寸宽高比为5:2，文件小于3M');">上传图片</button>
                            	<span class="help-block">图片尺寸宽高比为5:2，文件小于3M</span>
                            	<input type="hidden" id="pic" name="pic" value="<?php echo ($fb_trip_pic_info["pic"]); ?>"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">
                                标题：</label>
                            <div class="controls">
                            	<input type="text" id="ptitle" name="ptitle" value='<?php echo ($fb_trip_pic_info["title"]); ?>'/>
                                <span class="help-block">非必填，该轮播图的名称</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                链接地址：</label>
                            <div class="controls">
                            	<input type="text" id="url" name="url" value='<?php echo ($fb_trip_pic_info["picurl"]); ?>'/>
                                <!-- <span class="help-block">非必填，轮播图的链接地址</span> -->
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                排序：</label>
                            <div class="controls">
                            	<input type="text" id="paixu" name="paixu" value='<?php echo ($fb_trip_pic_info["orderby"]); ?>'/>
                                <span class="help-block">必填，必须为数字</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" onclick="return CheckForm(this);">
                                保存</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row-fluid">
	<div id="footer" class="span12">
		2017 ,Powered By unionz
	</div>
</div>

	<script type="text/javascript" src="/Public/sysmanage/js/jquery.ui.custom.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/jquery.uniform.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/select2.min.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/unicorn.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/unicorn.form_common.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/lhgcore.min.js"></script>
    <script src="/Public/sysmanage/js/lhgdialog.min.js?s=facebook" type="text/javascript"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/mydialog.min.js"></script>

</body>
</html>