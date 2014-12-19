<?php

class NewsAction extends CommonAction{
	
	/*
	 * 列表
	 */
    function index() {
    	$newsType = $_REQUEST['newsType']; //获取newsType的值
    	$newsTitle = $_REQUEST['newsTitle'];//获取newsTitle的值
    	$where = array();
    	$param = "";
    	//查询条件
    	if($newsType){
    		$where['d.id'] = $newsType;
    		$param .= '&newsType='.$newsType;
    		$this->assign('id',$newsType);
    	}
    	if($newsTitle){
    		$where['n.newsTitle'] = array('like','%'.$newsTitle.'%');
    		$param .= '&newsTitle='.$newsTitle;
    		$this->assign('title',$newsTitle);
    	}
    	
    	$model = D('News');
    	foreach(C('DICT_TYPES') as $key => $val){
    		$dict[] = $val['type'];
    	}
    	$dictType = implode(',',$dict);
    	
    	/*类型树*/
    	$dictMod = D('Dict');
    	$tWhere['dictType'] = array('in',$dictType);
    	$list = $dictMod->where($tWhere)->select();
    	
    	import('@.ORG.Util.Tree');//引入层级类
    	$Tree = new Tree();//实例化层级类
    	foreach($list as $k=>$v){
    		$Tree->setNode($v['id'],$v['pid'],$v['dictName']); 
    	}
    	$category = $Tree->getChilds(); //获取子类
    	$lists = array();
    	foreach ($category as $key => $id) { //遍历输出$type类型的分类（以层级结构的形式）
    		if($key == 0){
    			continue;
    		}
    		$val = array();
    		$val['id'] = $id;
    		$val['dictName'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
    		$types[] = $val;
		}
		
    	import("@.ORG.Util.Page");  //导入分页类
    	$count = $model->join(' n left join __DICT__ d on d.id=n.newsType')->where($where)->count(); //查询满足要求的总记录数
    	$Page = new Page($count,25,$param); //实例化分页类传入总记录数和每页显示的记录数
    	$show = $Page->show(); //分页显示输出
    	$list = $model->join(' n left join __DICT__ d on d.id=n.newsType')->field('n.*,d.dictName as typeName')->order('createTime desc,updateTime desc')->limit($Page->firstRow.','.$Page->listRows)->where($where)->select();
    	
    	$this->assign('types',$types);
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    /*
	 * 添加、修改
	 */
    function edit() {
    	$newsMod = D('News');
    	if($this->isPost()){
    		$data = $newsMod->create();
    		if($data !== false){
    			$data['createTime'] = strtotime($_POST['createTime']);
    			if($data['id']){
    				$data['updateTime'] = time();//获取新闻更新时间
    				$newsMod->save($data);//修改更新新闻信息
    			}else{
    				//$data['createTime'] = time();//获取新闻添加时间
    				$data['updateTime'] = time();//获取新闻更新时间
    				$newsMod->add($data);//添加新闻信息
    			}
    			$this->assign('jumpUrl',U('News/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($newsMod->getError());
    		}
    	}
    	
    	$id = $_REQUEST['id'];
    	if($id){
    		$nWhere['id'] = $id;
    		$newsInfo = $newsMod->where($nWhere)->find();
    		$this->assign('newsInfo',$newsInfo);
    	}
    	
    	//获取类型
    	foreach(C('DICT_TYPES') as $key => $val){
    		$dict[] = $val['type'];
    	}
    	$dictType = implode(',',$dict);
    	
    	$dictMod = D('Dict');
    	$where['dictType'] = array('in',$dictType);
    	$dicts = $dictMod->where($where)->select();//查询$type的所有分类
    	import('@.ORG.Util.Tree');//引入层级类
    	$Tree = new Tree('请选择');//实例化层级类
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
		$this->assign('dicts',$dicts);
    	$this->display();
    }
    
    /*
	 * 删除
	 */
    function del() {
    	$id = $_REQUEST['id'];
    	$newsMod = D('News');
    	$where['id'] = $id;
    	$newsMod->where($where)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('News/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
    
}
?>