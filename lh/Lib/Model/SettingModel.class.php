<?php

class SettingModel extends CommonModel{

	public function saveSetting() {
    	$setting = $_POST['setting'];
    	foreach($setting as $k=>$v){
    		if(!$k) continue;
    		$v = is_array($v) ? serialize($v) : $v;
    		$this->add(array('skey'=>$k,'sval'=>$v),'',true);
    	}
    }
    
    
	public function getSetting(){
    	$setting = $this->select();
    	$setingInfo = array();
    	foreach($setting as $v){
			$setingInfo[$v['skey']] = unserialize($v['sval']) ? unserialize($v['sval']) : stripslashes($v['sval']);
    	}
    	F('setting',$setingInfo);
    	return $setingInfo;
    }
}
?>