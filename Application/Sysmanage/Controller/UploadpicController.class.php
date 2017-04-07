<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Common\Sysmanage\LoginSysmanage;

class UploadpicController extends Controller
{
	//图片上传页面渲染
	public function index()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$flag=I('get.flag/s');
		$this->assign('flag',$flag);
		$dis=I('get.dis');
		$this->assign('dis',$dis);
		$width=I('get.width');
		$this->assign('width',$width);
		$height=I('get.height');
		$this->assign('height',$height);
		$upflag=I('get.upflag');
		$this->assign('upflag',$upflag);
		$this->display();
	}

	//图片上传
	public function upload($width=500,$height=400,$upflag=1){
	    $picfolder="";
	    switch ($upflag)
	    {
	        case 1://轮播图
	            $picfolder="bannerimg";
	            break;
	        case 2://欢迎页图/引导页图
	            $picfolder="sysimg";
	            break;
	        case 3://资讯图片
	            $picfolder="newsimg";
	            break;
	        default:
	            $picfolder="bannerimg";
	    }


		$flag=I('get.flag/s');
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath = './'.$picfolder.'/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录
		$upload->autoSub  = true;//自动使用子目录保存上传文件 默认为true
		$upload->subName  = array('date','Ymd');//子目录创建方式，采用数组或者字符串方式定义
		// 上传文件
 		//$info = $upload->upload();//当只传一张图片并知道file控件的name时，可以使用下面的来上传
		$info = $upload->uploadOne($_FILES['pic']);//这里$_FILES['pic']中的pic是file控件的name
		if(!$info) // 上传错误提示错误信息
		{
			echo '上传失败！'.$upload->getError();
		}
		else// 上传成功
		{
			//生成缩略图
			/* $image = new \Think\Image();
			$image->open('./'.$picfolder.'/'.$info['savepath'].$info['savename']);
			$image->thumb($width, $height,\Think\Image::IMAGE_THUMB_FIXED)->save('./'.$picfolder.'/'.$info['savepath'].'s_'.$info['savename']);
 			$this->assign('picurl','/'.$picfolder.'/'.$info['savepath'].'s_'.$info['savename']);//也可以使用下面的方法
//  			foreach($info as $file){
//  				$this->assign('picurl','/'.$picfolder.'/'.$file['savepath'].$file['savename']);
//  			} */


 			$this->assign('flag',$flag);
 			$this->assign('picurl','/'.$picfolder.'/'.$info['savepath'].$info['savename']);//也可以使用下面的方法
 			$this->assign('ifsuccess','ok');
 			$this->display('index');
		}
	}
}