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
	<link rel="stylesheet" type="text/css" href="/Public/kindeditor/themes/default/default.css" />
	<script type="text/javascript" src="/Public/kindeditor/kindeditor-all-min.js"></script>

    <script type="text/javascript">
	    function checkLen_content(term) {
	        if (term.value.length > 150) {
	            alert("您输入的内容过长！");
	            this.disabled = 'true'
	            term.value = term.value.substring(0, 150);
	            $("#spscontent").html(0);
	        }
	        else {
	            $("#spscontent").html(150 - term.value.length);
	        }
	    }
        function CheckForm() {
        	var title=$("#title").val();
            if ($.trim(title) == "") {
            	alert("请填写标题！");
                $("#title").focus();
                return false;
            }
        }

        //flag为图片的字段名，dis为上传页面的提示
        function uploadpic(flag,width,height,dis) {
            winopenforapply("uploadpic", "上传图片", "/index.php/Sysmanage/Uploadpic/?width="+width+"&height="+height+"&dis="+dis+"&flag=" + flag+"&upflag=3", 400, 145);
        }

        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="ncontent"]', {
                cssPath : '/Public/kindeditor/plugins/code/prettify.css',
                uploadJson : '/Public/kindeditor/php/upload_json.php',
                fileManagerJson : '/Public/kindeditor/php/file_manager_json.php',
                allowFileManager : true,
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                }
            });
            prettyPrint();
        });
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
        <li <?php if (news == "main"){ echo 'class="active"';} ?> ><a href="<?php echo U('Home/index');?>">
            <i class="icon icon-list"></i><span>首页</span></a></li>
        <li <?php if (news == "welcome"){ echo 'class="active"';} ?> ><a href="<?php echo U('Welcome/index');?>">
            <i class="icon icon-list"></i><span> 欢迎页图片</span></a></li>
        <li <?php if (news == "carousel"){ echo 'class="active"';} ?> ><a href="<?php echo U('Carousel/index');?>">
            <i class="icon icon-list"></i><span> 轮播图列表</span></a></li>
        <li <?php if (news == "guide"){ echo 'class="active"';} ?> ><a href="<?php echo U('Guide/index');?>">
            <i class="icon icon-list"></i><span> 引导图列表</span></a></li>
        <li <?php if(news=="label"||news=="news"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                资讯管理</span> <span class="label">2</span></a>
            <ul>
                <li <?php if (news == "label"){echo 'class="active"';} ?>><a href="<?php echo U('News/label');?>">
                    标签列表</a></li>
                <li <?php if (news == "news"){echo 'class="active"';} ?>><a href="<?php echo U('News/index');?>">
                    资讯列表</a></li>
            </ul>
        </li>

        <!-- <li <?php if(news=="user"||news=="authuser"||news=="authcar"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                用户管理</span> <span class="label">3</span></a>
            <ul>
                <li <?php if (news == "user"){echo 'class="active"';} ?>><a href="<?php echo U('User/index');?>">
                    用户列表</a></li>
                <li <?php if (news == "authuser"){echo 'class="active"';} ?>><a href="<?php echo U('Authuser/index');?>">
                    租客认证列表</a></li>
                <li <?php if (news == "authcar"){echo 'class="active"';} ?>><a href="<?php echo U('Authcar/index');?>">
                    车主认证列表</a></li>
            </ul>
        </li> -->

        <!-- <li <?php if(news=="trip"||news=="trippic"){ echo 'class="submenu active open"';}else{echo 'class="submenu"';} ?>><a href="#"><i class="icon icon-th-list"></i><span>
                行程管理</span> <span class="label">2</span></a>
            <ul>
            	<li <?php if (news == "trippic"){echo 'class="active"';} ?>><a href="<?php echo U('Trippiclist/index');?>">
                    轮播图列表</a></li>
                <li <?php if (news == "trip"){echo 'class="active"';} ?>><a href="<?php echo U('Trip/index');?>">
                    行程列表</a></li>
            </ul>
        </li>

        <li <?php if (news == "order"){echo 'class="active"';} ?>><a href="<?php echo U('Order/index');?>"><i class="icon icon-inbox">
        </i><span>订单列表</span></a> </li>

        <li <?php if (news == "campsite"){echo 'class="active"';} ?>><a href="<?php echo U('Campsite/index');?>"><i class="icon icon-inbox">
        </i><span>露营地管理</span></a> </li>

        <li <?php if (news == "feedback"){echo 'class="active"';} ?>><a href="<?php echo U('Feedback/index');?>"><i class="icon icon-inbox">
        </i><span>意见反馈</span></a> </li> -->

        <li <?php if (news == "admin"){echo 'class="active"';} ?>><a href="<?php echo U('Admin/index');?>"><i class="icon icon-inbox">
        </i><span>管理员列表</span></a> </li>
    </ul>
</div>

<div id="content">
    
<div id="breadcrumb">
        <a href="<?php echo U('Home/index');?>" title="返回首页" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="<?php echo U('News/index');?>" class="current">资讯列表</a><a href="#" class="current"><?php if($action == 'upd'): ?>修改资讯<?php else: ?>添加资讯<?php endif; ?></a>
    </div>


    
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>
                            <a href="<?php echo U('News/index');?>">资讯列表</a></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="/index.php/Sysmanage/News/addsend/action/<?php echo ($action); ?>/id/<?php echo ($id); ?>/p/<?php echo ($p); ?>" method="post" class="form-horizontal"
                        name="yuziform" id="yuziform">

                        <div class="control-group">
                            <label class="control-label">
                                标题：</label>
                            <div class="controls">
                            	<input type="text" id="title" name="title" value='<?php echo ($information_info["title"]); ?>' maxlength="50"/>
                                <span class="help-block">必填，资讯的标题</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">
                                简单介绍：</label>
                            <div class="controls">
                            	<textarea rows="5" id="scontent" name="scontent" onkeypress="checkLen_content(this)" onkeyup="checkLen_content(this)" onchange="checkLen_content(this)"><?php echo ($information_info["scontent"]); ?></textarea>
                            	<span class="help-block">简单介绍在150字以内，您还可以输入<span id="spscontent" style="color:Red">150</span>字）</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                详细内容：</label>
                            <div class="controls">
                            	<!-- <textarea name="content" style="width:700px;height:200px;visibility:hidden;"><?php echo ($information_info["content"]); ?></textarea> -->
                            	<textarea name="ncontent" cols="100" id="ncontent" rows="25" style="width: 710"><?php echo ($information_info["content"]); ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                列表图片：</label>
                            <div class="controls">
                            	<img id='pic_img' src=<?php if(($information_info["pic"]) == ""): ?>"/Public/sysmanage/img/empty.png"<?php else: ?>"<?php echo ($information_info["pic"]); ?>"<?php endif; ?>  style="width:150px;" alt="" />&nbsp;&nbsp;<button type="button" class="btn btn-primary" onclick="uploadpic('pic',600,254,'图片建议尺寸为500*318，文件小于3M');">上传图片</button>
                            	<span class="help-block">图片建议尺寸为500*318，文件小于3M</span>
                            	<input type="hidden" id="pic" name="pic" value="<?php echo ($information_info["pic"]); ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                分区：</label>
                            <div class="controls">
                            	<select id="catid" name="catid" style="max-width:150px">
                            		<option value="0" <?php if(($catid) == "0"): ?>selected="selected"<?php endif; ?>>请选择专区</option>
                                    <option value="1" <?php if(($catid) == "1"): ?>selected="selected"<?php endif; ?>>环京专区</option>
                                    <option value="2" <?php if(($catid) == "2"): ?>selected="selected"<?php endif; ?>>海南专区</option>
                                    <option value="3" <?php if(($catid) == "3"): ?>selected="selected"<?php endif; ?>>华东专区</option>
                                    <option value="4" <?php if(($catid) == "4"): ?>selected="selected"<?php endif; ?>>深广专区</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                标签：</label>
                            <div class="controls">
                            	<select id="tag" name="tag" style="max-width:150px">
                            		<option value="0" <?php if(($tag) == "0"): ?>selected="selected"<?php endif; ?>>请选择标签</option>
                                    <option value="1" <?php if(($tag) == "1"): ?>selected="selected"<?php endif; ?>>置顶</option>
                                    <option value="2" <?php if(($tag) == "2"): ?>selected="selected"<?php endif; ?>>推荐</option>
                                    <option value="3" <?php if(($tag) == "3"): ?>selected="selected"<?php endif; ?>>热门</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                列表页显示的样式：</label>
                            <div class="controls">
                            	<select id="liststyle" name="liststyle" style="max-width:150px">
                                    <option value="1" <?php if(($liststyle) == "1"): ?>selected="selected"<?php endif; ?>>样式一</option>
                                    <option value="2" <?php if(($liststyle) == "2"): ?>selected="selected"<?php endif; ?>>样式二</option>
                                    <option value="3" <?php if(($liststyle) == "3"): ?>selected="selected"<?php endif; ?>>样式三</option>
                                    <option value="4" <?php if(($liststyle) == "4"): ?>selected="selected"<?php endif; ?>>样式四</option>
                                    <option value="5" <?php if(($liststyle) == "5"): ?>selected="selected"<?php endif; ?>>样式五</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                详情页显示的样式：</label>
                            <div class="controls">
                            	<select id="showstyle" name="showstyle" style="max-width:150px">
                            		<option value="1" <?php if(($showstyle) == "1"): ?>selected="selected"<?php endif; ?>>样式一</option>
                                    <option value="2" <?php if(($showstyle) == "2"): ?>selected="selected"<?php endif; ?>>样式二</option>
                                    <option value="3" <?php if(($showstyle) == "3"): ?>selected="selected"<?php endif; ?>>样式三</option>
                                    <option value="4" <?php if(($showstyle) == "4"): ?>selected="selected"<?php endif; ?>>样式四</option>
                                    <option value="5" <?php if(($showstyle) == "5"): ?>selected="selected"<?php endif; ?>>样式五</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                浏览的次数：</label>
                            <div class="controls">
                            	<input type="text" id="viewnum" name="viewnum" value='<?php echo ($information_info["viewnum"]); ?>' maxlength="9" onkeyup="value=value.replace(/[^\d]/g,'')" />
                                <span class="help-block">必须为数字</span>
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