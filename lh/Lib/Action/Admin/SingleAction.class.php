<?php

class SingleAction extends CommonAction{
	
	/*
	 * 单页列表
	 */
    function index() {
    	$singleMod = D('Single');
    	import('@.ORG.Util.Page');//引入分页类
    	$count = $singleMod->where()->count();//计算总记录数
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$list = $singleMod->where()->order('singleSort asc,id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->assign('dictTypes',C('DICT_TYPES'));
    	$this->display();
    }
    
    /*
	 * 单页添加、修改
	 */
    function edit() {
    	$singleMod = D('Single');
    	$types = C('SINGLE_TYPES');
    	if($this->isPost()){
    		$data = $singleMod->create();
    		if($data !== false){
    			if($data['id']){
    				$data['updateTime'] = time(); //获取更新时间
    				$singleMod->save($data);	//修改
    			}else{
    				$data['createTime'] = time();//获取出创建时间
    				$data['updateTime'] = time(); //获取更新时间
    				$singleMod->add($data);	//添加
    			}
    			$this->assign('jumpUrl',U('Single/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($singleMod->getError());
    		}
    	}
    	$id = $_REQUEST['id'];//获取单页id
    	if($id){
    		$where['id'] = $id;
    		$singleInfo = $singleMod->where($where)->find(); //通过id获取要修改的单页信息
    	}
    	
    	$this->assign('singleInfo',$singleInfo);
    	$this->assign('singleTypes',$types);
    	$this->display();
    }
    
    /*
	 * 单页删除
	 */
    function del() {
    	$id = $_REQUEST['id'];
    	$dictMod = D('Single');
    	$sWhere['id'] = $id;
    	$dictMod->where($sWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Single/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
}
?>