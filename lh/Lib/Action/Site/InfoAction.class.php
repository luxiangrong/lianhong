<?php
class InfoAction extends BaseAction{
	
	function index(){
		$model = D('Single');
		$where['singleType'] = 'intro';
		$info = $model->where($where)->select();
		foreach($info as $key=>$val)
		{
			  $this->assign($val['singleName'],$val);
			
		}
		$this->assign('info',$info);
		$this->display();		
	}
	
	function _empty(){
		$model = D('Single');
		$intro['singleName'] = ACTION_NAME;
		$introInfo = $model->where($intro)->find();
		$this->assign('info',$introInfo);
       	$this->display(); 
	}
	
	//发展历程
	function course(){
		$courseMod = D('Course');
		import('@.ORG.Util.ClientPage');
		$count = $courseMod->where()->count();
		$page = new ClientPage($count,10);
		$show = $page->show();
		$courseList  = $courseMod->where()->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('courseList',$courseList);
		$this->assign('page',$show);
		$this->display();
	}
}
?>