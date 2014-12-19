<?php

class SysnavAction extends CommonAction{
	//导航列表
	public function index(){
		$navMod = D('SysNav');
		$list = $navMod->order('pid asc,navSort asc')->select();
		
		//导航显示树状图
    	import('@.ORG.Util.Tree');//引入层级类
    	$Tree = new Tree();//实例化层级类
    	foreach($list as $k=>$v){
    		$Tree->setNode($v['id'],$v['pid'],$v['navName']); 
		}
    	$category = $Tree->getChilds(); //获取子导航
    	$lists = array();
    	foreach ($category as $key => $id) { //遍历输出$type类型的导航（以层级结构的形式）
    		$val = array();
    		$val['id'] = $id;
    		$val['navName'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
    		foreach($list as $k=>$v){
    			if($v['id'] == $id){
    				$val['navSort'] = $v['navSort'];
    				$val['navDescription'] = $v['navDescription'];
    				$val['navUrl'] = $v['navUrl'];  
    				$val['status'] = $v['status']; 
    				$val['pid'] = $v['pid'];
    			}
    		}
			$lists[] = $val;
		}
		//print_r($lists);
		$this->assign('list',$lists);
		$this->display();
	}
	
	
	
	//导航添加修改
  	  public function edit() {
    	$navMod = D('SysNav');
		$nid = $_REQUEST['nid'];
    	if($this->isPost()){
    		$nav = $navMod->create();
			if($_FILES['navImg']['name']){
				$navimg = $this->upload();
				$nav['navImg'] = $navimg['navImg'];
			}
    		if($nid){
    			$where['id'] = $nid;
    			$navMod->where($where)->save($nav);  		
    			$this->success('编辑导航成功',U('Sysnav/index')); 
    			
    		}else{
	    		$navMod->add($nav); 
	    		$this->assign('jumpUrl',U('Sysnav/index'));    		
	    		$this->success('添加导航成功');  		
    			}
		}
    		
    		$where['id'] = $nid;
    		$nadd = $navMod->where($where)->find();
			$urlwhere = array(
					'pid' => 0,
					'status' => 1,
			);
			$list = $navMod->where($urlwhere)->select();
			$this->assign('nadd',$nadd);
	    	$this->assign('nid',$nid);
	    	$this->assign('name',$list);
			$this->display();
    }
    
    
    
    
    //删除导航
    public function del(){
    	$navMod = D('SysNav');
    	$nid = $_REQUEST['nid'];
    	$where['id'] = $nid;
    	$navMod->where($where)->delete();
    	$this->success('删除导航成功',U('Sysnav/index'));  
    }
}
?>