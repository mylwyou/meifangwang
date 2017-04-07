<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
<head>
    <title>美房网后台管理系统</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/unicorn.main1.css" />
    
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/uniform.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/select2.css" />
    <link rel="stylesheet" type="text/css" href="/Public/sysmanage/css/unicorn.grey.css" />
    <script type="text/javascript" src="/Public/sysmanage/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/jquery.ui.custom.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/jquery.uniform.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/select2.min.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/unicorn.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/unicorn.form_common.js"></script>
    <script type="text/javascript" src="/Public/sysmanage/js/lhgcore.min.js"></script>
    <script>
    $(function(){
    	var a='<?php echo ($ifsuccess); ?>';//如果是首次进来，则不操作，如果是图片已经上传到服务器上，则将图片地址回传到父窗口中
    	if(a=='ok')
    	{
    		var DG = frameElement.lhgDG;
    		J('#<?php echo ($flag); ?>_img',DG.curDoc).attr("src",'<?php echo ($picurl); ?>');//子窗口中给父窗口里img的src赋值
    		J('#<?php echo ($flag); ?>',DG.curDoc).val('<?php echo ($picurl); ?>'); //子窗口中给父窗口里的hidden赋值
    		DG.cancel();//关闭子窗口
    	}
    });
    </script>

</head>
<body>
<div id="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                    	
	<form action="/index.php/Sysmanage/Uploadpic/upload/flag/<?php echo ($flag); ?>/width/<?php echo ($width); ?>/height/<?php echo ($height); ?>/upflag/<?php echo ($upflag); ?>" method="post" class="form-horizontal" name="yuziform" id="yuziform" enctype="multipart/form-data">
	 	<div >
			<input type="file" name="pic"  />&nbsp;&nbsp;<button type="submit" class="btn btn-primary">上传</button>
			<span class="help-block">&nbsp;<?php echo ($dis); ?></span>
		</div>
    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>