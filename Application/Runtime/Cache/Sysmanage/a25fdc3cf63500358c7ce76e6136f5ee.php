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
        <li <?php if (guide == "main"){ echo 'class="active"';} ?> ><a href="<?php echo U('Home/index');?>">
            <i class="icon icon-list"></i><span>首页</span></a></li>
        <li <?php if (guide == "welcome"){ echo 'class="active"';} ?> ><a href="<?php echo U('Welcome/index');?>">
            <i class="icon icon-list"></i><span> 欢迎页图片</span></a></li>
        <li <?php if (guide == "carousel"){ echo 'class="active"';} ?> ><a href="<?php echo U('Carousel/index');?>">
            <i class="icon icon-list"></i><span> 轮播图列表</span></a></li>
        <li <?php if (guide == "guide"){ echo 'class="active"';} ?> ><a href="<?php echo U('Guide/index');?>">
            <i class="icon icon-list"></i><span> 引导图列表</span></a></li>
        <li <?php if(guide=="label"||guide=="news"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                资讯管理</span> <span class="label">3</span></a>
            <ul>
                <li <?php if (guide == "label"){echo 'class="active"';} ?>><a href="<?php echo U('News/label');?>">
                    标签列表</a></li>
                <li <?php if (guide == "news"){echo 'class="active"';} ?>><a href="<?php echo U('News/index');?>">
                    资讯列表</a></li>
            </ul>
        </li>

        <!-- <li <?php if(guide=="user"||guide=="authuser"||guide=="authcar"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                用户管理</span> <span class="label">3</span></a>
            <ul>
                <li <?php if (guide == "user"){echo 'class="active"';} ?>><a href="<?php echo U('User/index');?>">
                    用户列表</a></li>
                <li <?php if (guide == "authuser"){echo 'class="active"';} ?>><a href="<?php echo U('Authuser/index');?>">
                    租客认证列表</a></li>
                <li <?php if (guide == "authcar"){echo 'class="active"';} ?>><a href="<?php echo U('Authcar/index');?>">
                    车主认证列表</a></li>
            </ul>
        </li> -->

        <!-- <li <?php if(guide=="trip"||guide=="trippic"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                行程管理</span> <span class="label">2</span></a>
            <ul>
            	<li <?php if (guide == "trippic"){echo 'class="active"';} ?>><a href="<?php echo U('Trippiclist/index');?>">
                    轮播图列表</a></li>
                <li <?php if (guide == "trip"){echo 'class="active"';} ?>><a href="<?php echo U('Trip/index');?>">
                    行程列表</a></li>
            </ul>
        </li>

        <li <?php if (guide == "order"){echo 'class="active"';} ?>><a href="<?php echo U('Order/index');?>"><i class="icon icon-inbox">
        </i><span>订单列表</span></a> </li>

        <li <?php if (guide == "campsite"){echo 'class="active"';} ?>><a href="<?php echo U('Campsite/index');?>"><i class="icon icon-inbox">
        </i><span>露营地管理</span></a> </li>

        <li <?php if (guide == "feedback"){echo 'class="active"';} ?>><a href="<?php echo U('Feedback/index');?>"><i class="icon icon-inbox">
        </i><span>意见反馈</span></a> </li> -->

        <li <?php if (guide == "admin"){echo 'class="active"';} ?>><a href="<?php echo U('Admin/index');?>"><i class="icon icon-inbox">
        </i><span>管理员列表</span></a> </li>
    </ul>
</div>

<div id="content">
    
<div id="breadcrumb">
        <a href="<?php echo U('Home/index');?>" title="返回首页" class="tip-bottom"><i class="icon-home">
        </i> 首页</a><a href="<?php echo U('Guide/index');?>" class="current">引导页图片</a>
    </div>

    
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <h5><a href="/index.php/Sysmanage/Guide/add">添加引导图</a></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                <th>
                                        android引导图
                                    </th>
                                    <th>
                                        ios图（640*960）
                                    </th>
                                    <th>
                                        ios图（640*1136）
                                    </th>
                                    <th>
                                        ios图（750*1334）
                                    </th>
                                    <th>
                                        ios图（1242*2208）
                                    </th>
                                    <th>
                                        排序
                                    </th>
                                    <th style="width: 30px">
                                        操作
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cp): $mod = ($i % 2 );++$i;?><tr>
                                    <td>
                                    	<img src="<?php echo ($cp["android_pic"]); ?>" style="width:150px;" alt="引导图" />
                                    </td>
                                    <td>
                                        <img src="<?php echo ($cp["ios_960"]); ?>" style="width:150px;" alt="引导图" />
                                    </td>
                                    <td>
										 <img src="<?php echo ($cp["ios_1136"]); ?>" style="width:150px;" alt="引导图" />
                                    </td>
                                    <td>
										<img src="<?php echo ($cp["ios_1334"]); ?>" style="width:150px;" alt="引导图" />
                                    </td>
                                     <td>
										<img src="<?php echo ($cp["ios_2208"]); ?>" style="width:150px;" alt="引导图" />
                                    </td>
                                     <td>
										<?php echo ($cp["orderby"]); ?>
                                    </td>
                                    <td>
                                        <a href="/index.php/Sysmanage/Guide/add/action/upd/id/<?php echo ($cp["id"]); ?>/p/<?php echo ($p); ?>">修改</a><br/><br/>
                                        <a
                                            href="/index.php/Sysmanage/Guide/del/id/<?php echo ($cp["id"]); ?>/p/<?php echo ($p); ?>" onclick="return confirm('确定要删除该引导图吗？');">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination alternate" style="text-align: center; vertical-align: middle">
                    <?php echo ($page); ?>
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

	<script type="text/javascript" src="/Public/sysmanage/js/jquery.min.js"></script>
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