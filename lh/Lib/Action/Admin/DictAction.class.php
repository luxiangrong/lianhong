<?php

class DictAction extends CommonAction{

	/*
	 * 分类列表
	 */
    function index() {
    	$dictMod = D('Dict'); 
    	$type = $_REQUEST['type'];
    	$dictType = $_REQUEST['dictType'];    	
    	$where = array();
    	$type = $type ? $type : ($dictType ? $dictType : 'news');
    	if($type){
    		$where['dictType'] = $type;
    		$this->assign('type',$type);
    	} 
    	  	
    	$list = $dictMod->where($where)->select();
    	$types = C('DICT_TYPES');
    	import('@.ORG.Util.Tree');//引入层级类
    	$Tree = new Tree();//实例化层级类
    	foreach($list as $k=>$v){
    		$Tree->setNode($v['id'],$v['pid'],$v['dictName']); 
    	}
    	$category = $Tree->getChilds(); //获取子类
    	
    	$lists = array();
    	foreach ($category as $key => $id) { //遍历输出$type类型的分类（以层级结构的形式）
    		if(!$id)continue;
    		$val = array();
    		$val['id'] = $id;
    		$val['dictName'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
    		foreach($list as $k=>$v){
    			if($v['id'] == $id){
    				foreach($types as $t=>$ty){
    					if($v['dictType'] == $ty['type']){
    						$val['dictType'] = $ty['type'];
    						$val['typeName'] = $ty['name']; //获取分类类型
    					}
    				}
    				$val['dictSort'] = $v['dictSort']; 
    				$val['pid'] = $v['pid'];
                    $val['bannerImg'] = $v['bannerImg'];
    			}
    		}
			$lists[] = $val;
		}
    	
    	import('@.ORG.Util.Page');//引入分页类
    	$count = count($lists);
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$p = $_REQUEST['p'];
    	$p = $p ? $p : 1;
    	$lists = array_slice($lists,($p - 1) * $Page->listRows,$Page->listRows);
    	
    	$this->assign('list',$lists);
    	$this->assign('page',$show);
    	$this->assign('dictTypes',C('DICT_TYPES'));
    	$this->display();
    }
    
    /*
     * 分类添加、修改
     */
    public function edit(){
    	$dictMod = D('Dict');
    	if($this->isPost()){
    		$data = $dictMod->create();
    		if($data !== false){
    			$dictMod->add($data,'',true); 
    			$this->assign('jumpUrl',U('Dict/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($dictMod->getError());
    		}
    	}

    	$id = intval($_REQUEST['id']);
    	$types = C('DICT_TYPES'); //获取所有的分类类型
    	$type = $types[0]['type']; //初始化$type
    	if($id){	//修改时的数据
    		$where['id'] = $id;
    		$dictInfo = $dictMod->where($where)->find();
    		$type = $dictInfo['dictType'] ? $dictInfo['dictType'] : '';
    	}
    	$pWhere['dictType'] = $type;
    	$dicts = $dictMod->where($pWhere)->select();//查询$type的所有分类
    	import('@.ORG.Util.Tree');//引入层级类
    	$Tree = new Tree('无父节点');//实例化层级类
    	foreach($dicts as $k=>$v){
    		$Tree->setNode($v['id'],$v['pid'],$v['dictName']); 
    	}
    	$category = $Tree->getChilds(); //获取子类
    	$dicts = array();
    	foreach ($category as $key => $id) { //遍历输出$type类型的分类（以层级结构的形式）
    		$val = array();
    		$val['id'] = $id;
    		$val['val'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
			$dicts[] = $val;
		}
    	$this->assign('dictTypes',$types);
    	$this->assign('dicts',$dicts);
    	$this->assign('dictInfo',$dictInfo);
    	$this->display();

    }
    
    /*
     * 选择分类类型，显示此类型下的所有分类
     */
    public function gettypes(){
    	$dictMod = D('Dict');
    	$type = $_REQUEST['type'];	//从页面中获取type值
    	$pWhere['dictType'] = $type;
    	$dicts = $dictMod->where($pWhere)->select();	//查询出类型为$type的记录
    	import('@.ORG.Util.Tree');	//引入多级目录（层级结构）类
    	$Tree = new Tree('无父节点');//实例化类
    	foreach($dicts as $k=>$v){
    		$Tree->setNode($v['id'],$v['pid'],$v['dictName']);
    	}
    	$category = $Tree->getChilds();
    	$dicts = array();
    	foreach ($category as $key => $id) {
    		$val = array();
    		$val['id'] = $id;
    		$val['val'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
			$dicts[] = $val;	
		}
    	$this->assign('dicts',$dicts);
    	$this->display();
    }
    
    /*
     * 删除
     */
    public function del(){
    	$id = $_REQUEST['id'];
    	$dictMod = D('Dict');
    	$dWhere['id'] = $id;
    	$dictMod->where($dWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Dict/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
    
}

?>