<?php

class LinkAction extends CommonAction{
	
	/*
	 * 列表
	 */
    function index() {
    	$type = $_REQUEST['type'];
    	$where['linkType'] = $type;
    	$linkMod = D('Links');
    	import('@.ORG.Util.Page');//引入分页类
    	$count = $linkMod->where($where)->count();//计算总记录数
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$list = $linkMod->where($where)->order('linkSort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('type',$type);
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    /*
	 * 添加、修改
	 */
    function edit() {
    	$type = $_REQUEST['type'];
    	$linkMod = D('Links');
    	
    	//获取修改的值
    	$id = $_REQUEST['id'];
    	if($id){
    		$where['id'] = $id;
    		$linkInfo = $linkMod->where($where)->find(); 
    	}
    	$type = $type ? $type : ($linkInfo ? $linkInfo['linkType'] : '');
    	
    	if($this->isPost()){
    		$data = $linkMod->create();
    		if($data !== false){
    			if($data['id']){
    				$linkMod->save(); //修改
    			}else{
    				$linkMod->add(); //添加
    			}
    			$this->assign('jumpUrl',U('Link/index?type='.$type));
    			$this->success('保存成功');
    		}else{
    			$this->error($linkMod->getError());
    		}
    	}
    	
    	$this->assign('type',$type);   	
		$this->assign('linkInfo',$linkInfo);    	
    	$this->display();
    }
    
    /*
	 * 删除
	 */
    function del() {
    	$id = $_REQUEST['id'];
    	$linkMod = D('Links');
    	$lWhere['id'] = $id;
    	$type = $linkMod->where($lWhere)->find();
    	$linkMod->where($lWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Link/index?type='.$type['linkType']));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
}
?>