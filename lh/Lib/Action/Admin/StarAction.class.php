<?php

class StarAction extends CommonAction{
		public function index(){
    	$keyword = $_REQUEST['keyword'];
    	$where = array();
    	$pas = '';
    	if($keyword){
    		$where['starName'] = array('like','%'.$_REQUEST['keyword'].'%');
    		$pas .= '&keyword='.$keyword;
    		$this->assign('keyword',$keyword);
    	}
		$starMod = M('Star');
    	import("@.ORG.Util.Page");  //导入分页类
    	$count = $starMod->where($where)->count(); //查询满足要求的总记录数
    	$Page = new Page($count,25,$pas); //实例化分页类传入总记录数和每页显示的记录数
    	$show = $Page->show(); //分页显示输出
		$list = $starMod->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->where($where)->select();
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}
	
	
	public function edit(){
		$starMod = D('Star');
		$id = $_REQUEST['id'];
		if($this->isPost()){
			$star = $starMod->create();			
			$star['photos'] = $starMod->savePhotos($_POST['images']);			
			if($id){
				$star['updateTime'] = time();//获取更新时间
				$starMod->save($star);
				$this->success('编辑成功',U('Star/index'));
			}else{
				$star['createTime'] = time();//获取添加时间
				$star['updateTime'] = time();//获取更新时间
				$starMod->add($star);
				$this->success('添加成功',U('Star/index'));
			}
		}
		if($id){
			$where['id'] = $id;
			$step = $starMod->where($where)->find();
			$step['images'] = unserialize($step['photos']);
			$this->assign('star',$step);				
		}
		$this->display();
	}
	
	
		
		//删除节奏
		public function del(){
			$starMod = M('Star');
			$gid = $_REQUEST['id'];
			$where['id'] = $gid;
			$starMod->where($where)->delete();
			$this->success('删除成功',U('Star/index'));			
		}
}
?>