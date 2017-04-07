<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Think\Page;//分页
use Common\Sysmanage\LoginSysmanage;

class CarouselController extends Controller
{

    //列表
	public function index($pagesize='10')
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$fb_trip_pic=M('banner');
		$nowpage=I('get.p/d');//当前页
		$this->assign('p',$nowpage);
		$fb_trip_pic_list=$fb_trip_pic->page($_GET['p'],$pagesize)->field('title,id,picurl,orderby,pic')->order('orderby desc')->select();


		$count = $fb_trip_pic->count();// 查询满足要求的总记录数
		$this->assign('list',$fb_trip_pic_list);//列表页赋值输出


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
		$fb_trip_pic=M('banner');
		$delresult= $fb_trip_pic->delete($id);
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
		//$adminname=cookie('fc_adminname');
		//$this->assign('loginname',$adminname);
		$id=I('get.id/d');
		$action=I('get.action/s');

		if($action=='upd')//修改页面渲染
		{
			$nowpage=I('get.p/d');
			$this->assign('p',$nowpage);
			$this->assign('action',$action);
			$this->assign('id',$id);
			$fb_trip_pic=M('banner');
			$fb_trip_pic_info=$fb_trip_pic->find($id);
 			$this->assign('fb_trip_pic_info',$fb_trip_pic_info);
		}
		$this->display();
	}

	//提交添加/修改数据
	public function addsend()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$ptitle=I('post.ptitle/s','');
		$paixu=I('post.paixu/d',0);
		$url=I('post.url/s','');
		$pic=I('post.pic/s','');

		$fb_trip_pic=M('banner');

		$id=I('get.id/d');
		$action=I('get.action/s');
		if($action=='upd')//修改数据提交
		{
			$nowpage=I('get.p/d');
			$fb_trip_pic->id=$id;
			$fb_trip_pic->pic=$pic;
			$fb_trip_pic->title=$ptitle;
			$fb_trip_pic->orderby=$paixu;
			$fb_trip_pic->picurl=$url;

			$updresult= $fb_trip_pic->filter('strip_tags')->save();//返回的是影响的记录数
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
			$fb_trip_pic->pic=$pic;
			$fb_trip_pic->title=$ptitle;
			$fb_trip_pic->orderby=$paixu;
			$fb_trip_pic->picurl=$url;

			$add=$fb_trip_pic->filter('strip_tags')->add();//返回的是新增数据的ID
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