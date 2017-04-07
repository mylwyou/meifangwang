<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Common\Sysmanage\LoginSysmanage;

class HomeController extends Controller
{
	//渲染后台主页面
	public function index()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$this->display();
	}


}
