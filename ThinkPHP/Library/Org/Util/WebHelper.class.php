<?php 
namespace Org\Util;
class WebHelper
{
	
	/**
	 * 禁止外部提交
	 *
	 */
	public static function disableSubmitOutOfWebSite()
	{  	
	    $server_v1 = trim($_SERVER["HTTP_REFERER"]);
	    $server_v2 = trim($_SERVER["SERVER_NAME"]);    
	    //if(strcmp(strtolower(substr($server_v1,7,strlen($server_v2))),strtolower($server_v2))==0) //这样也可以
	    if (strtolower(substr($server_v1,7,strlen($server_v2)))==strtolower($server_v2))
	    { }
	    else
	    {
	        echo '<script>top.location.href="/";</script>';
	        exit();
	    } 
	}
	
}
		