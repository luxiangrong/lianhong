<?php

class CourseAction extends CommonAction{

    function index() {
    	$courseMod = D('Course');
    	import('@.ORG.Util.Page');
    	$count = $courseMod->where()->count();
    	$page = new Page($count,25);
    	$show = $page->show();
    	$list = $courseMod->where()->order()->limit($page->firstRow.','.$page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    function edit() {
    	$courseMod = D('Course');
    	$id = $_REQUEST['id'];
    	if($this->isPost()){
    		$data = $courseMod->create();
    		if($data !== false){
    			if($data['id']){
    				$courseMod->save($data);
    			}else{
    				$courseMod->add($data);
    			}
    			$this->assign('jumpUrl',U('Course/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($courseMod->getError());
    		}
    	}
    	if($id){
    		$where['id'] = $id;
    		$courseInfo = $courseMod->where($where)->find();
    		$this->assign('courseInfo',$courseInfo);
    	}
    	$this->display();
    }
    
    function del() {
    	$courseMod = D('Course');
    	$id = $_REQUEST['id'];
    	$where['id'] = $id;
    	$courseMod->where($where)->delete();
    	$this->assign('jumpUrl',U('Course/index'));
    	$this->success('删除成功');
    }
}
?>