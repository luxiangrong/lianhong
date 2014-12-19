<?php

class RecruitAction extends CommonAction {

  	/* 列表
	 */
	function index() {
    	$recruitMod = D('Recruit');
    	import('@.ORG.Util.Page');//引入分页类
    	$count = $recruitMod->count();//计算总记录数
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$list = $recruitMod->order('createTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    /*
	 * 单页添加、修改
	 * ads表中adType字段值为	word 是文字广告
	 * ads表中adType字段值为	img 是图片广告
	 */
    function edit() {
    	$recruitMod = D('Recruit');
    	
    	//获取修改的值
    	$id = $_REQUEST['id'];
    	if($id){
    		$where['id'] = $id;
    		$info = $recruitMod->where($where)->find(); 
    	}
    	
    	if($this->isPost()){
    		$data = $recruitMod->create();
    		if($data !== false){
    			$data['createTime'] = strtotime($_POST['createTime']);
    			if($data['id']){
    				$data['updateTime'] = time();
    				$recruitMod->save($data); //修改
    			}else{
    				$data['updateTime'] = time();
    				$recruitMod->add($data); //添加
    			}
    			$this->assign('jumpUrl',U('Recruit/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($recruitMod->getError());
    		}
    	}
    	  	
		$this->assign('info',$info);    	
    	$this->display();
    }
    
    /*
	 * 单页删除
	 */
    function del() {
    	$id = $_REQUEST['id'];
    	$recruitMod = D('Recruit');
    	$lWhere['id'] = $id;
    	$type = $recruitMod->where($lWhere)->find();
    	$recruitMod->where($lWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Recruit/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
}
?>