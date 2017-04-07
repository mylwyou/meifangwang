<?php
namespace Common\Api;

class ReturnApi
{
	//$msgcode=0表示成功，-1表示服务器错误，1001表示参数错误，1002表示未找到数据，2000表示数据提交失败，3000表示图片上传失败，$msg表示描述
	static function errFunction($errcode,$errmsg,$resulttype,$callback,$content)
	{
		if($errcode==-100&&$errmsg==-100)//表示输出详细数据
		{
			$result=$content;
		}
		else //表示输出列表数据
		{
			$result='{';
			$result.='"msgcode":"'.$errcode.'"';
			$result.=',"msg":"'.$errmsg.'"';
			if(!empty($content))
			{
				$result.=','.$content;
			}
			$result.='}';
		}
		if($resulttype=='jsonp')
		{
			echo $callback."(". $result.")";
		}
		else
		{
			echo $result;
		}
		exit();
	}

	//返回数据，将errcode和errmsg放到接口中，本方法比errFunction方法更灵活
	static function returnFunction($resulttype,$callback,$result)
	{
		if($resulttype=='jsonp')
		{
			echo $callback."(". $result.")";
		}
		else
		{
			echo $result;
		}
		exit();
	}

	static function api_post_curl($postUrl,$postDataArr)
	{
		//$postJosnData = json_encode($postDataArr);如果参数$postDataArr为数组，则使用json_encode将数组转为json串
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataArr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $tmpInfo;
	}
}