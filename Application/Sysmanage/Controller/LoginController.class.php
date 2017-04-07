<?php
namespace Sysmanage\Controller;
use Think\Controller;

class LoginController extends Controller
{
	//渲染登陆页面
	public function index()
	{
		header("Content-type:text/html; charset=utf-8");
		$this->display('login');
	}

	//登陆
	public function checklogin ($adminname = '', $adminpwd = '')
    {
    	header("Content-type:text/html; charset=utf-8");

        if (IS_POST)
        {
            $adminname = I('post.adminname/s');
            $adminpwd = I('post.adminpwd/s');

            if ($adminname == '' || $adminpwd == '')
            {
                $this->error('请输入账号和密码');
            }

            // 使用liangshan库会员表登录
            $m_admin = M('admin');
            $row = $m_admin->where(sprintf('username="%s" and password="%s"', $adminname, md5($adminpwd)))->find();
            if ($row)
            { // 账号和密码正确
            	cookie('mf_adminname',$adminname,10800);//3小时过期
                $m_admin->logintime=NOW_TIME;
                $m_admin->loginip= get_client_ip_new(0);
                $m_admin->where(sprintf('username="%s" and password="%s"', $adminname, md5($adminpwd)))->save();
            	redirect(U('Home/index'));
            }
            else
            { // 账号和密码不正确
                $this->error('登录失败，请检查用户名和密码');
            }
        }
    }
}
