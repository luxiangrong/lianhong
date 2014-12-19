<?php

class NavAction extends CommonAction{
	//导航列表
	public function index(){
		$navMod = D('Nav');
		$list = $navMod->order('navSort desc')->select();
		
		//导航显示树状图
		$types = C('NAV_TYPES'); //获取所有的导航类型
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
    				foreach($types as $t=>$ty){
    					if($v['navType'] == $ty['navType']){
    						$val['navType'] = $ty['navName']; //获取导航
    					}
    				}
    				$val['navSort'] = $v['navSort']; 
    				$val['navImg'] = $v['navImg']; 
    				$val['navDescription'] = $v['navDescription'];
    				$val['navUrl'] = $v['navUrl'];  
    				$val['status'] = $v['status']; 
    				$val['pid'] = $v['pid'];
    			}
    		}
			$lists[] = $val;
		}
		$this->assign('list',$lists);
		$this->display();
	}
	
	
	
	//导航添加修改
  	  public function edit() {
    	$navMod = D('Nav');
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
    			$this->success('编辑导航成功',U('Nav/index')); 
    			
    		}else{
	    		$navMod->add($nav); 
	    		$this->assign('jumpUrl',U('Nav/index'));    		
	    		$this->success('添加导航成功');  		
    			}
			}
			$types = C('NAV_TYPES'); //获取所有的导航类型
    		$type = $types[0]['navType']; //初始化$type
    		
    		$where['id'] = $nid;
    		$nadd = $navMod->where($where)->find();
    		$type = $nadd['navType'] ? $nadd['navType'] : $type;
    		$nWhere['navType'] = $type;
	    	$navs = $navMod->where($nWhere)->select();//查询$type的所有导航
	    	import('@.ORG.Util.Tree');//引入层级类
	    	$Tree = new Tree('无父节点');//实例化层级类
	    	foreach($navs as $k=>$v){
	    		$Tree->setNode($v['id'],$v['pid'],$v['navName']); 
	    	}
	    	$category = $Tree->getChilds(); //获取子类
	    	$navs = array();
	    	foreach ($category as $key => $id) { //遍历输出$type类型的导航（以层级结构的形式）
	    		$val = array();
	    		$val['id'] = $id;
	    		$val['val'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
				$navs[] = $val;
			}
			$this->assign('nadd',$nadd);
			$this->assign('navtypes',$types);
			$this->assign('navs',$navs);
	    	$this->assign('nid',$nid);
			$this->display();
    }
    	
    
    /*
     * 选择导航类型，显示此类型下的所有导航
     */
    public function gettypes(){
    	$navMod = D('Nav');
    	$type = $_REQUEST['type'];	//从页面中获取type值
    	$nWhere['navType'] = $type;
    	$navs = $navMod->where($nWhere)->select();	//查询出类型为$type的记录
    	import('@.ORG.Util.Tree');	//引入多级目录（层级结构）类
    	$Tree = new Tree('无父节点');//实例化类
    	foreach($navs as $k=>$v){
    		$Tree->setNode($v['id'],$v['pid'],$v['navName']);
    	}
    	$category = $Tree->getChilds();
    	$navs = array();
    	foreach ($category as $key => $id) {
    		$val = array();
    		$val['id'] = $id;
    		$val['val'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
			$navs[] = $val;	
		}
    	$this->assign('navs',$navs);
    	$this->display();
    }
    
    //删除导航
    public function del(){
    	$navMod = D('Nav');
    	$nid = $_REQUEST['nid'];
    	$where['id'] = $nid;
    	$navMod->where($where)->delete();
    	$this->success('删除导航成功',U('Nav/index'));  
    }
    
    /*
     * 图片上传
     */
     public function upload(){

		import("@.ORG.UploadFile");		
		$upload = new UploadFile(); // 实例化上传类		
		$upload->maxSize  = C('XSIZE') ; // 设置附件上传大小		
		$upload->allowExts  = C('ALLOWEXTS'); // 设置附件上传类型		
		$upload->savePath = C('SAVEPATH'); // 设置附件上传目录		
		$upload->saveRule = uniqid();  // 上传文件命名规则		
		if(!$upload->upload()) { // 上传错误提示错误信息		
			$this->error($upload->getErrorMsg());		
		}else{ // 上传成功获取上传文件信息		
			$info =  $upload->getUploadFileInfo();
		}
		//保存当前数据对象
		$data['navImg'] = $info[0]['savename'];		
		return $data;
 	}
}
?>