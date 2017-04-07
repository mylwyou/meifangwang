<?php
namespace Common\Sysmanage;

class LoginSysmanage
{
	//判断是否登陆
	static function checklogin()
	{
		$ck=cookie('mf_adminname');//注意，这里需要先将cookie值放入一个变量里再进行判断
		if(empty($ck))
		{
			redirect(U('./Login'),3,'您还没有登陆，请先登陆');
		}
	}
}