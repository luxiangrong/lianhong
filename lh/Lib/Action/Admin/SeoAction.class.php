<?php
/*
 * 网站关键字
 */
class SeoAction extends CommonAction{

    function index() {
    	$seoModel = D('SiteSeo');
    	$where = array();
    	$list = $seoModel->where()->order('id desc')->select();
    	
    	$this->assign('list',$list);
    	$this->display();
    }
    
    
    
    
    function edit(){
    	$seoModel = D('SiteSeo');
    	if($this->isPost()){
    		$data = $seoModel->create(); 
    		if($data !== false){
    			if($data['id']){
    				$seoModel->save($data);	//修改
    			}else{
    				$seoModel->add($data);	//添加
    			}
    			$this->assign('jumpUrl',U('Seo/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($seoModel->getError());
    		}
    	}
    	$id = $_REQUEST['id'];//获取广告id
    	if($id){
    		$where['id'] = $id;
    		$seoInfo = $seoModel->where($where)->find(); //通过id获取要修改的单页信息
    	}
    	$this->assign('seoInfo',$seoInfo);
    	$this->display();
    }
    
    
    function del(){
    	$id = $_REQUEST['id'];
    	$seoModel = D('SiteSeo');
    	$sWhere['id'] = $id;
    	$seoModel->where($sWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Seo/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
}
?>