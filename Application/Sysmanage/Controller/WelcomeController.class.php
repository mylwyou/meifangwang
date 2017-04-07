<?php
namespace Sysmanage\Controller;
use Think\Controller;
use Common\Sysmanage\LoginSysmanage;

class WelcomeController extends Controller
{

    //列表
	public function index()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();

		$fb_trip_pic=M('welcomepage');
		$fb_trip_pic_info=$fb_trip_pic->find();
		$this->assign('fb_trip_pic_info',$fb_trip_pic_info);
		$this->display();
	}


	//提交添加/修改数据
	public function addsend()
	{
		header("Content-type:text/html; charset=utf-8");
		LoginSysmanage::checklogin();
		$android_pic=I('post.android_pic/s','');
		$ios_480=I('post.ios_480/s','');
		$ios_960=I('post.ios_960/s','');
		$ios_1136=I('post.ios_1136/s','');
		$ios_1334=I('post.ios_1334/s','');
		$ios_2208=I('post.ios_2208/s','');


		$fb_trip_pic=M('welcomepage');
        $fb_trip_pic_maxid=$fb_trip_pic->max('id');
        if($fb_trip_pic_maxid)
        {
            $fb_trip_pic->android_pic=$android_pic;
            $fb_trip_pic->ios_480=$ios_480;
            $fb_trip_pic->ios_960=$ios_960;
            $fb_trip_pic->ios_1136=$ios_1136;
            $fb_trip_pic->ios_1334=$ios_1334;
            $fb_trip_pic->ios_2208=$ios_2208;
            $updresult= $fb_trip_pic->where('id='.$fb_trip_pic_maxid)->filter('strip_tags')->save();//返回的是影响的记录数
            if($updresult===false)
            {
                $this->error('数据修改失败');
            }
            else
            {
                $this->success('数据修改成功',U('index'),2);
            }
        }
        else
        {
            $fb_trip_pic->android_pic=$android_pic;
            $fb_trip_pic->ios_480=$ios_480;
            $fb_trip_pic->ios_960=$ios_960;
            $fb_trip_pic->ios_1136=$ios_1136;
            $fb_trip_pic->ios_1334=$ios_1334;
            $fb_trip_pic->ios_2208=$ios_2208;
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