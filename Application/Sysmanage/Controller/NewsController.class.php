<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Think\Page;//分页
use Common\Sysmanage\LoginSysmanage;

class NewsController extends Controller
{

    //资讯列表
	public function index($pagesize='10')
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$information=M('information');
		$nowpage=I('get.p/d',1);//当前页
		$this->assign('p',$nowpage);

		$keyword=I('keyword','','strip_tags');//点击查询按钮获取textbox中参数值
		$catid=I('catid/d',0);
		$tag=I('tag/d',0);
		$this->assign('keyword',$keyword);//给搜索文本框赋值
		$this->assign('catid',$catid);//给搜索下拉框赋值
		$this->assign('tag',$tag);//给搜索下拉框赋值

		if(!empty($keyword))
		{
		    $map['title']=array('like','%'.$keyword.'%');
		    $pagepar['keyword']=$keyword;//分页参数用
		}
		if(!empty($catid)&&$catid!="0")
		{
		    $map['catid'] = array('eq',$catid);//sql查询用
		    $pagepar['catid']=$catid;//分页参数用
		}
		if(!empty($tag)&&$tag!="0")
		{
		    $map['tag'] = array('eq',$tag);//sql查询用
		    $pagepar['tag']=$tag;//分页参数用
		}


		$information_list=$information->page($nowpage,$pagesize)->field('id,title,pic,status,case catid when "1" then "环京专区" when "2" then "海南专区" when "3" then "华东专区" when "4" then "深广专区" end as catid_str,viewnum,case tag when "1" then "置顶" when "2" then "推荐" when "3" then "热门" end as tag_str,liststyle,showstyle,from_unixtime(createtime,"%Y-%m-%d %H:%i:%s") as createtime_str')->order('createtime desc')->where($map)->select();
		$this->assign('list',$information_list);//列表页赋值输出

		$count = $information->where($map)->count();// 查询满足要求的总记录数
		$Page = new Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($pagepar as $key=>$val) {
		    if (!is_array($val)) {
		        $Page->parameter[$key] = $val;
		    }
		}
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出

		$this->display();
	}

	//删除资讯数据
	public function del($id=0)
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$id=I('get.id/d');
		$nowpage=I('get.p/d');

		//查询参数的传递
		/* $keyword=I('keyword_cs/s',"");//点击查询按钮获取textbox中参数值
		$catid=I('catid_cs/d',0);
		$tag=I('tag_cs/d',0); */

		$information=M('information');
		$delresult= $information->delete($id);
		if($delresult)
		{
			$this->success('数据删除成功',U('index','p='.$nowpage),2);
		}
		else
		{
			$this->error('数据删除失败');
		}
	}

	//修改资讯数据时详细页数据显示
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
			$information=M('information');
			$information_info=$information->find($id);
 			$this->assign('information_info',$information_info);
 			$this->assign('catid',$information_info['catid']);
 			$this->assign('tag',$information_info['tag']);
 			$this->assign('liststyle',$information_info['liststyle']);
 			$this->assign('showstyle',$information_info['showstyle']);
		}
		$this->display();
	}

	//提交添加/修改资讯数据
	public function addsend()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$title=I('title/s','');
		$scontent=I('scontent/s','');
		$ncontent=I('ncontent/s','');
		$pic=I('pic/s','');
		$catid=I('catid/d',0);
		$tag=I('tag/d',0);
        $liststyle=I('liststyle/d',0);
        $showstyle=I('showstyle/d',0);
        $viewnum=I('viewnum/d',0);

		$information=M('information');

		$id=I('get.id/d');
		$action=I('get.action/s');
		if($action=='upd')//修改数据提交
		{
			$nowpage=I('get.p/d');
			$information->id=$id;
			$information->title=$title;
			$information->scontent=$scontent;
			$information->content=$ncontent;
			$information->pic=$pic;
			$information->catid=$catid;
			$information->tag=$tag;
			$information->liststyle=$liststyle;
			$information->showstyle=$showstyle;
			$information->viewnum=$viewnum;
            $information->updatetime=NOW_TIME;
			$updresult= $information->filter('strip_tags')->save();//返回的是影响的记录数
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
			$information->title=$title;
			$information->scontent=$scontent;
			$information->content=$ncontent;
			$information->pic=$pic;
			$information->catid=$catid;
			$information->tag=$tag;
			$information->liststyle=$liststyle;
			$information->showstyle=$showstyle;
			$information->viewnum=$viewnum;
            $information->createtime=NOW_TIME;
			$add=$information->filter('strip_tags')->add();//返回的是新增数据的ID
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

	//标签列表
	public function label($pagesize='10')
	{
	    header("Content-type:text/html; charset=utf-8");
	    LoginSysmanage::checklogin();
	    $label=M('label');
	    $nowpage=I('get.p/d');//当前页
	    $this->assign('p',$nowpage);
	    $label_list=$label->page($nowpage,$pagesize)->field('id,lname,orderby')->order('orderby desc')->select();


	    $count = $label->count();// 查询满足要求的总记录数
	    $this->assign('list',$label_list);//列表页赋值输出


	    $Page = new Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数

	    $show = $Page->show();// 分页显示输出
	    $this->assign('page',$show);// 赋值分页输出

	    $this->display();
	}

	//删除标签数据
	public function labeldel($id=0)
	{
	    header("Content-type:text/html; charset=utf-8");
	    LoginSysmanage::checklogin();
	    $id=I('get.id/d');
	    $nowpage=I('get.p/d');

	    $label=M('label');
	    $delresult= $label->delete($id);
	    if($delresult)
	    {
	        $this->success('数据删除成功',U('label','p='.$nowpage),2);
	    }
	    else
	    {
	        $this->error('数据删除失败');
	    }
	}

	//修改标签数据时详细页数据显示
	public function labeladd($id=0,$action="add")
	{
	    header("Content-type:text/html; charset=utf-8");
	    LoginSysmanage::checklogin();
	    $id=I('get.id/d');
	    $action=I('get.action/s');

	    if($action=='upd')//修改页面渲染
	    {
	        $nowpage=I('get.p/d',1);
	        $this->assign('p',$nowpage);
	        $this->assign('action',$action);
	        $this->assign('id',$id);
	        $label=M('label');
	        $label_info=$label->find($id);
	        $this->assign('label_info',$label_info);
	    }
	    $this->display();
	}

	//提交添加/修改标签数据
	public function labeladdsend()
	{
	    header("Content-type:text/html; charset=utf-8");
	    LoginSysmanage::checklogin();
	    $lname=I('lname/s','');
	    $orderby=I('paixu/d',0);

	    $label=M('label');

	    $id=I('get.id/d');
		$action=I('get.action/s');

	    if($action=='upd')//修改数据提交
	    {
	        $where['id']=array('neq',$id);
	        $where['lname']=array('eq',$lname);
	        $checkdt= $label->where($where)->find();
	        if($checkdt)
	        {
	            $this->error('该标签已存在，请换个标签名');
	        }
	        else
	        {
	            $nowpage=I('get.p/d');
	            $label->id=$id;
	            $label->lname=$lname;
	            $label->orderby=$orderby;
	            $updresult= $label->filter('strip_tags')->save();//返回的是影响的记录数
	            if($updresult===false)
	            {
	                $this->error('数据修改失败');
	            }
	            else
	            {
	                $this->success('数据修改成功',U('label','p='.$nowpage),2);
	            }
	        }
	    }
	    else//添加数据提交
	    {
	        $label->getBylname($lname);
	        if($label->id)
	        {
	            $this->error('该标签已存在，请换个标签名');
	        }
	        else
	        {
	            $label->lname=$lname;
	            $label->orderby=$orderby;
	            $label->createtime=NOW_TIME;
	            $add=$label->filter('strip_tags')->add();//返回的是新增数据的ID
	            if($add)
	            {
	                $this->success('数据添加成功',U('label'),2);
	            }
	            else
	            {
	                $this->error('数据添加失败');
	            }
	        }
	    }
	}

}