<?php

class UploadAction extends CommonAction{

   function upload() {
    	import("@.ORG.UploadFile");		
		$upload = new UploadFile(); // 实例化上传类		
		$upload->maxSize  = C('XSIZE') ; // 设置附件上传大小		
		$upload->allowExts  = C('ALLOWEXTS'); // 设置附件上传类型
		$upload->autoSub = true;	//启用子目录保存文件
		$upload->subType = "date";	//设置子目录创建方式
		$upload->dateFormat = "Ymd";
		$uid = session('adminid');
		if($uid == 1){
			$uid = "admin";
		}
		$upload->savePath = './Public/uploads/'.$uid.'/'; // 设置附件上传目录
		$upload->saveRule = uniqid();  // 上传文件命名规则
		
		$msg = '';
		$filePath = '';
		if(!$upload->upload()) { // 上传错误提示错误信息
			$msg = $upload->getErrorMsg();
		}else{ // 上传成功获取上传文件信息		
			$info =  $upload->getUploadFileInfo();
			//保存当前数据对象
			$filePath = $info[0]['savepath'].$info[0]['savename'];
		}
		exit(json_encode(array('msg'=>$msg,'file'=>$filePath)));
    }
}
?>