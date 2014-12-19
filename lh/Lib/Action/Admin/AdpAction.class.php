<?php

class AdpAction extends CommonAction{
		
 	/* 列表
	 */
    function index() {
    	$adsMod = D('Adplace');
    	import('@.ORG.Util.Page');//引入分页类
    	$count = $adsMod->where()->count();//计算总记录数
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$list = $adsMod->where()->order('updateTime desc,createTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    /*
	 * 广告位添加、修改
	 */
    function edit() {
    	$adsMod = D('Adplace');
    	if($this->isPost()){
    		$data = $adsMod->create(); 
    		$adpWhere['adpAlias'] = $data['adpAlias'];
    		$adpAlias = $adsMod->where($adpWhere)->find();
	    		if($data !== false){
	    			if($data['id']){
							if($adpAlias['adpAlias'] && $adpAlias['id'] != $data['id']){
								$this->error('别名以存在');
							}
	    				$data['updateTime'] = time(); //获取更新时间
	    				$adsMod->save($data);	//修改
	    			}else{
							if($adpAlias['adpAlias']){
								$this->error('别名以存在');
							}
	    				$data['createTime'] = time();//获取出创建时间
	    				$data['updateTime'] = time(); //获取更新时间
	    				$adsMod->add($data);	//添加
	    			}
	    			$this->assign('jumpUrl',U('Adp/index'));
	    			$this->success('保存成功');
	    		}else{
	    			$this->error($adsMod->getError());
	    		}
			
    	}
    	$id = $_REQUEST['id'];//获取广告id
    	if($id){
    		$where['adpAlias'] = $id;
    		$adsInfo = $adsMod->where($where)->find(); //通过id获取要修改的单页信息
    	}
    	
    	$this->assign('adsInfo',$adsInfo);
    	$this->display();
    }	
    		
    /*
	 * 单页删除
	 */
    function del() {
    	$id = $_REQUEST['id'];
    	$dictMod = D('Adplace');
    	$sWhere['adpAlias'] = $id;
    	$dictMod->where($sWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Adp/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
}
?>