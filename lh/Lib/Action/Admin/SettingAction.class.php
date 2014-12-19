<?php

class SettingAction extends CommonAction{
	
	/*
	 * 系统基本配置
	 */
    public function index() {
    	$setMod = D('Setting');
    	if($this->isPost()){    		
    		$setMod->saveSetting();
    		$this->assign('jumpUrl',U('Setting/index'));
    		$this->success('保存设置成功');
    	}else{
    		$setInfo = $setMod->getSetting();
    		$this->assign('setInfo',$setInfo);
    		$this->display();
    	}
    }
    
    /*
     * 邮件配置
     */
    public function email(){
    	$setMod = D('Setting');
    	if($this->isPost()){    		
    		$setMod->saveSetting();
    		$this->assign('jumpUrl',U('Setting/email'));
    		$this->success('保存设置成功');
    	}else{
    		$setInfo = $setMod->getSetting();
    		$this->assign('setInfo',$setInfo);
    		$this->display();
    	}
    }
    
     /*
     * 邮件检测
     */
    public function test(){
    	if($this->isPost()){
	    	$email = $_POST['email'];
	    	$content = $_POST['content'];
	    	$title = $_POST['title'];		
	    	$a = send_email($email,$title,$content);
	    	if($a){
	    		$this->success('发送成功');
	    	}else{
	    		$this->error('发送失败');
	    	}	    		
    	}
    	$this->display();
    }
    
    /*系统默认设置*/
    public function sysdefault(){
    	$setMod = D('Setting');
    	$setInfo = $setMod->getSetting();
    	if($this->isPost()){   		
    		$images = $_POST['images'];
    		$index = $_POST['index'];
    		$images = array_combine($index,$images);
    		foreach($images as $key => $val){
				if(empty($val)){
					unset($images[$key]);
					continue;
				}
				$images[$key] = $val;
			}
			ksort($images);
			$image = serialize($images);
			$setData['skey'] = "images";
			$setData['sval'] = $image;
    		if($setInfo['images']){
    			$setMod->save($setData);
    		}else{
    			$setMod->add($setData);
    		}
    		$this->assign('jumpUrl',U('Setting/sysdefault'));
    		$this->success('保存设置成功');
    	}
    	
		$this->assign('setInfo',$setInfo);
		$this->display();
    }
    
    /*验证码设置*/
    public function syscode(){
    	$setMod = D('Setting');
    	if($this->isPost()){    		
    		$setMod->saveSetting();
    		$this->assign('jumpUrl',U('Setting/syscode'));
    		$this->success('保存设置成功');
    	}else{
    		$setInfo = $setMod->getSetting();
    		$this->assign('setInfo',$setInfo);
    		$this->display();
    	}
    }
    
    /*通知模板*/
    public function template(){
    	$this->display();
    }
    
}
?>