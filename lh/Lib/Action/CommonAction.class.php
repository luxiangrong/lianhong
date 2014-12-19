<?php

class CommonAction extends Action {

     function _initialize() {
    	if(!$this->_checkUser() && strtolower(ACTION_NAME) !== 'login'){
    		$this->redirect('Public/login');
    	}
    }
    
    private function _checkUser(){
    	if($_SESSION['adminid']){
    		return true;
    	}
    	return false;
    }
    
	
}

?>