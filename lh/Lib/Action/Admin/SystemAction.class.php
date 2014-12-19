<?php
class SystemAction extends CommonAction{
	
	/*
	 * 清除缓存
	 */
    public function clearcache() {
    	clear_cache();
    	$this->assign('backWin',true);
    	$this->success('缓存清除成功！');
    }
}
?>