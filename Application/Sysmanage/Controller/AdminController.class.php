<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Think\Page;//分页
use Common\Sysmanage\LoginSysmanage;

class AdminController extends Controller
{
	//列表
	public function index($pagesize='10')
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$adminname=cookie('mf_adminname');
		$m_admin=M('admin');

		$nowpage=I('get.p/d');//当前页
		$this->assign('p',$nowpage);
		$m_admin_list=$m_admin->page($_GET['p'],$pagesize)->field('id,username,mobile,case role when "1" then "管理员" when "2" then "主编" when "3" then "助理" end as role,FROM_UNIXTIME(createtime,"%Y-%m-%d %H:%i:%s") as indbdate,loginip,from_unixtime(logintime,"%Y-%m-%d %H:%i:%s") as logindate')->order('createtime asc')->select();
		$this->assign('adminname',$adminname);
		$count = $m_admin->count();// 查询满足要求的总记录数
		$this->assign('list',$m_admin_list);
		$Page = new Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数

		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	//删除数据
	public function admindel($id=0)
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$id=I('get.id/d');
		$m_admin=M('admin');
		$delresult= $m_admin->delete($id);
		if($delresult)
		{
			$this->success('数据删除成功',U('index'),2);
		}
		else
		{
			$this->error('数据删除失败');
		}
	}

	//修改数据时详细页数据显示
	public function adminadd($id=0,$action="add")
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$adminname=cookie('mf_adminname');
		$this->assign('loginname',$adminname);
		$id=I('get.id/d');
		$action=I('get.action/s');
		if($action=='upd')//修改页面渲染
		{
			$this->assign('action',$action);
			$this->assign('id',$id);
			$m_admin=M('admin');
			$m_admin_info=$m_admin->field('username,mobile,role')->find($id);
			//print_r($m_admin_info['adminname']);
			//print_r($m_admin_info);
 			//exit();
 			$this->assign('m_admin_info',$m_admin_info);
 			$this->assign('adminname',$m_admin_info['adminname']);
 			$this->assign('role',$m_admin_info['role']);
 			$this->display();
		}
		else if($action=='resetpass')//重置密码数据提交
		{
			$m_admin=M('admin');
			$m_admin->id=$id;
			$m_admin->adminpwd=md5('888888');
			$updresult= $m_admin->save();//返回的是影响的记录数
			if($updresult===false)
			{
				$this->error('重置密码失败');
			}
			else
			{
				$this->success('登陆密码已重置，为“888888”',U('index'),3);
			}
		}
		else
		{
			$this->display();
		}
	}

	//修改密码
	public function updpass()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$adminname=cookie('mf_adminname');
		$action=I('get.action/s');
		if($action=='updpass')//修改密码提交
		{
			$passold=I('post.pwd3/s');
			$pass=I('post.pwd/s');
			$where['username']=$adminname;
			$where['password']=md5($passold);
			$m_admin=M('admin');
			$checkdt=$m_admin->where($where)->find();

			if($checkdt)
			{
				$m_admin->adminpwd=md5($pass);
				$updresult= $m_admin->where('username="'.$adminname.'"')->setField('password',md5($pass));//返回的是影响的记录数
				if($updresult===false)
				{
					$this->error('密码修改失败');
				}
				else
				{
					$this->success('密码修改成功',U('updpass'),2);
				}
			}
			else
			{
				$this->error('密码修改失败，原始密码不正确！');
			}
		}
		else//修改密码页面渲染
		{
			$this->display();
		}
	}

	//退出登陆
	public function logout()
	{
		cookie('mf_adminname',null);
		redirect(U('Login/index'));
	}

	//提交添加/修改数据
	public function adminaddsend()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$adminname=I('post.adminname/s');
		$mobile=I('post.mobile/s');
		$role=I('post.role/d');
		$m_admin=M('admin');

		$id=I('get.id/d');
		$action=I('get.action/s');
		if($action=='upd')//修改数据提交
		{
			$where['id']=array('neq',$id);
			$where['username']=array('eq',$adminname);
			$checkdt= $m_admin->where($where)->find();
			if($checkdt)
			{
				$this->error('该登陆帐号已存在，管理员修改失败');
			}
			else
			{
				$m_admin->id=$id;
				$m_admin->username=$adminname;
				$m_admin->mobile=$mobile;
				$m_admin->role=$role;
				$m_admin->updatetime=NOW_TIME;
				$updresult= $m_admin->filter('strip_tags')->save();//返回的是影响的记录数
				if($updresult===false)
				{
					$this->error('数据修改失败');
				}
				else
				{
					$this->success('数据修改成功',U('index'),2);
				}
			}
		}
		else//添加数据提交
		{
			$m_admin->getByusername($adminname);
			if($m_admin->id)
			{
				$this->error('该登陆帐号已存在，管理员添加失败');
			}
			else
			{
				$m_admin->username=$adminname;
				$m_admin->mobile=$mobile;
				$m_admin->password=md5('888888');
				$m_admin->role=$role;
				$m_admin->createtime=NOW_TIME;
				$add=$m_admin->filter('strip_tags')->add();//返回的是新增数据的ID
				if($add)
				{
					$this->success('数据添加成功',U('index'),2);
				}
				else
				{
					$this->error('数据添加失败');
				}
			}
		}
	}
}