<?php

class CompanyAction extends BaseAction{

    function index() {
    	$starMod = D('Star');
    	import('@.ORG.Util.Page');
    	$count = $starMod->where()->count();
    	$page = new Page($count,6);
    	$show = $page->show();
    	$list = $starMod->where()->order()->limit($page->firstRow.','.$page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    function view(){
    	$starMod = D('Star');
    	$id = $_REQUEST['id'];
    	
    	$where['id'] = $id;
    	$info = $starMod->where($where)->find();
    	$info['images'] = unserialize($info['photos']);     	
    	
    	$this->assign('info',$info);
    	$this->display();
    }
}
?>