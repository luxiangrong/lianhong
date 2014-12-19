<?php
class BaseAction extends Action{
	var $setting;
	function _initialize() {
		
    	$this->setting = get_setting();
    	if($this->setting['website']){
    		C('SITE_URL',$this->setting['website']);
    	}
    	C('ERROR_PAGE',U('Error/index'));
    	$seoModel = D('SiteSeo');
    	$seoWhere['group'] = GROUP_NAME;
    	$seoWhere['mod'] = MODULE_NAME;
    	$seoWhere['act'] = ACTION_NAME;
    	$seoInfo = $seoModel->where($seoWhere)->find(); 
    	
    	//旗下企业左侧导航
    	$comMod = D('Star');
    	$comList = $comMod->where()->order()->limit()->select();    	
    	
    	$this->assign('comList',$comList);    	
    	$this->assign('keywords',getKeywords($this->setting['hotSearch']));
    	$this->assign('setting',$this->setting);
    	$this->assign('seoTitle',$seoInfo['seoTitle'] ? $seoInfo['seoTitle'] : $this->setting['siteTitle']);
    	$this->assign('seoKeywords',$seoInfo['seoKeywords'] ? $seoInfo['seoKeywords']  : $this->setting['keywords']);
    	$this->assign('seoDescription',$seoInfo['seoDescription'] ? $seoInfo['seoDescription']  : $this->setting['description']);
    }
}
?>