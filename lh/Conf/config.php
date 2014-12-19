<?php
return array(
	/*系统配置*/
	'APP_DEBUG'		=>	APP_DEBUG,
	'APP_GROUP_LIST' => 'Site,Admin', //项目分组设定 
	'DEFAULT_GROUP'  => 'Site', //默认分组

	'URL_MODEL'		 =>	0,
	'LOG_EXCEPTION_RECORD' => true,
	'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,INFO,DEBUG,SQL,NOTICE',
	'URL_CASE_INSENSITIVE' =>true,

	'LAYOUT_ON'	=>	true,
	/*项目配置*/
	'TMPL_PARSE_STRING'  => array(
    	'__SITE__'	=>	'./Public/site',	
	),
	'SITE_URL'	=>	'http://'.$_SERVER['HTTP_HOST'],
	
	/*数据库配置*/
	'DB_HOST'	=>	'localhost',
	'DB_NAME'	=>	'lianhong',
	'DB_USER'	=>	'root',
	'DB_PWD'	=>	'',
	'DB_PORT'	=>	3306,
	'DB_PREFIX'	=>	'lh_',
	
	/*类型配置*/
	'DICT_TYPES'=>array(
					array('type'=>'news','name'=>'联泓动态'),
					//array('type'=>'media','name'=>'媒体新闻'),
				),
	'SINGLE_TYPES'=>array(
					array('type'=>'intro','name'=>'关于联泓'),
					//array('type'=>'help','name'=>'人才招聘'),					
				),	
				
	'NAV_TYPES'=>array(
					array('navType'=>'top','navName'=>'头部导航'),
					array('navType'=>'end','navName'=>'尾部导航'),
				),
	
				
	//配置上传图片的一些配置
	'XSIZE' => 3145728, 							//设置附件上传大小	
	'ALLOWEXTS'=>array('jpg', 'gif', 'png', 'jpeg','rar'),//设置附件上传类型
	'SAVEPATH' => './Public/uploads/',				// 设置附件上传目录
	
);


?>