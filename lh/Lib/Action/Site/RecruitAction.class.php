<?php
class RecruitAction extends BaseAction{
	
	function _initialize(){
		parent::_initialize();
	}
	
	function index(){
		$recruitModel = D('Recruit');
		import('@.ORG.Util.ClientPage'); 
		$count = $recruitModel->count(); 	
    	$Page = new ClientPage($count,10);
    	$show = $Page->show();
		$recruitInfos = $recruitModel->order('createTime desc,updateTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('page',$show);
		$this->assign('recruitInfos',$recruitInfos);
       	$this->display('Recruit:index'); 		
	}
	
	function view(){
		$id = intval($_REQUEST['id']); //$id的值为1,2,3...
		$id = $id > 0 ? $id : 1;
		$recruitModel = D('Recruit');
		
		$where['id'] = $id;
		$recruitInfo = $recruitModel->where($where)->order('id')->find();
		
		if(!$recruitInfo){
			$this->assign('jumpUrl',U('Recruit/index'));
			$this->error("该职位不存在");
		}
		$ids = $recruitModel->field('id')->order('id asc')->select();
		
		import('@.ORG.Util.ClientRePage');
		$page = new ClientRePage($ids,1);
		$show = $page->show();
		
		$this->assign('page',$show);
		$this->assign('info',$recruitInfo);		
       	$this->display(); 		
	}
	
	
	function _empty(){
		$model = D('Single');
		$intro['singleName'] = ACTION_NAME;
		$introInfo = $model->where($intro)->find();
		$this->assign('info',$introInfo);
       	$this->display('Recruit:single'); 
	}
	
	
}
?>