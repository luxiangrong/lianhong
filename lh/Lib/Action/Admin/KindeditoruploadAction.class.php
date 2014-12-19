<?php

class KindeditoruploadAction extends BaseAction{

    function imageupload() {
    	import("@.ORG.UploadFile");    		
		$upload = new UploadFile(); // 实例化上传类		
		$upload->maxSize  = C('XSIZE') ; // 设置附件上传大小		
		$upload->allowExts  = C('ALLOWEXTS'); // 设置附件上传类型
		$upload->autoSub = true;	//启用子目录保存文件
		$upload->subType = "date";	//设置子目录创建方式
		$upload->dateFormat = "Ymd";
		$uid = session('adminid');
		if($uid){
			$uid = "admin";
		}
		$upload->savePath = './Public/uploads/'.$uid.'/'; // 设置附件上传目录
		$upload->saveRule = uniqid();  // 上传文件命名规则
		
		$msg = '';
		$filePath = '';
		if(!$upload->upload()) { // 上传错误提示错误信息
			$msg = $upload->getErrorMsg();
			$this->alert($msg);
		}else{ // 上传成功获取上传文件信息		
			$info =  $upload->getUploadFileInfo();
			//保存当前数据对象
			$filePath = $info[0]['savepath'].$info[0]['savename'];
		}
		header('Content-type: text/html; charset=UTF-8');
		
		echo json_encode(array('error' => 0, 'url' => $filePath));
		exit;
    }
    function alert($msg) {
		echo json_encode(array('error' => 1, 'message' => $msg));
		exit;
	}
    
    function filemanager() {
    	import("@.ORG.UploadFile");		
		$upload = new UploadFile(); // 实例化上传类		
		$upload->maxSize  = C('XSIZE') ; // 设置附件上传大小		
		$upload->allowExts  = C('ALLOWEXTS'); // 设置附件上传类型
		$upload->autoSub = true;	//启用子目录保存文件
		$upload->subType = "date";	//设置子目录创建方式
		$upload->dateFormat = "Ymd";
		$uid = session('adminid');
		if($uid){
			$uid = "admin";
		}
		$upload->savePath = './Public/uploads/'.$uid.'/'; // 设置附件上传目录
		$upload->saveRule = uniqid();  // 上传文件命名规则
		
		
		//根据path参数，设置各路径和URL
		if (empty($_GET['path'])) {
			$current_path = $upload->savePath;
			$current_url = $upload->savePath;
			$current_dir_path = '';
			$moveup_dir_path = '';
		} else {
			$current_path = $upload->savePath.$_GET['path'];
			$current_url = $upload->savePath.$_GET['path'];
			$current_dir_path = $_GET['path'];
			$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
		}
	
		//排序形式，name or size or type
		$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);
		//不允许使用..移动到上一级目录
		if (preg_match('/\.\./', $current_path)) {
			echo 'Access is not allowed.';
			exit;
		}
		//最后一个字符不是/
		if (!preg_match('/\/$/', $current_path)) {
			echo 'Parameter is not valid.';
			exit;
		}
		//目录不存在或不是目录
		if (!file_exists($current_path) || !is_dir($current_path)) {
			echo 'Directory does not exist.';
			exit;
		}
		
		//遍历目录取得文件信息
		$file_list = array();
		if ($handle = opendir($current_path)) {
			$i = 0;
			while (false !== ($filename = readdir($handle))) {
				if ($filename{0} == '.') continue;
				$file = $current_path . $filename;
				if (is_dir($file)) {
					$file_list[$i]['is_dir'] = true; //是否文件夹
					$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
					$file_list[$i]['filesize'] = 0; //文件大小
					$file_list[$i]['is_photo'] = false; //是否图片
					$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
				} else {
					$file_list[$i]['is_dir'] = false;
					$file_list[$i]['has_file'] = false;
					$file_list[$i]['filesize'] = filesize($file);
					$file_list[$i]['dir_path'] = '';
					$file_ext = strtolower(array_pop(explode('.', trim($file))));
					$file_list[$i]['is_photo'] = in_array($file_ext, $upload->allowExts);
					$file_list[$i]['filetype'] = $file_ext;
				}
				$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
				$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
				$i++;
			}
			closedir($handle);
		}
		
		$result = array();
		//相对于根目录的上一级目录
		$result['moveup_dir_path'] = $moveup_dir_path;
		//相对于根目录的当前目录
		$result['current_dir_path'] = $current_dir_path;
		//当前目录的URL
		$result['current_url'] = $current_url;
		//文件数
		$result['total_count'] = count($file_list);
		//文件列表数组
		$result['file_list'] = $file_list;
		
		//输出JSON字符串
		header('Content-type: application/json; charset=UTF-8');		
		echo json_encode($result);
    }
}
?>