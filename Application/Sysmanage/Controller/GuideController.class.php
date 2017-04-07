<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Think\Page;//分页
use Common\Sysmanage\LoginSysmanage;

class GuideController extends Controller
{

    //列表
	public function index($pagesize='10')
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$guide=M('guide');
		$nowpage=I('get.p/d',1);//当前页
		$this->assign('p',$nowpage);
		$guide_list=$guide->page($nowpage,$pagesize)->field()->order('orderby desc')->select();
		$this->assign('list',$guide_list);//列表页赋值输出

		$count = $guide->count();// 查询满足要求的总记录数
		$Page = new Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出

		$this->display();
	}

	//删除数据
	public function del($id=0)
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$id=I('get.id/d');
		$nowpage=I('get.p/d');
		$guide=M('guide');
		$delresult= $guide->delete($id);
		if($delresult)
		{
			$this->success('数据删除成功',U('index','p='.$nowpage),2);
		}
		else
		{
			$this->error('数据删除失败');
		}
	}

	//修改数据时详细页数据显示
	public function add($id=0,$action="add")
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$id=I('get.id/d');
		$action=I('get.action/s');

		if($action=='upd')//修改页面渲染
		{
			$nowpage=I('get.p/d');
			$this->assign('p',$nowpage);
			$this->assign('action',$action);
			$this->assign('id',$id);
			$guide=M('guide');
			$guide_info=$guide->find($id);
 			$this->assign('guide_info',$guide_info);
		}
		$this->display();
	}

	//提交添加/修改数据
	public function addsend()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$android_pic=I('android_pic/s','');
		$ios_960=I('ios_960/s','');
		$ios_1136=I('ios_1136/s','');
		$ios_1334=I('ios_1334/s','');
		$ios_2208=I('ios_2208/s','');
		$paixu=I('paixu/d',0);

		$guide=M('guide');

		$id=I('get.id/d');
		$action=I('get.action/s');
		if($action=='upd')//修改数据提交
		{
			$nowpage=I('p/d');
			$guide->id=$id;
			$guide->android_pic=$android_pic;
			$guide->ios_960=$ios_960;
			$guide->ios_1136=$ios_1136;
			$guide->ios_1334=$ios_1334;
			$guide->ios_2208=$ios_2208;
			$guide->orderby=$paixu;
            $guide->updatetime=NOW_TIME;
			$updresult= $guide->filter('strip_tags')->save();//返回的是影响的记录数
			if($updresult===false)
			{
				$this->error('数据修改失败');
			}
			else
			{
				$this->success('数据修改成功',U('index','p='.$nowpage),2);
			}
		}
		else//添加数据提交
		{
			$guide->android_pic=$android_pic;
			$guide->ios_960=$ios_960;
			$guide->ios_1136=$ios_1136;
			$guide->ios_1334=$ios_1334;
			$guide->ios_2208=$ios_2208;
			$guide->orderby=$paixu;
            $guide->createtime=NOW_TIME;
			$add=$guide->filter('strip_tags')->add();//返回的是新增数据的ID
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