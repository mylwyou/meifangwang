<?php
namespace Api\Controller;
use Think\Controller;
use Think\Exception;
use Common\Api\ReturnApi;

class WelcomeController extends Controller
{
    //欢迎页图片
    public function info ($resulttype='json',$callback='result')
    {
    	header("Content-type:text/html; charset=utf-8");
        try{
            $welcomepage = M('welcomepage');
            $welcomepage_list = $welcomepage->field('android_pic,ios_960,ios_1136,ios_1334,ios_2208')->limit(1)->select();
            //print_r($welcomepage_list.'<br>');

            if($welcomepage_list)
            {
                $row['msgcode']='0';
                $row['msg']='成功';
                foreach ($welcomepage_list[0] as $key=>$val)
                {
                    $domain=C('WEB_DOMAIN');
                    if($key=='android_pic'||$key=='ios_960'||$key=='ios_1136'||$key=='ios_1334'||$key=='ios_2208')
                    {
                        $val=empty($val)?"":$domain.$val;
                    }
                    //$row[$key]=htmlspecialchars_decode($val);//使用urlencode先将字段值里的汉字转码，然后获取时候使用urldecode解码
                    $row[$key]=urlencode($val);
                }

                $rt=urldecode(json_encode($row));

                ReturnApi::returnFunction($resulttype,$callback, $rt);
            }
            else
            {
                ReturnApi::errFunction(1002,'未找到数据',$resulttype,$callback,'');
            }
        }
        catch (Exception $e)
        {
            ReturnApi::errFunction(-1,'服务器错误',$resulttype,$callback,'');
        }

    }


}